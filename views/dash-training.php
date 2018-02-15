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
    <link rel="stylesheet" href="../css/dash-training.css">

    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/dash-training.js"></script>
    <script src="../js/dash-header.js"></script>
    <script src="../js/dash-sidebar.js"></script>

</head>
<body>
<?php include_once 'dash-header.php' ?>

<div class="main-container">
    <?php include_once 'dash-sidebar.php' ?>

    <div class="main-content" id="main-content">
        <section class="dash-content">
            <div class="training">
                <div class="curses-list">
                    <p class="curses-title">Seleccione un curso  <i class="fa fa-chevron-down"></i></p>
                    <ul>
                        <li class="curse-item"><i class="fa fa-leanpub"></i>Curso #1</li>
                        <li class="curse-item"><i class="fa fa-leanpub"></i>Curso #2</li>
                        <li class="curse-item"><i class="fa fa-leanpub"></i>Curso #3</li>
                        <li class="curse-item"><i class="fa fa-leanpub"></i>Curso #4</li>
                        <li class="curse-item"><i class="fa fa-leanpub"></i>Curso #5</li>
                        <li class="curse-item"><i class="fa fa-leanpub"></i>Curso #6</li>
                        <li class="curse-item"><i class="fa fa-leanpub"></i>Curso #7</li>
                        <li class="curse-item"><i class="fa fa-leanpub"></i>Curso #8</li>
                        <li class="curse-item"><i class="fa fa-leanpub"></i>Curso #9</li>
                        <li class="curse-item"><i class="fa fa-leanpub"></i>Curso #10</li>
                    </ul>
                </div>
                <div class="curses-content">
                    <div class="videos-list">
                        <p class="curses-title">Videos<i class="fa fa-chevron-down"></i></p>
                    </div>
                    <div class="comments">
                        <p class="curses-title">Comentarios<i class="fa fa-chevron-down"></i></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

</body>
</html>
