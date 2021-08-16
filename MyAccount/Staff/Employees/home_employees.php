<html>
<head>
<title>Employee Portal</title>
</head>

<?php
include("Session_Check.php");
?>

<body style="font-family: segoe UI; background-color: #efd19f"; background-size: cover">
<div style="background-color: #C6893F; height: 50px; margin: -8px -8px 0px -8px; "></div>
<div style="float: right; background-color: black; width: 130px; height: 200px; border-radius: 100px; margin: -60px 100px 0px -8px; "></div>
<div style="float: right; background-color: white; border-radius: 50px; margin: 25px -106px 0px 0px; "><a href="TheTeaCulture.php"><img src="../TEA CULTURE LOGO 9.png" width="100px"></div>
<link rel="stylesheet" href="w3.css">
<div class="w3-display-topmiddle w3-container w3-padding-large w3-center">
<br><br>
<a href="../logout.php" class="logout" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" style="color: black;" onclick="return confirm('Are you sure you want to EXIT?');">Log out</a><br><br>


<?php
//session_start();
connect();
function connect(){
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "theteacultureph";
	$Num = $_SESSION['EmployeeNumber'];
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}	
	
	$sql = "SELECT EmployeeName FROM users WHERE EmployeeNumber = '$Num'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<h1 style='font-family: Claytonia, cursive;'>Welcome " . $row["EmployeeName"]. "</h1><br>";
		}
	}
		
	$conn->close();
}
?>
<form action='ViewTimeTable.php' method='post'>
<input type='submit' value='View Time Table'/></form>
<form action='AddTimeTableUpdated.php' method='post'>
<input type='submit' value='Add Time Table'/></form>
<form action='ViewNetPay.php' method='post'>
<input type='submit' value='View Net Pay'/></form>
</div>
</body>
</html>