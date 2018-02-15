<?php
session_start();

$user_logged = isset($_SESSION['username']) ? $_SESSION['username'] == '' ? 'hidden' : '' : 'hidden';

if (isset($_GET['token'])){
    require_once '../controllers/encryption.php';
    require_once '../controllers/connection.php';
    $enc = new encryption();

    $token = $enc->decode($_GET['token']);

    try{
        $token_dec = json_decode($token);
    }catch (Exception $e){
        header('Location:../');
    }

    $user_id = $token_dec->{"user_id"};
    $doc_number = $token_dec->{"doc_number"};

    $conn = new connection();
    $conn->connect();

    $query = "select
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

    $result1 = $conn->command->query($query);

    if ($result1){
        $rows1 = mysqli_fetch_all($result1,MYSQLI_ASSOC);

        if (count($rows1) > 0){
            if ($rows1[0]["doc_signed"] == 1){
                header('Location:../');
            }else{
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
            }
        }else{
            header('Location:../');
        }
    }else{
        header('Location:../');
    }
}else{
    header('Location:../');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cupon Tours :|: Review</title>

    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/review.css">
    <script src="../js/jquery-3.2.1.min.js"></script>
</head>
<body>
<div class="main-container">
    <?php //include_once 'sub-header.php';?>

    <div class="review-document">
        <div id="dark-pop-up"></div>
        <div id="errors">Test Message</div>

        <section class="review-header">
            <section class="row">
                <img class="logo" src="../images/logo.png">
                <label class="review-title" for="">INVOICE</label>
            </section>

            <section class="row">
                <section class="customer-info">
                    <div class="title">Customer Info</div>
                    <div class="new-info">
                        <div class="row">
                            <span class="label">Name</span>
                            <input type="text" id="txt-customer-name" class="customer-info" title="Name" name="txt-customer-name" value="<?php echo $customer_name; ?>" disabled>
                        </div>
                        <div class="row">
                            <span class="label">E-mail</span>
                            <input type="text" id="txt-customer-email" class="customer-info" title="E-mail" name="txt-customer-email" value="<?php echo $customer_email; ?>" disabled>
                        </div>
                        <div class="row">
                            <span class="label">Phone Number</span>
                            <input type="text" id="txt-customer-phone-number" class="customer-info" title="Phone Number" name="txt-customer-phone-number" value="<?php echo $customer_phone_number; ?>" disabled>
                        </div>
                        <div class="row">
                            <span class="label">Address</span>
                            <input type="text" id="txt-customer-address" class="customer-info" title="Address" name="txt-customer-address" value="<?php echo $customer_address; ?>" disabled>
                        </div>
                    </div>
                </section>

                <section class="invoice-info">
                    <div class="title">Invoice Info</div>
                    <div class="new-info">
                        <div class="row">
                            <span class="label">Number</span>
                            <input type="text" id="txt-invoice-number" title="Number" name="txt-invoice-number" value="<?php echo $doc_number; ?>" disabled>
                        </div>
                        <div class="row">
                            <span class="label">Date</span>
                            <input type="text" id="txt-invoice-date" title="Date" name="txt-invoice-date" value="<?php echo $doc_date; ?>" disabled>
                        </div>
                        <div class="row">
                            <span class="label">Due Days</span>
                            <input type="text" id="txt-invoice-due-days" title="Due Days" name="txt-invoice-due-days" value="<?php echo $doc_due_days; ?>" disabled>
                        </div>
                    </div>
                </section>
            </section>
        </section>

        <section class="invoice-items">
            <div class="thead">
                <div class="row title">
                    <div class="col-1">Ítem</div>
                    <div class="col-2">Qty</div>
                    <div class="col-3">Description</div>
                    <div class="col-4">Unit Price</div>
                    <div class="col-5">Total Amount</div>
                    <div class="col-6">Tax</div>
                </div>
            </div>
            <div class="tbody">
                <?php
                $query = "select * from doc_details where user_id = '$user_id' and doc_number = '$doc_number'";
                $result2 = $conn->command->query($query);


                if ($result2){
                    $rows2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

                    if (count($rows2) > 0){
                        for ($i = 0; $i < count($rows2); $i++){


                            echo '<div class="row">';
                            echo '<div class="col col-1">';
                            echo $i+1;
                            echo '</div>';
                            echo '<div class="col col-2">';
                            echo '<input type="text" id="txt-item-qty" name="txt-item-qty" title="Quantity" readonly value="'.$rows2[$i]["doc_detail_qty"].'">';
                            echo '</div>';
                            echo '<div class="col col-3">';
                            echo '<input type="text" id="txt-item-desc" name="txt-item-desc" title="Description" readonly value="'.$rows2[$i]["doc_detail_desc"].'">';
                            echo '</div>';
                            echo '<div class="col col-4 money">';
                            echo '<input type="text" id="txt-item-price" name="txt-item-price" title="Unit Price" readonly value="'.$rows2[$i]["doc_detail_price"].'">';
                            echo '</div>';
                            echo '<div class="col col-5 money">';
                            echo '<input type="text" id="txt-item-total" name="txt-item-total" title="Total Amount" readonly value="'.$rows2[$i]["doc_detail_total"].'">';
                            echo '</div>';
                            echo '<div class="col col-6">';
                            $taxed = $rows2[$i]["doc_detail_taxed"] == 1 ? 'checked' : '';
                            echo '<input type="checkbox" id="cbox-item-tax" name="cbox-item-tax" title="Tax" disabled '.$taxed.'>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }else{
                        echo '<div class="row">';
                        echo '<div class="col col-1">';
                        echo '1';
                        echo '</div>';
                        echo '<div class="col col-2">';
                        echo '<input type="text" id="txt-item-qty" name="txt-item-qty" title="Quantity" readonly value="">';
                        echo '</div>';
                        echo '<div class="col col-3">';
                        echo '<input type="text" id="txt-item-desc" name="txt-item-desc" title="Description" readonly value="">';
                        echo '</div>';
                        echo '<div class="col col-4 money">';
                        echo '<input type="text" id="txt-item-price" name="txt-item-price" title="Unit Price" readonly value="">';
                        echo '</div>';
                        echo '<div class="col col-5 money">';
                        echo '<input type="text" id="txt-item-total" name="txt-item-total" title="Total Amount" readonly value="">';
                        echo '</div>';
                        echo '<div class="col col-6">';
                        echo '<input type="checkbox" id="cbox-item-tax" name="cbox-item-tax" title="Tax" disabled>';
                        echo '</div>';
                        echo '</div>';
                    }
                }else{
                    echo '<div class="row">';
                    echo '<div class="col col-1">';
                    echo '1';
                    echo '</div>';
                    echo '<div class="col col-2">';
                    echo '<input type="text" id="txt-item-qty" name="txt-item-qty" title="Quantity" readonly value="">';
                    echo '</div>';
                    echo '<div class="col col-3">';
                    echo '<input type="text" id="txt-item-desc" name="txt-item-desc" title="Description" readonly value="">';
                    echo '</div>';
                    echo '<div class="col col-4 money">';
                    echo '<input type="text" id="txt-item-price" name="txt-item-price" title="Unit Price" readonly value="">';
                    echo '</div>';
                    echo '<div class="col col-5 money">';
                    echo '<input type="text" id="txt-item-total" name="txt-item-total" title="Total Amount" readonly value="">';
                    echo '</div>';
                    echo '<div class="col col-6">';
                    echo '<input type="checkbox" id="cbox-item-tax" name="cbox-item-tax" title="Tax" disabled>';
                    echo '</div>';
                    echo '</div>';
                }

                ?>
            </div>
        </section>

        <section class="invoice-footer">
            <section class="observations">
                <div class="title">Observations</div>
                <input class="observations-text" id="txt-invoice-observations" title="Observations" readonly value="<?php echo $doc_observations; ?>">
            </section>

            <section class="totals">
                <div class="row money">
                    <div class="title">Sub Total</div>
                    <span id="txt-subtotal"><?php echo $doc_subtotal;?></span>
                </div>
                <div class="row money">
                    <div class="title">Tax <input type="text" id="txt-tax-value" name="txt-tax-value" readonly title="Tax" value="<?php echo $doc_tax_value;?>" />%</div>
                    <span id="txt-tax-amount"><?php echo $doc_tax_amount;?></span>
                </div>
                <div class="row money">
                    <div class="title">Total</div>
                    <span id="txt-total"><?php echo $doc_total;?></span>
                </div>
            </section>
        </section>

        <section class="e-signature">
            <div class="drawing-signature">
                <div class="title">Place your digital signature here</div>
                <div id="btn-clear-signature"><i class="fa fa-eraser"></i> Clear Signature</div>
                <div class="div-canvas">
                    <canvas id="sig-canvas" width="350" height="150"></canvas>
                    <div id="costumers-name"><?php echo $rows1[0]["customer_name"];?></div>
                </div>
            </div>

            <div class="uploading-file">
                <div class="title">Upload your document ID</div>
                <form method="post" enctype="multipart/form-data" id="upload-form">
                    <input type="file" name="file" id="file" accept="image/*">
                </form>
                <img src="" alt="" id="img-upload" name="img-upload">
            </div>
        </section>

        <section class="terms">
            <label class="terms-title" for="txt-terms">Terms of Services</label>
            <textarea name="txt-terms" id="txt-terms" rows="5000" readonly><?php echo file_get_contents('../files/tos.txt') ?></textarea>

            <div class="div-terms-agree">
                <label class="checkbox-label"><input type="checkbox" id="cbox-agree-terms" checked>I agree the Terms of Service of CUPONTOURS.COM</label>
            </div>
        </section>

        <section class="buttons">
            <div class="btn-proceed" onclick="sendDocument('<?php echo $_GET['token'];?>')">Proceed</div>
        </section>
    </div>

</div>
<input type="hidden" id="file-upload-64">

<script src="../js/canvas.js"></script>
<script src="../js/review.js"></script>
</body>
</html>