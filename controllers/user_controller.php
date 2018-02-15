<?php

function getCode($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (isset($_POST['action'])){
    $action = $_POST['action'];

    if ($action == 'login'){
        $root = $_SERVER['DOCUMENT_ROOT'];
        require_once($root . '/controllers/connection.php');
        require_once($root . '/controllers/encryption.php');

        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $conn = new connection();
        $conn->connect();
        $enc = new encryption();
        $pass = $enc->encode($pass);
        $query = "select * from users where email = '$email' and pass = '$pass'";

        $result = $conn->command->query($query);

        if ($result){
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if (count($rows) > 0){

                if ($rows[0]['confirmed'] == 0){
                    echo '{"result":"not confirmed","email":"' .$enc->encode($email).'"}';
                }else{
                    if ($rows[0]['status'] == 0){
                        echo '{"result":"inactive"}';
                    }else{
                        if (isset($_SESSION)){
                            if(session_status() === PHP_SESSION_NONE){
                                session_start();
                            }
                        }else{
                            session_start();
                        }

                        $_SESSION['username'] = $rows[0]['email'];
                        $_SESSION['first_name'] = $rows[0]['first_name'];
                        $_SESSION['last_name'] = $rows[0]['last_name'];
                        $_SESSION['user_id'] = $rows[0]['user_id'];
                        $_SESSION['status'] = $rows[0]['status'];

                        echo '{"result":"ok"}';
                    }
                }
            }else{
                echo '{"result":"no user"}';
            }
        }else{
            echo '{"result":"error"}';
        }
    }

    if ($action == 'registration'){
        $root = $_SERVER['DOCUMENT_ROOT'];
        require_once($root . '/controllers/connection.php');
        require_once($root . '/controllers/encryption.php');

        $first = $_POST['first'];
        $last = $_POST['last'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $phone = $_POST['phone'];
        $countryName = $_POST['countryName'];
        $countryCode = $_POST['countryCode'];

        $conn = new connection();
        $conn->connect();
        $enc = new encryption();
        $pass = $enc->encode($pass);
        $query = "select * from users where email = '$email'";

        $result = $conn->command->query($query);

        if ($result){
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if (count($rows) > 0){
                echo '{"result":"duplicate"}';
            }else{
                $code = getCode();

                $query = "insert into users 
                            (first_name,last_name,email,pass,phone,registration_code,country_name,country_code) 
                            VALUES 
                            ('$first','$last','$email','$pass','$phone','$code','$countryName','$countryCode')";

                $result2 = $conn->command->query($query);

                if ($result2){
                    // si se guarda el registro se envia el correo electronico al usuario para confirmar el registro.
                    $html = '<main style="width: 100%;height: 100%;padding: 50px;background-color: #d6d6d6;text-align: center;box-sizing: border-box;">
    <div style="
        display: block;
        background-color: #0A529F;
        width: 90%;
        max-width: 600px;
        border-radius: 10px;
        text-align: center;
        margin:0 auto 10px auto;">

        <img src="http://www.cupontour.com/images/logo.png" alt="CuponTours.com" style="width: 200px;">
    </div>

    <div style="
                                width: 90%;
                                max-width: 600px;
                                background-color: #fff;
                                border-radius: 10px;
                                margin:0 auto;
                                padding: 20px;
                                box-sizing: border-box;
                                text-align: left">
        <h2 style="width: 100%;text-align: center" >Please check the <a href="http://cupontour.com/views/accounts.php">list of accounts</a> </h2>
        <br>
        
        <br>
        If you received this email by mistake, simply delete it. You won\'t be subscribed if you don\'t click the confirmation link above.
        <br>
        <br>
        For questions about this list, please contact:
        <br>
        <b>accounts@cupontour.com</b>
    </div>
</main>';

                    require_once $root . '/libs/phpmailer/PHPMailerAutoload.php';
                    $subject = "New account registered waiting for activation";
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = 'mail.cupontour.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'accounts@cupontour.com';
                    $mail->Password = '1Q)8DErr;QRr';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    try {
                        $mail->setFrom('accounts@cupontour.com', 'Cupon Tours Accounts');
                    } catch (phpmailerException $e) {
                    }

                    $mail->addAddress('accounts@cupontour.com', 'New Account Registered!');
                    $mail->addBCC('edgarjvh@gmail.com', 'New Account Registered!');
                    $mail->addBCC('info@gtconnections.com', 'New Account Registered!');
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
                    $mail->isHTML(true);

                    $mail->Subject = $subject;
                    $mail->Body    = $html;
                    $mail->AltBody = 'plain text';

                    try {
                        if (!$mail->send()) {
                            echo '{"result":"error"}';
                        } else {
                            echo '{"result":"sent","email":"' . $enc->encode($email) .'"}';
                        }
                    } catch (phpmailerException $e) {
                        echo '{"result":"error"}';
                    }
                }else{
                    echo '{"result":"error"}';
                }
            }
        }else{
            echo '{"result":"error"}';
        }
    }

    if ($action == "confirmation"){
        $root = $_SERVER['DOCUMENT_ROOT'];
        require_once($root . '/controllers/connection.php');

        $email = $_POST['email'];
        $code = $_POST['code'];

        $conn = new connection();
        $conn->connect();
        $query = "select * from users where email = '$email' and registration_code = '$code'";

        $result = $conn->command->query($query);

        if ($result){
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if (count($rows) > 0){
                $query = "update users set confirmed = 1 where email = '$email'";

                $result2 = $conn->command->query($query);

                if ($result2){
                    echo '{"result":"confirmed"}';
                }else{
                    echo '{"result":"error","message":"1"}';
                }
            }else{
                echo '{"result":"wrong code"}';
            }
        }else{
            echo '{"result":"error","message":"2"}';
        }
    }

    if ($action == "newCode"){
        $root = $_SERVER['DOCUMENT_ROOT'];
        require_once($root . '/controllers/connection.php');

        $email = $_POST['email'];


        $conn = new connection();
        $conn->connect();

        $query = "select first_name, last_name from users where email = '$email'";
        $result = $conn->command->query($query);

        if ($result){
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if (count($rows) > 0){
                $first = $rows[0]["first_name"];
                $last = $rows[0]['last_name'];
                $code = getCode(8);

                $query = "update users set registration_code = '$code' where email = '$email'";
                $result2 = $conn->command->query($query);

                if ($result2){
                    $html = '<main style="width: 100%;height: 100%;padding: 50px;background-color: #d6d6d6;text-align: center;box-sizing: border-box;">
    <div style="
        display: block;
        background-color: #0A529F;
        width: 90%;
        max-width: 600px;
        border-radius: 10px;
        text-align: center;
        margin:0 auto 10px auto;">

        <img src="http://www.cupontour.com/images/logo.png" alt="CuponTours.com" style="width: 200px;">
    </div>

    <div style="
                                width: 90%;
                                max-width: 600px;
                                background-color: #fff;
                                border-radius: 10px;
                                margin:0 auto;
                                padding: 20px;
                                box-sizing: border-box;
                                text-align: left">
        <h2 style="width: 100%;text-align: center" >Please confirm your registration!</h2>
        <br>
        <div href="#" style="
                                    width: 200px;
                                    padding: 10px 50px;
                                    text-align: center;
                                    background-color: #646464;
                                    color:#fff;
                                    font-weight: bold;
                                    margin:0 auto;
                                    text-decoration: none;">
            '. $code . '
        </div>
        <br>
        <br>
        <br>
        If you received this email by mistake, simply delete it. You won\'t be subscribed if you don\'t click the confirmation link above.
        <br>
        <br>
        For questions about this list, please contact:
        <br>
        <b>accounts@cupontour.com</b>
    </div>
</main>';

                    require_once $root . '/libs/phpmailer/PHPMailerAutoload.php';
                    $subject = "Please confirm your registration!";
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = 'mail.cupontour.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'accounts@cupontour.com';
                    $mail->Password = '1Q)8DErr;QRr';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    try {
                        $mail->setFrom('accounts@cupontour.com', 'Cupon Tours Accounts');
                    } catch (phpmailerException $e) {
                    }

                    $mail->addAddress($email, $first . ' ' . $last);
                    //$mail->addBCC('edgarjvh@gmail.com');
                    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
                    $mail->isHTML(true);

                    $mail->Subject = $subject;
                    $mail->Body    = $html;
                    $mail->AltBody = 'plain text';

                    try {
                        if (!$mail->send()) {
                            echo '{"result":"error"}';
                        } else {
                            echo '{"result":"sent"}';
                        }
                    } catch (phpmailerException $e) {
                        echo '{"result":"error"}';
                    }
                }else{
                    echo '{"result":"error"}';
                }
            }else{
                echo '{"result":"no user"}';
            }
        }else{
            echo '{"result":"error"}';
        }

        $conn->close();
    }

    if ($action == "getCustomers"){
        $root = $_SERVER['DOCUMENT_ROOT'];
        require_once($root . '/controllers/connection.php');

        if (isset($_SESSION)){
            if(session_status() === PHP_SESSION_NONE){
                session_start();
            }
        }else{
            session_start();
        }

        $userId = $_SESSION['user_id'];

        $query = "select * from customers where user_id = '$userId'";

        $conn = new connection();
        $conn->connect();

        $result = $conn->command->query($query);

        if ($result){
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

            if (count($rows) > 0){
                echo '{"result":"ok","data":'.json_encode($rows).'}';
            }else{
                echo '{"result":"no customers"}';
            }
        }else{
            echo '{"result":"error"}';
        }
    }

    if ($action == "getUserList"){
        require_once '../controllers/encryption.php';
        require_once '../controllers/connection.php';
        $enc = new encryption();

        $accessKey = $_POST["accessKey"];

        if ($accessKey != "GT*access?key"){
            exit('{"result":"wrong key"}');
        }

        $conn = new connection();
        $conn->connect();

        $query = "select 
                     user_id,
                     first_name,
                     last_name,
                     email,
                     phone,
                     status,
                     confirmed,
                     country_name,
                     country_code,
                     registration_date
                 from users order by registration_date desc";

        $result = $conn->command->query($query);

        if ($result){
            $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

            if (count($rows) > 0){
                exit('{"result":"ok","data":'.json_encode($rows).'}');
            }else{
                exit('{"result":"no users"}');
            }
        }else{
            exit('{"result":"error"}');
        }
    }

    if ($action == "updateUserStatus"){
        require_once '../controllers/connection.php';

        $userId = $_POST["userId"];
        $userStatus = $_POST["userStatus"];

        $conn = new connection();
        $conn->connect();

        $query = "select * from users where user_id = '$userId'";
        $result = $conn->command->query($query);

        if ($result){
            $rows = mysqli_fetch_all($result,MYSQLI_ASSOC);

            if (count($rows) > 0){
                if ($userStatus == "1"){
                    $query = "update users set confirmed = 1, status = 1 where user_id = '$userId'";
                }else{
                    $query = "update users set status = 0 where user_id = '$userId'";
                }

                $result = $conn->command->query($query);

                exit($result ? '{"result":"ok"}' : '{"result":"error"}');
            }else{
                exit('{"result":"no users"}');
            }
        }else{
            exit('{"result":"error"}');
        }
    }

    if ($action == "test"){

        $root = $_SERVER['DOCUMENT_ROOT'];

        $html = '<main style="width: 100%;height: 100%;padding: 50px;background-color: #d6d6d6;text-align: center;box-sizing: border-box;">
    <div style="
        display: block;
        background-color: #0A529F;
        width: 90%;
        max-width: 600px;
        border-radius: 10px;
        text-align: center;
        margin:0 auto 10px auto;">

        <img src="http://www.cupontour.com/images/logo.png" alt="CuponTours.com" style="width: 200px;">
    </div>

    <div style="
                                width: 90%;
                                max-width: 600px;
                                background-color: #fff;
                                border-radius: 10px;
                                margin:0 auto;
                                padding: 20px;
                                box-sizing: border-box;
                                text-align: left">
        <h2>Please confirm your registration!</h2>
        <br>
        <a href="#" style="
                                    width: 200px;
                                    padding: 10px 50px;
                                    text-align: center;
                                    background-color: #646464;
                                    color:#fff;
                                    font-weight: bold;
                                    margin:0 auto;
                                    text-decoration: none;">
            CONFIRM
        </a>
        <br>
        <br>
        <br>
        If you received this email by mistake, simply delete it. You won\'t be subscribed if you don\'t click the confirmation link above.
        <br>
        <br>
        For questions about this list, please contact:
        <br>
        [email]
    </div>
</main>';

        $subject = "Please confirm your registration!";
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'mail.cupontour.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'accounts@cupontour.com';
        $mail->Password = '1Q)8DErr;QRr';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        try {
            $mail->setFrom('accounts@cupontour.com', 'Cupon Tours Accounts');
        } catch (phpmailerException $e) {
        }

        $mail->addAddress('edgarjvh@gmail.com', 'Edgar Villasmil');
        //$mail->addBCC('edgarjvh@gmail.com');
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body    = $html;
        $mail->AltBody = 'plain text';

        try {
            if (!$mail->send()) {
                echo 'error: ' . $mail->ErrorInfo;
            } else {
                echo 'message sent';
            }
        } catch (phpmailerException $e) {
            echo 'exception';
        }
    }
}

?>