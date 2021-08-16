<html>
<head>
<title></title>
</head>

<?php
include("Session_Check_Admin.php");
?>

<body>

</body>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
connect();
}
function connect(){
	//StudentID varchar (10) primary key, kulang pa
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "theteacultureph2";
	$EmployeeNumber = $_POST["EmployeeNumber"];
	$LastName = $_POST["LastName"];
	$FirstName = $_POST["FirstName"];
	$SSS = $_POST["SSS"];
	$PagIbig = $_POST["PagIbig"];
	$PhilHealth = $_POST["PhilHealth"];
	$Password = $_POST["password"];
	$DaySchedule = $_POST["DaySchedule"];
	$HourSchedule = $_POST["HourSchedule"];
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if(mysqli_connect_error())
		die("Connection failed".mysqli_connect_error());
		else echo "Connected Successfuly"."<br>";
	
	/*$sql = "INSERT INTO students VALUES ( '$StudentNumber', '$Section', '$Password')";
	if($conn->query($sql) === TRUE){
		echo "Database created successfully";
		echo "<input type='hidden' value='$StudentNumber' name='d0'>";
		header('Location: 1st_Page_Form.php');
	}
	else echo "Error creating database: ".$conn->error;*/
	$sql = "INSERT INTO users VALUES ( '$EmployeeNumber', '$LastName', '$FirstName', '$SSS', '$PagIbig', '$PhilHealth', '$DaySchedule', '$HourSchedule', '$Password')";
	if($conn->query($sql) === TRUE)
		echo "<SCRIPT> //not showing me this
			alert('Registered Successfully')
			window.location.replace('home_admins.php');
			</SCRIPT>";
		else echo "<SCRIPT> //not showing me this
			alert('Error creating database returning to Admins Home Page')
			window.location.replace('home_admins.php');
			</SCRIPT>";
	$conn->close();
}
?>

</html>
