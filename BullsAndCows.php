<?php
session_start();
if (isset($_COOKIE["uid"])) {
    $_SESSION["uid"] = $_COOKIE["uid"];
    setcookie("uid", $_COOKIE["uid"], time() + 120);
}
?>
<?php
if (isset($_COOKIE["uid"])) {
    echo ("<p>你好" . $_COOKIE["uid"] . "~</p>");
}
?>
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
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <!--帳號登入-->
    <div id="login" style="display: none;">
        <div id="close">
            <h6>x</h6>
        </div>
        <div>
            <h4>登入</h4>
            <form action="./php/login.php" method="post" enctype="multipart/form-data">
                <label for="user_uid">請輸入帳號：</label>
                <input type="text" id="user_uid" name="user_uid" required>
                <br>
                <label for="user_pwd">請輸入密碼：</label>
                <input type="password" id="user_pwd" name="user_pwd" required>
                <br><br><br>
                <input type="submit" value="送出">
            </form>
        </div>
    </div>


    <!--帳號註冊-->
    <div id="register" style="display: none;">
        <div id="close">
            <h6>x</h6>
        </div>
        <div>
            <h4>註冊</h4>
            <form action="./php/register.php" method="post" enctype="multipart/form-data">
                <label for="user_uid">請輸入帳號：</label>
                <input type="text" id="user_uid" name="user_uid" required>
                <br>
                <label for="user_name">請輸入姓名：</label>
                <input type="text" id="user_name" name="user_name" required>
                <br>
                <label for="user_pwd">請輸入密碼：</label>
                <input type="password" id="user_pwd" name="user_pwd" required>
                <br><br><br>
                <input type="submit" value="送出">
            </form>
        </div>
    </div>

    <!--遊戲區-->
    <div class="Title">
        <h1>大麻教繪-猜數字小遊戲</h1>
    </div>
    <div id="BACgame">
        <div class="MyGirl" style="padding: 0px;">
            <div class="bg" id="btn_start">
                <div>
                    <div class="dialogue" style="display:none; top: 120px; margin: 20px;">
                        <?php
                        if (isset($_COOKIE["uid"])) {
                            echo ("<p>你好" . $_COOKIE["uid"] . "~</p>");
                        }
                        ?>
                        <h6 id="dialogueText"></h6>
                        <div class="ans" style="display:none">
                            <a id="ans01" href=" ">
                                <button id="ans01"></button>
                            </a>
                            <a id="ans02" href=" ">
                                <button id="ans02"></button>
                            </a>
                        </div>
                    </div>
                    <img id="MyG" src="./img/svg/MyG_TalkLU_ANI02.svg">
                </div>
            </div>
        </div>
        <div class="game">
            <div class="gameBar" style="flex: 1;">
                <div>
                    <button id="btn_login" class="btn">登入</button>
                    <button id="btn_out" class="btn">登出</button>
                    <button id="btn_register" class="btn">註冊</button>
                </div>
                <div>
                    <button id="btn_restart" class="btn">重新開始</button>
                    <button id="btn_lookAns" class="btn">查看答案</button>
                    <button id="btn_update" class="btn">上傳成績</button>
                </div>
            </div>
            <div class="gameText" style="flex: 8;">
                <div style="flex: 1;">
                    <p>A表示數字對，位置也對/B表示數字對，但位置不對。</p>
                    <div>
                        <p id="passTime">目前用時</p>
                    </div>
                </div>
                <ul id="show_check" style="flex: 8;">
                </ul>
                <div style="flex: 1;">
                    <input type="text" id="input_answer" name="myAns" required >
                    <button id="btn_checkAns" class="btn">檢查答案</button>
                </div>
            </div>
        </div>
    </div>

    <!--排名區-->
    <div id="Rank">
        <div>
            <div class="RankText">
                <h4>TOP10 玩家</h4>
                <h6>找找有沒有你的名字吧？</h6>
            </div>
            <div class="RankList">
                <table>
                    <thead>
                        <tr>
                            <td>名次</td>
                            <td>玩家們大名</td>
                            <td>使用時間</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require('./php/db.php');
                        $sql = "select * from vw_rankscoreinfo;";
                        $result = $mysqli->query($sql);
                        $total_records = mysqli_num_rows($result);

                        for ($i = 0; $i < $total_records; $i++) {
                            // 取得產品資料
                            $row = mysqli_fetch_assoc($result);
                            // 顯示產品各欄位的資料
                            echo "<tr>";
                            echo "<td>" . $row["ranking"] . "</td>";
                            echo "<td>" . $row["Uname"] . "</td>";
                            echo "<td>" . $row["Utime"] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="./js/BullsAndCowsgame.js"></script>
    <script src="./js/BullsAndCowsTalk.js"></script>
    <script src="./js/BullsAndCows.js"></script>
</body>

</html>