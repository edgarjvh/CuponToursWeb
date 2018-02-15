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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/dash-member.js"></script>
    <script src="../js/dash-header.js"></script>
    <script src="../js/dash-sidebar.js"></script>

</head>
<body>
<?php include_once 'dash-header.php'?>

<div class="main-container">
    <?php include_once 'dash-sidebar.php'?>

    <div class="main-content" id="main-content">
        <section class="dash-content">
            <div class="small-charts">
                <div class="resume-counter" id="new-messages">
                    <div class="row-one">
                        <p><span class="count">26</span> New Messages!</p>
                        <i class="fa fa-comments-o"></i>
                    </div>
                    <div class="row-two">
                        <p>View Details</p>
                        <i class="fa fa-chevron-right"></i>
                    </div>
                </div>
                <div class="resume-counter" id="new-tasks">
                    <div class="row-one">
                        <p><span class="count">11</span> New Tasks!</p>
                        <i class="fa fa-tasks"></i>
                    </div>
                    <div class="row-two">
                        <p>View Details</p>
                        <i class="fa fa-chevron-right"></i>
                    </div>
                </div>
                <div class="resume-counter" id="new-orders">
                    <div class="row-one">
                        <p><span class="count">123</span> New Orders!</p>
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="row-two">
                        <p>View Details</p>
                        <i class="fa fa-chevron-right"></i>
                    </div>
                </div>
                <div class="resume-counter" id="new-tickets">
                    <div class="row-one">
                        <p><span class="count">13</span> New Tickets!</p>
                        <i class="fa fa-life-ring"></i>
                    </div>
                    <div class="row-two">
                        <p>View Details</p>
                        <i class="fa fa-chevron-right"></i>
                    </div>
                </div>
            </div>

            <div class="large-chart" id="large-chart"></div>
        </section>
    </div>
</div>

</body>
</html>