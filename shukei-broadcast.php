<!DOCTYPE HTML>
<html>
	<head>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="stylesheet" href="sb.css" />
		<title>放送用集計画面</title>
	</head>
	<body>
		<?php
			require_once('config/config.php');
			session_start();
			if(isset($_GET['reset']))
			{
				unset($_SESSION['now']);
				header('Location: '.$_SERVER['SCRIPT_NAME']);
			}
			elseif(empty($_SESSION['now']))
			{
				$_SESSION['now'] = 1;
			}
			else
			{
				$now = &$_SESSION['now'];
				$sql = mysqli_query($db_link, "SELECT COUNT(*) AS num FROM mvote_kabegami");
				$count = mysqli_fetch_assoc($sql);

				if($count === $now)
				{
					$now = 1;
				}
				else
				{
					$now += 1;
				}
			}
			$kabeprev = $_SESSION['now'] - 1;

			$sqlbun = "SELECT KabegamiID, KabegamiName, KabegamiAuthor, Voting FROM mvote_kabegami ORDER BY Voting DESC LIMIT 1 OFFSET ".$kabeprev;

			$sql = mysqli_query($db_link, $sqlbun);
			$result = mysqli_fetch_assoc($sql);

			$prevvoting = $_SESSION['prevvoting'];
			if($prevvoting == $result["Voting"])
			{
				$rank++;
			}
			else
			{
				$rank = $realrank;
			}
			$_SESSION['prevvoting'] = $result["Voting"];

		?>
		<style>
			body {
				background-image: url(img/<?php print($result['KabegamiID']); ?>.png);
				background-size: 100vw auto;
    			background-repeat: no-repeat;
			}
		</style>
		<div id="zyunitoka">
			<div class="rank"><?= $rank ?>位</div>
			<?php
				$KabegamiID = $result['KabegamiID'];
				$sql = mysqli_query($db_link, "SELECT KabegamiName, KabegamiAuthor, Voting FROM mvote_kabegami WHERE KabegamiID = '$KabegamiID' ORDER BY Voting DESC ");
				$result2 = mysqli_fetch_assoc($sql);
			?>
			<sakusyamei><b><?php print($result2['KabegamiAuthor']); ?></b></sakusyamei><br>
			<titlemei><b><?php print($result2['KabegamiName']); ?></b></titlemei><br>
			<span style="font-size: 5em; text-shadow: black 0 5px; -webkit-text-stroke: 2px #000;"><b><?php print($result2['Voting']); ?></span></b><span style="font-size: 3em; -webkit-text-stroke: 2px #000;">票</span>
	</body>
</html>