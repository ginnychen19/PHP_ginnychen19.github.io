<?php
session_start();
if (isset($_COOKIE["uid"])) {
    $_SESSION["uid"] = $_COOKIE["uid"]; 
    setcookie("uid", $_COOKIE["uid"], time() + 120);
    header('location: ../profile/');
}
?>
<html>
<body>
<form action="login.php" method="post">
帳號：<input name="uid"><br>
密碼：<input type="password" name="pwd"><p>
<input type="submit">
</form>
</body>
</html>


