<?php
    session_start();
    if(isset($_SESSION['UserID']) == "") {
        print("<script>location.href = 'index.php';</script>");
    } else {
        $id = $_GET['id'];
        require_once('config/config.php');
        $sql = mysqli_query($db_link, "INSERT INTO mvote_vote VALUES ('$id')");
        $sql = mysqli_query($db_link, "UPDATE mvote_kabegami SET Voting = Voting + 1 WHERE KabegamiID = '$id'");
        print('<script>location.href = "home.php";</script>');
    }
?>