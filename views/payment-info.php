<?php
session_start();

$user_logged = isset($_SESSION['username']) ? $_SESSION['username'] == '' ? 'hidden' : '' : 'hidden';

if (!isset($_GET['token'])){
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
    <title>.::| CUPON TOURS |::. Payment Info</title>
    <link rel="shortcut icon" href="/images/favicon.png" type="image/png" />
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">

    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/payment-info.css">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/payment-info.js"></script>
</head>
<body>

<input type="hidden" value="<?php echo $_GET['token']; ?>" id="txt-token">

<section class="review-header">
    <section class="row">
        <img class="logo" src="../images/logo.png">
        <label class="review-title" for="">PAYMENT INFO</label>
    </section>
</section>

<section class="auth">
    <div class="title">Type your access key</div>
    <input type="password" title="Access Key" id="txt-access-key" placeholder="access key">
    <div class="btn-access">Access</div>
    <div class="message"></div>
</section>

<div class="content-page">

</div>
</body>
</html>