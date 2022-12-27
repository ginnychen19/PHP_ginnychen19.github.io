<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$host = "127.0.0.1";
$user = "abuser";
$pwd = "1234";
$db = "weedspage";
$mysqli = new mysqli($host, $user, $pwd, $db);
?>