<?php session_start(); ?>
<?php require('db.php'); ?>
<?php
$uid = trim($_POST['uid']);
$pwd = trim($_POST['pwd']);
$sql = "select * from UserInfo where uid = ? and pwd = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ss', $uid, $pwd);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows == 1) {
    $_SESSION['uid'] = $uid;
    setcookie("uid", $uid, time() + 120);
    header('location: ../profile/');
} else {
    header('location: error.php');
}
?>
