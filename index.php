<?php
    session_start();
    if(isset($_SESSION['UserID']) != "") {
        print("<script>location.href = 'home.php';</script>");
    } else {

    }
?>
<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="utf-8" />

        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <meta name="robots" content="noindex,nofollow" />

        <meta name="description" content="超まいくらひろば壁紙コンテスト・投票システム" />
        <title>MHVote2018</title>
    </head>
    <body>
        <h2>ログイン</h2>
        <form action="logindo.php" method="POST">
            <p>ユーザID</p>
            <input type="text" name="UserID">
            <br>
            <p>パスワード</p>
            <input type="password" name="Password">
            <input type="submit" value="送信">
        </form>
    </body>
</html>
