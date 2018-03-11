<?php
    $db_host = 'db.ticper.com';
    $db_user = 'mvote';
    $db_pass = 'yakiniki2001';
    $db_name = 'mvote2018';

    $db_link = new mysqli($db_host, $db_user, $db_pass, $db_name);
    mysqli_set_charset($db_link, 'utf8');

    if (mysqli_connect_errno()) {
        printf("Connect Failed:".mysqli_connect_error());
        exit();
    }