<?php
    session_start();
    if(isset($_SESSION['UserID']) == "") {
        print("<script>location.href = 'index.php';</script>");
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
        <link rel="stylesheet" href="main.css" />
    </head>
    <body>
        <a href="logout.php">ログアウト</a><br>
        <a href="shukei.php">集計画面を見る</a>
        <a href="shukei-textonly.php">簡易集計画面を見る</a>
        <h2>投票</h2>
        <table border="1" class="table-width">
            <?php
                require_once('config/config.php');
                $sql = mysqli_query($db_link, "SELECT * FROM mvote_kabegami");
                $number = 0;
                print("<tr>");
                while ($result = mysqli_fetch_assoc($sql)) {
                    print('<td class="cell-button"><a href="votedo.php?id='.$result['KabegamiID'].'"><font size="10"><b>'.$result['KabegamiID'].'</b></font></a></td>');
                    $number = $number + 1;
                    if($number == 5) {
                        print("</tr><tr>");
                        $number = 0;
                    }
                }
            ?>
        </table>
        <div id="hanbun">
            <br>
            <table class="table-width">
                <tr><th>作品名</th><th>票数</th></tr>
                <?php
                    require_once('config/config.php');
                    $sql = mysqli_query($db_link, "SELECT * FROM mvote_kabegami");
                    while ($result = mysqli_fetch_assoc($sql)) {
                        $KabegamiID = $result['KabegamiID'];
                        $sql2 = mysqli_query($db_link, "SELECT COUNT(*) AS num FROM mvote_vote WHERE KabegamiID = '$KabegamiID'");
                        $result2 = mysqli_fetch_assoc($sql2);
                        print('<tr><th>'.$result['KabegamiName'].'</th><td>'.$result2['num'].'</td></tr>');
                    }
                ?>
            </table>
        </div>
    </body>
</html>