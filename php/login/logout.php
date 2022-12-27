<?php
session_start();
unset($_SESSION['uid']);
setcookie('uid', null, -1);
header('location: /login');
?>
