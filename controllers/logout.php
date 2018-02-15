<?php
session_start();
$_SESSION['username'] = '';
$_SESSION['first_name'] = '';
$_SESSION['last_name'] = '';
$_SESSION['user_id'] = '';
$_SESSION['status'] = '';

header('Location:../');
?>