<?php
    if(!isset($_SESSION["AdminPassword"]) || $_SESSION["AdminPassword"] != "TeaCultureAdmins") {
        echo "<SCRIPT> //not showing me this
			alert('Access Denied Returning to My Account Page')
			window.location.replace('../My Account.php');
			</SCRIPT>";
        exit();
    }
?>