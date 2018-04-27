<?php
    session_start();
    if(empty($_SESSION['UserID'])) {
        header("Location: ../index.php");
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
        <h2>集計結果</h2>
        <table border="1">
        	<tr><th>順位</th><th>作品名</th><th>作者</th><th>票数</th></tr>
            <?php
                require_once(__DIR__."/../class/Kabegami.php");
                $Kabegami = new mhiroba\Kabegami();
                
                $KabegamiList = $Kabegami->getKabegamiList();
                $rank = 0;
                foreach($KabegamiList as $KabegamiID):
                    $KabegamiItem = $Kabegami->getKabegamiInfo($KabegamiID);
                    $rank++;
            ?>
                    <tr><td><?= $rank ?></td><td><?= $KabegamiItem["KabegamiName"]?></td><td><?= $KabegamiItem["KabegamiAuthor"] ?></td><td><?= $KabegamiItem["Voting"] ?></td></tr>

            <?php
                endforeach;
            ?>
        </table>
    </body>
</html>