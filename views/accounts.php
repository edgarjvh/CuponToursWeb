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
    <title>.::| CUPON TOURS |::. Accounts</title>
    <link rel="shortcut icon" href="/images/favicon.png" type="image/png" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">

    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/accounts.css">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/date-format.js"></script>
    <script src="../js/accounts.js"></script>
</head>
<body>

<section class="review-header">
    <section class="row">
        <img class="logo" src="../images/logo.png">
        <span class="review-title">ACCOUNTS</span>
    </section>
</section>

<form class="auth">
    <div class="title">Type your access key</div>
    <input type="password" title="Access Key" id="txt-access-key" placeholder="access key" autocomplete="access-key">
    <div class="btn-access">Access</div>
    <div class="message"></div>
</form>

<div class="content-page">

</div>
</body>
</html>