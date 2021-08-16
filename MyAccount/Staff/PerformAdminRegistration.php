<html>
<head>
<title></title>
</head>

<body>
<a href = "Home.html">Home</a>
<br>
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
	
	$Username = $_POST["username"];
	$Password = $_POST["password"];
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if(mysqli_connect_error())
		die("Connection failed".mysqli_connect_error());
		else echo "Connected Successfuly"."<br>";
	
	$sql = "INSERT INTO admins VALUES ( '', '$Username', '$Password')";
	if($conn->query($sql) === TRUE)
		echo "<SCRIPT> //not showing me this
			alert('Registered Successfully')
			window.location.replace('SecretLogin.php');
			</SCRIPT>";
		else echo "<SCRIPT> //not showing me this
			alert('Error creating database returning to My Account Page')
			window.location.replace('logout.php');
			</SCRIPT>";
	$conn->close();
}
?>

</html>
