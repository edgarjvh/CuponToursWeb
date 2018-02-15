<?php
session_start();

$user_logged = isset($_SESSION['username']) ? $_SESSION['username'] == '' ? 'hidden' : '' : 'hidden';

$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root . '/controllers/encryption.php';

$enc = new encryption();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cupon Tours :|: Confirmation</title>

    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/confirmation.css">
    <link rel="stylesheet" href="../css/dash-member.css">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/confirmation.js"></script>
</head>
<body>
<div class="main-container">
    <div class="main-content" id="main-content">

        <div class="login-bar">
            <div class="sec-container">
                <div class="social-buttons">
                    <i class="fa fa-facebook first"></i>
                    <i class="fa fa-google-plus"></i>
                    <i class="fa fa-twitter"></i>
                    <i class="fa fa-pinterest"></i>
                    <i class="fa fa-youtube"></i>
                </div>

                <div class="login-buttons">
                    <ul class="login-menu">
                        <li class="btn-home"><a href="../">Home</a></li>
                        <li class="btn-login"><a href="../views/login.php">Login</a></li>
                        <li class="btn-register"><a href="../views/register.php">Register</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="logo"></div>

        <div class="confirmation-form">
            <h2>Confirm your registration</h2>

            <i id="lbl-email"><?php echo $enc->decode($_GET['token']);?></i>

            <div class="fields">
                <input id="txt-code" title="txt-code" placeholder="Confirmation code">
            </div>

            <div class="confirmation-btn">Confirm</div>

            <p id="btn-new-code">Get new code</p>
            <div class="errors">Error</div>
        </div>
    </div>
</div>

</body>
</html>