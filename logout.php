<?php
    session_start();
    session_destroy();
    print("<script>location.href = 'index.php';</script>");
?>