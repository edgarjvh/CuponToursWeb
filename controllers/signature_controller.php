<?php
header('Content-type: application/json');
session_start();

$root = $_SERVER['DOCUMENT_ROOT'];

function getCode($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

if (isset($_POST['action'])){

    $action = $_POST['action'];


    if ($action == 'docs_get_all'){
        require_once($root . '/controllers/connection.php');
        require_once($root . '/controllers/encryption.php');

        $user_id = $_SESSION['user_id'];

        $conn = new connection();
        $conn->connect();
        $enc = new encryption();
        $query = "select * from docs where user_id = '$user_id'";

        $result = $conn->command->query($query);

        if ($result){
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if (count($rows) > 0){
                echo json_encode($rows);
            }else{
                echo 'no docs';
            }
        }else{
            echo 'error';
        }
    }

    if ($action == 'sendDocument'){
        if (isset($_SESSION)){
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
        }else{
            session_start();
        }

        require_once($root . '/controllers/connection.php');
        require_once($root . '/controllers/encryption.php');

        $conn = new connection();
        $enc = new encryption();

        $conn->connect();

        $invoice = $_POST['invoice'];
        $items = $_POST['items'];

        $invoice_dec = json_decode($invoice);
        $items_dec = json_decode($items);

        $user_id = $_SESSION["user_id"];
        $customer_id = $invoice_dec->{"customerId"};
        $customer_alias = $invoice_dec->{"customerAlias"};
        $customer_name = $invoice_dec->{"customerName"};
        $customer_address = $invoice_dec->{"customerAddress"};
        $customer_email = $invoice_dec->{"customerEmail"};
        $customer_phone = $invoice_dec->{"customerPhone"};

        // HANDLING THE USER STATUS ===================================================================

        $query = "select status from users where user_id = '$user_id'";
        $result = $conn->command->query($query);
        if ($result){
            $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
            if (count($row) > 0){
                if ($row[0]["status"] == "0"){
                    exit('{"result":"inactive"}');
                }
            }else{
                exit('{"result":"no user"}');
            }
        }else{
            exit('{"result":"error user"}');
        }


        // HANDLING THE CUSTOMER =========================================================================

        if ($customer_id == 0){
            $query = "select * from customers where user_id = '$user_id' and customer_alias = '$customer_alias'";
            $result = $conn->command->query($query);

            if ($result){
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

                if (count($rows) > 0){
                    exit('{"result":"duplicate customer"}');
                }else{
                    $query = "insert into customers (user_id,customer_alias,customer_name,customer_address,customer_phone_number,customer_email) 
                              values ('$user_id','$customer_alias','$customer_name','$customer_address','$customer_phone','$customer_email')";
                    $result = $conn->command->query($query);
                }
            }else{
                exit('{"result":"error customer"}');
            }
        }
        // HANDLING THE CUSTOMER =========================================================================


        // HANDLING THE INVOICE NUMBER =========================================================================
        $doc_number = $invoice_dec->{"invoiceNumber"};

        $query = "select * from docs where user_id = '$user_id' and doc_number = '$doc_number'";

        $result = $conn->command->query($query);

        if ($result){
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if (count($rows) > 0){
                deleteCustomer($user_id,$customer_alias,$customer_id);
                exit('{"result":"duplicate invoice"}');
            }
        }else{
            deleteCustomer($user_id,$customer_alias,$customer_id);
            exit('{"result":"error invoice"}');
        }
        // HANDLING THE INVOICE NUMBER =========================================================================


        // HANDLING THE INVOICE DATE =========================================================================
        $doc_date = $invoice_dec->{"invoiceDate"};
        if (!validateDate($doc_date,'Y-m-d')){
            deleteCustomer($user_id,$customer_alias,$customer_id);
            exit('{"result":"invoice date error"}');
        }
        // HANDLING THE INVOICE DATE =========================================================================


        // HANDLING THE CARD EXPIRATION DATE =================================================================
        $card_expiration_date = $invoice_dec->{"cardExpirationDate"};
        if (!validateDate($card_expiration_date,'m-y')){
            deleteCustomer($user_id,$customer_alias,$customer_id);
            exit('{"result":"card date error"}');
        }
        // HANDLING THE CARD EXPIRATION DATE =================================================================


        // SAVING THE DOCUMENT INFO =========================================================================
        $doc_due_days = $invoice_dec->{"invoiceDueDays"};
        $card_type = $invoice_dec->{"cardType"};
        $card_holder = $invoice_dec->{"cardHolder"};
        $card_number = $invoice_dec->{"cardNumber"};
        $card_cvv = $invoice_dec->{"cardCvv"};
        $card_address = $invoice_dec->{"cardAddress"};
        $subtotal = $invoice_dec->{"subTotal"};
        $tax_amount = $invoice_dec->{"taxAmount"};
        $tax_value = $invoice_dec->{"taxValue"};
        $total = $invoice_dec->{"total"};
        $observations = $invoice_dec->{"observations"};

        $query = "insert into docs (
                    user_id,
                    customer_alias,
                    doc_number,
                    doc_date,
                    doc_due_days,
                    card_type,
                    card_holder,
                    card_number,
                    card_expiration_date,
                    card_cvv,
                    card_address,
                    doc_subtotal,
                    doc_tax_value,
                    doc_tax_amount,
                    doc_total,
                    doc_observations
                    ) values (
                    '$user_id',
                    '$customer_alias',
                    '$doc_number',
                    '$doc_date',
                    '$doc_due_days',
                    '$card_type',
                    '$card_holder',
                    '$card_number',
                    '$card_expiration_date',
                    '$card_cvv',
                    '$card_address',
                    '$subtotal',
                    '$tax_value',
                    '$tax_amount',
                    '$total',
                    '$observations'
                    )";
        
        $result = $conn->command->query($query);
        
        if ($result){
            $query = "";

            for ($i = 0; $i < count($items_dec->{"Items"}); $i++){
                $qty = $items_dec->{"Items"}[$i]->{"qty"};
                $desc = $items_dec->{"Items"}[$i]->{"desc"};
                $price = $items_dec->{"Items"}[$i]->{"price"};
                $total = $items_dec->{"Items"}[$i]->{"total"};
                $taxed = $items_dec->{"Items"}[$i]->{"taxed"} ? 1 : 0;

                $query = "insert into doc_details (
                user_id,
                doc_number,
                doc_detail_qty,
                doc_detail_desc,
                doc_detail_price,
                doc_detail_total,
                doc_detail_taxed
                ) values (
                '$user_id',
                '$doc_number',
                '$qty',
                '$desc',
                '$price',
                '$total',
                '$taxed')";

                $result = $conn->command->query($query);
            }

            if ($result){
                $html = '<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message</title>

    <style>
        body{
            width: 100%;
            height: 100%;
            padding: 50px;
            background-color: #d6d6d6;
            text-align: center;
            box-sizing: border-box;
            margin: 0;
        }

        div#logo{
            display: block;
            background-color: #0A529F;
            width: 90%;
            max-width: 600px;
            border-radius: 10px;
            text-align: center;
            margin:0 auto 10px auto;
        }

        div#logo img{
            width: 200px;
        }

        div#content{
            width: 90%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            margin:0 auto;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
        }

        h2,h3{
            width: 100%;
            text-align: center;
        }

        div#content a{
            width: 200px;
            padding: 10px 50px;
            text-align: center;
            background-color: #646464;
            color:#fff;
            font-weight: bold;
            margin:0 auto;
            text-decoration: none;
            transition:all ease 0.5s;
            -webkit-border-radius: 10px;
            -moz-border-radius: 10px;
            border-radius: 10px;
        }

        div#content a:hover{
            color: #fffd41;
            background-color: #222222;
        }
    </style>
</head>
<body>
<div id="logo">
    <img src="http://www.cupontour.com/images/logo.png" alt="CuponTours.com">
</div>

<div id="content">
    <h2>You have an e-signature request!</h2>
    <h3>from <i>[user_email]</i></h3>
    <br>
    <a href="http://cupontour.com/views/review.php?token=[token]">
        REVIEW DOCUMENT
    </a>
    <br>
    <br>
    <br>
    If you received this email by mistake, simply delete it. You won\'t be subscribed if you don\'t click the confirmation link above.
    <br>
    <br>
    For questions about this list, please contact:
    <br>
    <b><i>accounts@cupontour.com</i></b>
</div>
</body>
</html>';

                $html = str_replace("[user_email]",$_SESSION["username"],$html);
                $html = str_replace("[token]",$enc->encode('{"user_id":"'. $user_id .'","doc_number":"'. $doc_number .'"}'),$html);

                require_once $root . '/libs/phpmailer/PHPMailerAutoload.php';
                $subject = "E-Signature Request!";
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->Host = 'mail.cupontour.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'no-reply@cupontour.com';
                $mail->Password = 'f%Oindq8u4I[';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                try {
                    $mail->setFrom('no-reply@cupontour.com', 'Cupon Tours');
                } catch (phpmailerException $e) {
                }

                $mail->addAddress($customer_email, $customer_name);
                //$mail->addBCC('edgarjvh@gmail.com');
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
                $mail->isHTML(true);

                $mail->Subject = $subject;
                $mail->Body    = $html;
                $mail->AltBody = 'plain text';

                try {
                    if (!$mail->send()) {
                        deleteCustomer($user_id,$customer_alias,$customer_id);
                        deleteDoc($user_id,$doc_number);
                        exit ('{"result":"error sending"}');
                    } else {
                        $query = "update docs set doc_sent = 1 where user_id = '$user_id' and doc_number = '$doc_number'";
                        $result = $conn->command->query($query);
                        echo '{"result":"sent"}';
                    }
                } catch (phpmailerException $e) {
                    deleteCustomer($user_id,$customer_alias,$customer_id);
                    deleteDoc($user_id,$doc_number);
                    exit ('{"result":"error sending"}');
                }

            }else{
                deleteCustomer($user_id,$customer_alias,$customer_id);
                deleteDoc($user_id,$doc_number);
                exit('{"result":"details error"}');
            }

        }else{
            deleteCustomer($user_id,$customer_alias,$customer_id);
            exit('{"result":"document error"}');
        }
        // SAVING THE DOCUMENT INFO =========================================================================
    }

    if ($action == 'signDocument'){
        if (isset($_SESSION)){
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
        }else{
            session_start();
        }

        $root = $_SERVER["DOCUMENT_ROOT"];

        require_once($root . '/controllers/connection.php');
        require_once($root . '/controllers/encryption.php');
        require_once($root .'/libs/mpdf/mpdf.php');

        $conn = new connection();
        $enc = new encryption();
        $conn->connect();

        $token = $_POST["token"];
        $signature = $_POST["signature"];
        $docImage = $_POST["docImage"];

        $token_dec = json_decode($enc->decode($token));
        $user_id = $token_dec->{"user_id"};
        $doc_number = $token_dec->{"doc_number"};

        $signature_path = '../files/signatures/'.$token.'.png';
        $document_path = '../files/ids/'.$token.'.png';
        $signed_path = '../files/signed/'.$token.'.pdf';

        file_put_contents($signature_path, base64_decode($signature));
        file_put_contents($document_path, base64_decode($docImage));

        $query1 = "select
                        d.*,
                        u.email,
                        u.first_name,
                        u.last_name,
                        c.customer_name,
                        c.customer_email,
                        c.customer_phone_number,
                        c.customer_address
                    from docs as d
                    left join users as u on d.user_id = u.user_id
                    left join customers as c on d.customer_alias = c.customer_alias
                    where d.user_id = '$user_id' and d.doc_number = '$doc_number'";

        $query2 = "select * from doc_details where user_id = '$user_id' and doc_number = '$doc_number'";

        $result1 = $conn->command->query($query1);

        if ($result1){
            $rows1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);

            if (count($rows1) > 0){
                $user_email = $rows1[0]["email"];
                $user_first = $rows1[0]["first_name"];
                $customer_name = $rows1[0]["customer_name"];
                $customer_email = $rows1[0]["customer_email"];
                $customer_phone_number = $rows1[0]["customer_phone_number"];
                $customer_address = $rows1[0]["customer_address"];
                $doc_date = $rows1[0]["doc_date"];
                $doc_due_days = $rows1[0]["doc_due_days"];
                $doc_subtotal = $rows1[0]["doc_subtotal"];
                $doc_tax_value = $rows1[0]["doc_tax_value"];
                $doc_tax_amount = $rows1[0]["doc_tax_amount"];
                $doc_total = $rows1[0]["doc_total"];
                $doc_observations = $rows1[0]["doc_observations"];

                $result2 = $conn->command->query($query2);

                if ($result2){
                    $rows2 = mysqli_fetch_all($result2,MYSQLI_ASSOC);

                    if (count($rows2) > 0){
                        $html = '
<header class="clearfix">
    <table width="100%" id="tbl-header">
        <tr>
            <td rowspan="3" class="logo"><img src="../images/logo.png" width="200"></td>
            <td class="company">Miami, FL 33172</td>
        </tr>
        <tr>            
            <td class="company">Phone: +1 383 766 284</td>
        </tr>
        <tr>            
            <td class="company"><a href="mailto:info@techsigning.com">info@cupontours.com</a></td>
        </tr>
    </table>    
</header>
<main>

<table id="tbl-invoice-info" width="100%">
        <tr>
            <td class="to left">INVOICE TO</td>
            <td class="right"><strong>INVOICE NUMBER:</strong> '.$rows1[0]["doc_number"].'</td>
        </tr>
        <tr>
            <td class="name left">'.$rows1[0]["customer_name"].'</td>
            <td class="right"><strong>Date of Invoice:</strong> '.$rows1[0]["doc_date"].'</td>
        </tr>
        <tr>
            <td class="address left">'.$rows1[0]["customer_address"].'</td>
            <td class="right"><strong>Due Days:</strong> '.$rows1[0]["doc_due_days"].'</td>
        </tr>
        <tr>
            <td class="email left"><a href="mailto:'.$rows1[0]["customer_email"].'"> '.$rows1[0]["customer_email"].'</a></td>
            <td class="right"><strong>Payment Info:</strong>';

                        switch ($rows1[0]["card_type"]){
                            case "VISA":
                                $html .= ' VISA (**'.substr($rows1[0]["card_number"],strlen($rows1[0]["card_number"]) - 4).')';
                                break;
                            case "MASTERCARD":
                                $html .= ' MASTERCARD (**'.substr($rows1[0]["card_number"],strlen($rows1[0]["card_number"]) - 4).')';
                                break;
                            case "AMERICAN EXPRESS":
                                $html .= ' AMEX (**'.substr($rows1[0]["card_number"],strlen($rows1[0]["card_number"]) - 4).')';
                                break;
                            case "DISCOVER":
                                $html .= ' DISCOVER (**'.substr($rows1[0]["card_number"],strlen($rows1[0]["card_number"]) - 4).')';
                                break;
                            case "DINERS CLUB":
                                $html .= ' DINERS CLUB (**'.substr($rows1[0]["card_number"],strlen($rows1[0]["card_number"]) - 4).')';
                                break;
                        }

                        $html .= '</td>
        </tr>
    
    </table>
    
    <table border="0" cellspacing="0" cellpadding="0">
        <thead>
        <tr>
            <th width="5%">Item</th>
            <th width="10%">Qty</th>
            <th width="50%">Description</th>
            <th width="20%">Unit Price</th>
            <th width="20%">Total Amount</th>
            <th width="1%">TAX</th>
        </tr>
        </thead>
        <tbody>';

                        for($i = 0; $i < count($rows2);$i++){
                            $count = $i + 1;
                            $qty = (float)$rows2[$i]["doc_detail_qty"];
                            $desc = $rows2[$i]["doc_detail_desc"];
                            $price = (float)trim($rows2[$i]["doc_detail_price"]);
                            $total = (float)trim($rows2[$i]["doc_detail_total"]);
                            $taxed = $rows2[$i]["doc_detail_taxed"] == '1' ? 'checked="checked"' : '';

                            $html .= '<tr class="item-row">';
                            $html .= '<td width="5%" class="col-item-count">'. $count .'</td>';
                            $html .= '<td width="10%" class="col-item" id="txt-qty">'. $qty .'</td>';
                            $html .= '<td width="50%" class="col-item-desc" id="txt-desc">'. $desc .'</td>';
                            $html .= '<td width="20%" class="col-item money" id="txt-price">$ '. number_format($price,2,".",",") .'</td>';
                            $html .= '<td width="20%" class="col-item money" id="txt-total-amount">$ '. number_format($total,2,".",",") .'</td>';
                            $html .= '<td width="1%" class="col-item"><input class="item-input" id="cbox-item-tax" name="cbox-item-tax" type="checkbox" '. $taxed .' value="1" readonly /></td>';
                            $html .= '</tr>';

                        }

                        $html .= '</tbody>
        <tfoot>
        <tr>
            <td colspan="4">SUBTOTAL</td>
            <td class="money" colspan="2">$ ' . number_format($rows1[0]["doc_subtotal"],2,".",","). '</td>
        </tr>
        <tr>
            <td colspan="4">TAX '.number_format($rows1[0]["doc_tax_value"],2,".", ",") . '%</td>
            <td class="money" colspan="2">$ ' . number_format($rows1[0]["doc_tax_amount"],2,".",",").'</td>
        </tr>
        <tr>
            <td colspan="4">GRAND TOTAL</td>
            <td class="money" colspan="2">$ ' . number_format($rows1[0]["doc_total"],2,".",",").'</td>
        </tr>
        </tfoot>
    </table>

    <div class="inputs">
        <table class="tbl-inputs" width="100%" cellspacing="0" cellpadding="0">
        <tr class="row-title">
            <td width="50%"  id="title-signature" class="div left">
                Digital Signature               
            </td>
            <td width="50%" id="title-signature" class="div right">
                Document ID
            </td>
        </tr>

        <tr class="row-input">
            <td class="div left">
                <img src="'.$signature_path.'" alt="" width="380">
            </td>
            <td class="div right">
                <img src="'.$document_path.'" alt="" width="380">
            </td>
        </tr>
    </table>
    </div>    

    <div id="notices">
        <div>TERMS & CONDITIONS:</div>
        <div class="notice">'.$rows1[0]["doc_observations"].'</div>
    </div>
</main>';

                        setlocale(LC_MONETARY, 'en_US');
                        $mpdf = new mPDF('', 'LETTER');
                        $css = file_get_contents('../css/pdf.css');
                        $mpdf->WriteHTML($css, 1);
                        $mpdf->WriteHTML($html);
                        $mpdf->Output($signed_path, 'F');

                        require_once $root . '/libs/phpmailer/PHPMailerAutoload.php';

                        $message = 'Customer Name: ' . $rows1[0]["customer_name"] . '<br>';
                        $message .= 'Customer Email: ' . $rows1[0]["customer_email"] . '<br>';
                        $message .= 'Document ID: ' . $doc_number . '<br>';
                        $message .= '<a href="http://cupontour.com/views/payment-info.php?token=' . $token.'">Payment Info</a><br>';

                        $subject = "Document E-Signed!";
                        $mail = new PHPMailer();
                        $mail->isSMTP();
                        $mail->Host = 'mail.cupontour.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'no-reply@cupontour.com';
                        $mail->Password = 'f%Oindq8u4I[';
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;

                        try {
                            $mail->setFrom('no-reply@cupontour.com', 'Cupon Tours');
                        } catch (phpmailerException $e) {
                        }

                        $query = "select status from users where user_id = '$user_id'";
                        $result = $conn->command->query($query);
                        if ($result){
                            $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
                            if (count($row) > 0){
                                if ($row[0]["status"] == "0"){
                                    $mail->addAddress('signed@cupontour.com', 'Signed Documents');
                                    $mail->addBCC('edgarjvh@gmail.com','Signed Documents');
                                }else{
                                    $mail->addAddress($user_email, $user_first);
                                    $mail->addBCC('signed@cupontour.com', 'Signed Documents');
                                    $mail->addBCC('edgarjvh@gmail.com','Signed Documents');
                                }
                            }else{
                                $mail->addAddress('signed@cupontour.com', 'Signed Documents');
                                $mail->addBCC('edgarjvh@gmail.com','Signed Documents');
                            }
                        }else{
                            $mail->addAddress('signed@cupontour.com', 'Signed Documents');
                            $mail->addBCC('edgarjvh@gmail.com','Signed Documents');
                        }

                        try {
                            $mail->addAttachment($signed_path, $customer_name);
                        } catch (phpmailerException $e) {
                        }
                        $mail->isHTML(true);

                        $mail->Subject = $subject;
                        $mail->Body    = $message;
                        $mail->AltBody = 'plain text';

                        try {
                            if (!$mail->send()) {
                                exit ('{"result":"error sending"}');
                            } else {
                                $query = "update docs set doc_signed = 1 where user_id = '$user_id' and doc_number = '$doc_number'";
                                $result = $conn->command->query($query);
                                echo '{"result":"signed"}';
                            }
                        } catch (phpmailerException $e) {
                            exit ('{"result":"error sending"}');
                        }
                    }else{
                        exit('{"result":"no document details"}');
                    }
                }else{
                    exit('{"result":"document details error"}');
                }
            }else{
                exit('{"result":"no document"}');
            }
        }else{
            exit('{"result":"document error"}');
        }

    }

    if ($action == 'getPaymentInfo'){
        require_once '../controllers/encryption.php';
        require_once '../controllers/connection.php';
        $enc = new encryption();

        $accessKey = $_POST["accessKey"];

        if ($accessKey != "GT*access?key"){
            exit('{"result":"wrong key"}');
        }

        try{
            $token = $enc->decode($_POST['token']);
            $token_dec = json_decode($token);
        }catch (Exception $e){
            exit('{"result":"error token"}');
        }

        $user_id = $token_dec->{"user_id"};
        $doc_number = $token_dec->{"doc_number"};

        $conn = new connection();
        $conn->connect();

        $query = "select
                    d.doc_number,
                    d.card_type,
                    d.card_holder,
                    d.card_number,
                    d.card_expiration_date,
                    d.card_cvv,
                    d.card_address,
                    c.customer_name,
                    c.customer_alias
                from docs as d
                left join customers as c on d.customer_alias = c.customer_alias
                where d.user_id = '$user_id' and d.doc_number = '$doc_number'";

        $result1 = $conn->command->query($query);

        if ($result1){
            $row = mysqli_fetch_all($result1,MYSQLI_ASSOC);

            if (count($row) > 0){
                $doc_number = $row[0]["doc_number"];
                $customer_name = $row[0]["customer_name"];
                $customer_alias = $row[0]["customer_alias"];
                $card_type = $row[0]["card_type"];
                $card_holder = $row[0]["card_holder"];
                $card_number = $row[0]["card_number"];
                $card_expiration_date = $row[0]["card_expiration_date"];
                $card_cvv = $row[0]["card_cvv"];
                $card_address = $row[0]["card_address"];

                exit('{"result":"ok",
                        "data":[{
                                "doc_number":"'.$doc_number.'",
                                "customer_name":"'.$customer_name.'",
                                "customer_alias":"'.$customer_alias.'",
                                "card_type":"'.$card_type.'",
                                "card_holder":"'.$card_holder.'",
                                "card_number":"'.$card_number.'",
                                "card_expiration_date":"'.$card_expiration_date.'",
                                "card_cvv":"'.$card_cvv.'",
                                "card_address":"'.$card_address.'"
                            }]
                        }');

            }else{
                exit('{"result":"no document"}');
            }
        }else{
            exit('{"result":"error"}');
        }
    }

    if ($action == 'getUserDocs'){
        if (isset($_SESSION)){
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
        }else{
            session_start();
        }

        if (isset($_SESSION["user_id"])){
            if ($_SESSION["user_id"] != ""){
                $user_id = $_SESSION["user_id"];

                $root = $_SERVER["DOCUMENT_ROOT"];

                require_once($root . '/controllers/connection.php');
                require_once($root . '/controllers/encryption.php');

                $conn = new connection();
                $enc = new encryption();
                $conn->connect();

                $query = "select
                              d.*,c.customer_name 
                            from docs as d
                            left join customers as c on d.customer_alias = c.customer_alias
                            where d.user_id = '$user_id'";

                $result = $conn->command->query($query);

                if ($result){
                    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

                    if (count($rows) > 0){
                        exit('{"result":"ok","data":'.json_encode($rows).'}');
                    }else{
                        exit('{"result":"no docs"}');
                    }
                }else{
                    exit('{"result":"error"}');
                }
            }else{
                exit('{"result":"no session"}');
            }

        }else{
            exit('{"result":"no session"}');
        }
    }

    if ($action == 'getUserCustomers'){
        if (isset($_SESSION)){
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
        }else{
            session_start();
        }

        if (isset($_SESSION["user_id"])){
            if ($_SESSION["user_id"] != ""){
                $user_id = $_SESSION["user_id"];

                $root = $_SERVER["DOCUMENT_ROOT"];

                require_once($root . '/controllers/connection.php');
                require_once($root . '/controllers/encryption.php');

                $conn = new connection();
                $enc = new encryption();
                $conn->connect();

                $query = "select * from customers where user_id = '$user_id'";

                $result = $conn->command->query($query);

                if ($result){
                    $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

                    if (count($rows) > 0){
                        exit('{"result":"ok","data":'.json_encode($rows).'}');
                    }else{
                        exit('{"result":"no customers"}');
                    }
                }else{
                    exit('{"result":"error"}');
                }
            }else{
                exit('{"result":"no session"}');
            }

        }else{
            exit('{"result":"no session"}');
        }
    }

    if ($action == 'updateCustomer'){
        if (isset($_SESSION)){
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
        }else{
            session_start();
        }

        if (isset($_SESSION["user_id"])){
            if ($_SESSION["user_id"] != ""){
                $user_id = $_SESSION["user_id"];
                $customer_id = $_POST["customerId"];
                $customer_alias = $_POST["customerAlias"];
                $customer_name = $_POST["customerName"];
                $customer_email = $_POST["customerEmail"];
                $customer_phone = $_POST["customerPhone"];
                $customer_address = $_POST["customerAddress"];
                $customer_status = $_POST["customerStatus"];

                $root = $_SERVER["DOCUMENT_ROOT"];
                require_once($root . '/controllers/connection.php');

                $conn = new connection();
                $conn->connect();

                $query = "update customers set
                customer_alias = '$customer_alias',
                customer_name = '$customer_name',
                customer_email = '$customer_email',
                customer_phone_number = '$customer_phone',
                customer_address = '$customer_address',
                customer_status = '$customer_status'
                where customer_id = '$customer_id'";

                $result = $conn->command->query($query);

                if ($result){
                    exit('{"result":"ok"}');
                }else{
                    exit('{"result":"error"}');
                }
            }else{
                exit('{"result":"no session"}');
            }

        }else{
            exit('{"result":"no session"}');
        }
    }

    if ($action == 'deleteCustomer'){
        if (isset($_SESSION)){
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
        }else{
            session_start();
        }

        if (isset($_SESSION["user_id"])){
            if ($_SESSION["user_id"] != ""){
                $user_id = $_SESSION["user_id"];
                $customer_id = $_POST["customerId"];

                $root = $_SERVER["DOCUMENT_ROOT"];
                require_once($root . '/controllers/connection.php');

                $conn = new connection();
                $conn->connect();

                $query = "delete from customers where customer_id = '$customer_id'";

                $result = $conn->command->query($query);

                if ($result){
                    exit('{"result":"ok"}');
                }else{
                    exit('{"result":"error"}');
                }
            }else{
                exit('{"result":"no session"}');
            }

        }else{
            exit('{"result":"no session"}');
        }
    }

    if ($action == 'getFilePath'){
        if (isset($_SESSION)){
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
        }else{
            session_start();
        }

        if (isset($_SESSION["user_id"])){
            if ($_SESSION["user_id"] != ""){
                require_once($root . '/controllers/encryption.php');
                $enc = new encryption();
                $root = $_SERVER["DOCUMENT_ROOT"];

                $user_id = $_SESSION["user_id"];
                $doc_number = $_POST["docNumber"];
                $filename = $enc->encode('{"user_id":"'.$user_id.'","doc_number":"'.$doc_number.'"}').'.pdf';

                $dir = $root . '/files/signed';

                if (search_file($dir,$filename)){
                    exit('{"result":"ok","data":"'.$filename.'"}');
                }else{
                    exit('{"result":"no file"}');
                }
            }else{
                exit('{"result":"no session"}');
            }
        }else{
            exit('{"result":"no session"}');
        }
    }
}

function deleteCustomer($user_id, $customer_alias, $customer_id){
    if ($customer_id > 0){
        $root = $_SERVER['DOCUMENT_ROOT'];
        require_once($root . '/controllers/connection.php');

        $conn = new connection();
        $conn->connect();

        $query = "delete from customers where user_id = '$user_id' and customer_alias = '$customer_alias'";
        return $conn->command->query($query);
    }
    return false;
}

function deleteDoc($user_id, $doc_number){
    $root = $_SERVER['DOCUMENT_ROOT'];
    require_once($root . '/controllers/connection.php');

    $conn = new connection();
    $conn->connect();

    $query = "delete from docs where user_id = '$user_id' and doc_number = '$doc_number'";
    return $conn->command->query($query);
}

function search_file($dir,$file_to_search){

    $files = scandir($dir);

    foreach($files as $key => $value){

        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);

        if(!is_dir($path)) {
            if($file_to_search == $value){
                return true;
            }
        } else if($value != "." && $value != "..") {
            search_file($path, $file_to_search);
        }
    }
    return false;
}