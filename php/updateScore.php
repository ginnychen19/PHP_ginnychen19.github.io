<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    上傳成功！
    5秒後將自動跳轉！

    <script>
        setTimeout(function () {
            window.location.href = 'http://127.0.0.1/PHP_ginnychen19.github.io/BullsAndCows.php';
        }, 5000);

    </script>
</body>

</html>

<?php require('./db.php'); ?>

<?php
$last_ctn = $_GET['last_ctn'];
$last_time = $_GET['last_time'];

if (isset($_COOKIE["uid"])) {
    /*得到使用者資訊，並存入變數 */
    $user_uid = $_COOKIE["uid"];
    $sql00 = "select * from userinfo where uid = ?";
    $stmt00 = $mysqli->prepare($sql00);
    $stmt00->bind_param('s', $user_uid);
    $stmt00->execute();
    $result00 = $stmt00->get_result();
    $total_records = mysqli_num_rows($result00);

    for ($i = 0; $i < $total_records; $i++) {
        $row = mysqli_fetch_assoc($result00);
        $user_id = $row["id"];
    }

    $sql = 'INSERT INTO `score` (`id`, `Utime`, `Ucount`) VALUES (?,?,?);';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssi', $user_id, $last_time, $last_ctn);
    $stmt->execute();
} else {
    /*存入1號訪客 */
    $user_id = "1";

    $sql = 'INSERT INTO `score` (`id`, `Utime`, `Ucount`) VALUES (?,?,?);';
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssi', $user_id, $last_time, $last_ctn);
    $stmt->execute();
}

?>