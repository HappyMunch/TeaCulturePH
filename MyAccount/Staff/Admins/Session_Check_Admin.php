<?php
    session_start();
    if(!isset($_SESSION["username"])) {
        header("Location: ../Error_Page.php");
        exit();
    }
?>