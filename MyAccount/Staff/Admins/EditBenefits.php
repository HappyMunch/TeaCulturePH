<html>
<head>
<title></title>
<head>

<?php
include("Session_Check_Admin.php");
?>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "theteacultureph2";
$id = $_POST["index"];
$data = $_POST['code'];
$change = $_POST["Change"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE `benefits` SET `$id` = '$change' WHERE id = 0";

if ($conn->query($sql) === TRUE) {
    echo "<SCRIPT> //not showing me this
			alert('Data Updated Successfully')
			window.location.replace('Benefits.php');
			</SCRIPT>";
}			
	else {
		echo "<SCRIPT> //not showing me this
			alert('Error updating database returning to Admin Home Page')
			window.location.replace('home_admins.php');
			</SCRIPT>";
}			
$conn->close();
?>
</html>