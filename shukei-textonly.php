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
        <h2>集計結果</h2>
        <table border="1">
        	<tr><th>順位</th><th>作品名</th><th>作者</th><th>票数</th></tr>
        	<?php
        		require_once('config/config.php');
        		$sql = mysqli_query($db_link, "SELECT KabegamiName, KabegamiAuthor, Voting FROM mvote_kabegami ORDER BY Voting DESC");
        		$juni = 0;
        		while($result = mysqli_fetch_assoc($sql)) {
        			$juni = $juni + 1;
        			print('<tr><td><b>'.$juni.'位</b></td><td>'.$result['KabegamiName'].'</td><td>'.$result['KabegamiAuthor'].'</td><td>'.number_format($result['Voting']).'票</td></tr>');
        		}
        	?>
        </table>
    </body>
</html>