<?php
    session_start();
    if(isset($_SESSION['UserID']) != "") {
        print("<script>location.href = 'home.php';</script>");
    } else {
        $UserID = $_POST['UserID'];
        $Password = $_POST['Password'];

        require_once('config/config.php');

        $e_UserID = $db_link -> real_escape_string($UserID);
        $e_Password = $db_link -> real_escape_string($Password);

        $sql = mysqli_query($db_link, "SELECT * FROM mvote_user WHERE UserID = '$e_UserID'");
        $result = mysqli_fetch_assoc($sql);

        if ($e_UserID == $result['UserID'] and password_verify($e_Password, $result['Password'])) {
            $_SESSION['UserID'] = $e_UserID;
            print('<script>location.href = "home.php";</script>');
        } else {
            print('<script>alert("ユーザIDかパスワードが違います。"); location.href = "index.php";</script>');
        }
    }
?>