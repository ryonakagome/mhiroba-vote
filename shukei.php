<!DOCTYPE HTML>
<html charset="UTF-8" lang="ja">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="集計ページ" />
        
        <title>集計結果 - 超まいくらひろば2018</title>

        <link rel="stylesheet" href="shukei.css">
        <meta http-equiv="Refresh" content="60">
    </head>
    <body bgcolor="black">
        <div id="shukei">
            <?php
                require_once('config/config.php');
                $sql = mysqli_query($db_link, "SELECT KabegamiID, Voting, KabegamiName, KabegamiAuthor FROM mvote_kabegami ORDER BY Voting DESC");
                $result = mysqli_fetch_assoc($sql);
            ?>
            <style>
                #shukei {
                    background-image: url('img/<?php print($result['KabegamiID']);?>.png');
                }
            </style>
            <div id="shukei-midashi">
                <br><br><br><br><br><br>
                <font size="7"><?php print($result['KabegamiAuthor']); ?></font>
                <br>
                <font size="10"><b><?php print($result['KabegamiName']); ?></b></font>
                <br>
                <font size="7"><b><?php print($result['Voting']); ?></b></font><font size="5">票</font>
            </div>
        </div>
        <div id="shukei-nagashi">
            <?php
                $sql = mysqli_query($db_link, "SELECT KabegamiName, KabegamiAuthor, Voting FROM mvote_kabegami ORDER BY Voting DESC");
                print('<marquee scrollamount="15"><h2>');
                $number = 0;
                while($result = mysqli_fetch_assoc($sql)) {
                    $number = $number + 1;
                    print($number."位　".$result['KabegamiAuthor']."-".$result['KabegamiName']."　".$result['Voting']."票,　");
                }
                print('</h2></marquee>');
            ?>
        </div>
    </body>
</html>