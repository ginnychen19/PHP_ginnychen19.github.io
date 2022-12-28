<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @font-face {
            font-family: "GenJyuuGothic-B";
            src: url("../ttc/GenSenRounded-B.ttc");
        }

        body {
            background-color: #41582b;
            display: flex;
            flex-direction: column;
            justify-content: center;
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
            width: fit-content;
            color: #ffffff;
            font-family: "GenJyuuGothic-B";
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #89b079;
            padding: 20px 50px;
            border-radius: 20px;
        }

        .ans {
            width: fit-content;
            color: #ffffff;
            font-family: "GenJyuuGothic-B";
            background-color: #ed6a6a;
            margin: 30px 0 0 0;
            padding: 20px 50px;
            border-radius: 10px;
        }

        form {
            color: #ffffff;
            font-family: "GenJyuuGothic-B";
        }

        form>input {
            margin: 0 0 15px 0;
        }
    </style>

</head>
<html>

<body>
    <div>
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

/* isset( ) 用來判斷一個變數是否已設定並有值。
如果變數已設定並有值，isset() 函數會回傳 true；
否則，它會回傳 false。
*/
if (isset($_POST["user_uid"])) {

    /*得到使用者資訊，並存入變數 */
    $user_uid = strtoupper(trim($_POST["user_uid"]));
    $user_pwd = trim($_POST["user_pwd"]);
    $user_name = trim($_POST["user_name"]);

    $sql = 'select err, description from (
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

    echo "<div class=ans >$des</div>";

}
;
?>