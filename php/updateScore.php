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
    setTimeout(function() {
        window.location.href = 'http://127.0.0.1/PHP_ginnychen19.github.io/BullsAndCows.php';
    }, 5000);

</script>
</body>
</html>

<?php require('./db.php'); ?>
<?php
/*得到使用者資訊，並存入變數 */
$user_id = "1";
$last_ctn = $_GET['last_ctn'];
$last_time = $_GET['last_time'];

$sql= 'INSERT INTO `score` (`id`, `Utime`, `Ucount`) VALUES (?,?,?);';

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ssi', $user_id, $last_time, $last_ctn);
$stmt->execute();
?>



