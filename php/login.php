<?php require('./db.php'); ?>
    <?php
    /* 取得使用者輸入的帳號與密碼，   
    送到資料庫判斷是否有這"一"筆，把結果存到result
    若有這"一"行，也就是驗證通過
    設定一個key為uid的cookie，內容放置使用者輸入的id，並且壽命只有3秒
    我希望在此期間會輸出你好"使用者名稱"；但結束後會只剩下你好。
    */
    /*新測試，在index就檢查驗證是否通過，若通過就轉址到這裡，輸出使用者你好
    然後10秒鐘後再次打開看*/
    if (isset($_POST["user_uid"])) {
        $uid = trim($_POST['user_uid']);
        $pwd = trim($_POST['user_pwd']);
        $sql = "select * from userinfo where uid = ? and pwd = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param('ss', $uid, $pwd);
        $stmt->execute();
        $result = $stmt->get_result();


        /* 如果有驗證成功，維持登陸成功兩分鐘*/
        if ($result->num_rows == 1) {
            /* $_SESSION['uid'] = $uid; */
            setcookie("uid", $uid, time() + 120);
            $user = $_COOKIE["uid"];
            echo ("<p>你好$user</p>");

        } else {
            /*  header('location:error.php'); */
            // 判斷是否是帳號或密碼錯誤
            $sql = "select * from userinfo where uid = ?";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param('s', $uid);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                // 密碼錯誤
                echo ("<p>密碼錯誤</p>");
            } else {
                // 帳號不存在
                echo ("<p>沒有此帳號</p>");
            }
        }
    }
    ?>