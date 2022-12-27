<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>猜數字遊戲</title>
    <link href="./img/marijuana.png" rel="icon" type="image/png">
    <link rel="stylesheet" href="./node_modules/animate.css/animate.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <script src="//unpkg.com/jquery"></script>
    <style>
        @font-face {
            font-family: "GenJyuuGothic-B";
            src: url("../ttc/GenSenRounded-B.ttc");
        }

        body {
            background-color: #41582b;
            display: flex;  
            flex-direction: column; 
            justify-content:center;
            align-items: center;
        }

        h1 {
            color: #ffffff;
            font-family: "GenJyuuGothic-B";
        }

        p {
            color: #ffffff;
            font-family: "GenJyuuGothic-B";
        }

        div {
            width:fit-content;
            color: #ffffff;
            font-family: "GenJyuuGothic-B";
            display: flex; 
            flex-direction: column; 
            align-items:center;
            background-color: #89b079;
            padding: 20px 50px;
            border-radius: 20px;
        }

        .ans{
            width:fit-content;
            color: #ffffff;
            font-family: "GenJyuuGothic-B";
            background-color: #ed6a6a;
            margin:30px 0 0 0;
            padding: 20px 50px;
            border-radius: 10px;
        }
        form {
            color: #ffffff;
            font-family: "GenJyuuGothic-B";
        }
        form>input{
            margin: 0 0 15px 0;
        }
    </style>

</head>
<body>
<!--這段ok囉-->
<table border="1">
    <thead>
        <tr>
            <td>名次</td>
            <td>玩家們大名</td>
            <td>使用回合</td>
        </tr>
    </thead>

    <tbody>
    <?php
    require('./php/db.php'); 
    $sql = "select * from vw_allscoreinfo;";
    $result = $mysqli->query($sql);
    $total_records = mysqli_num_rows($result);
    
    for ($i = 0; $i < $total_records; $i++){
        // 取得產品資料
        $row = mysqli_fetch_assoc($result);
        // 顯示產品各欄位的資料
     
        echo "<tr>";
        echo "<td>名次</td>";
        echo "<td>" . $row["Uname"] . "</td>";
        echo "<td>" . $row["Utime"] . "</td>";		
        echo "</tr>";
        }
    ?>
    </tbody>

</table>

    

<div>
<h1>帳號申請</h1>
<form action="BullsAndCows.php" method="post" enctype="multipart/form-data">
<label for="user_uid">請輸入帳號：</label>
<input type="text" id="user_uid" name="user_uid" required>
<br>
<label for="user_name">請輸入姓名：</label>
<input type="text" id="user_name" name="user_name" required>
<br>
<label for="user_pwd">請輸入密碼：</label>
<input type="password" id="user_pwd" name="user_pwd" required>
<br>
<input type="submit" value="送出" >
</form>
</div>

</body>
</html>


<?php require('./php/db.php'); ?>
<?php

/* isset( ) 用來判斷一個變數是否已設定並有值。
如果變數已設定並有值，isset() 函數會回傳 true；
否則，它會回傳 false。
*/ 
if( isset($_POST["user_uid"]) ){

/*得到使用者資訊，並存入變數 */
$user_uid = strtoupper(trim($_POST["user_uid"]));
$user_pwd = trim($_POST["user_pwd"]);
$user_name = trim($_POST["user_name"]);

$sql= 'select err, description from (
    select sf_register(?, ?, ?) as err
    ) as a, errorlist
where a.err = errorlist.id';

$stmt = $mysqli->prepare($sql);
$stmt->bind_param('sss', $user_uid, $user_pwd, $user_name);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();

$err = $row['err'];
$des = $row['description'];

echo "<div class=ans >$err $des</div>";

}; 
?>
    
