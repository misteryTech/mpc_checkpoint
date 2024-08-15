<?php
    session_start();
    session_unset();
    session_destroy();


    header("location: ../police_login.php");
    exit();
?>