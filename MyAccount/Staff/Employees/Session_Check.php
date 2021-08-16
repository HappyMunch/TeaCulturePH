<?php
    session_start();
    if(!isset($_SESSION["EmployeeNumber"])) {
        header("Location: ../Error_Page.php");
        exit();
    }
?>