<?php
session_start();

$user_logged = isset($_SESSION['username']) ? $_SESSION['username'] == '' ? 'hidden' : '' : 'hidden';

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cupon Tours :|: Login</title>

    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/dash-member.css">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/login.js"></script>
</head>
<body>
<div class="main-container">
    <div class="main-content" id="main-content">

        <?php include_once 'sub-header.php';?>

        <div class="logo"></div>

        <div class="login">
            <h2>Access</h2>
            <div class="login-field">
                <input type="email" id="txt-email" title="txt-email" placeholder="E-mail">
            </div>
            <div class="login-field">
                <input type="password" id="txt-pass" title="txt-pass" placeholder="Password">
            </div>
            <div class="login-btn">Log In</div>
            <h3 id="lbl-password-recovery">Password Recovery</h3>
            <div class="errors">Error</div>
        </div>
    </div>
</div>

</body>
</html>