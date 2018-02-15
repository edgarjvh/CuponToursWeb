<?php
session_start();

$user_logged = isset($_SESSION['username']) ? $_SESSION['username'] === '' ? 'hidden' : '' : 'hidden';

if ($user_logged == 'hidden'){
    header('location:../');
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Member - CUPONTOURS.com</title>
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/dash-member.css">
    <link rel="stylesheet" href="../css/dash-map.css">

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/dash-map.js"></script>
    <script src="../js/dash-header.js"></script>
    <script src="../js/dash-sidebar.js"></script>

</head>
<body>
<?php include_once 'dash-header.php' ?>

<div class="main-container">
    <?php include_once 'dash-sidebar.php' ?>

    <div class="main-content" id="main-content">
        <section class="dash-content">
            <div class="member-locations-map" id="member-locations-map"></div>
        </section>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBquR6mFxmILyaumu6ZhqlXYmUlqcSl8Yg&callback=initMap"
        async defer></script>

</body>
</html>