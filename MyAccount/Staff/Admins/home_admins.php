<html>
<head>
<title>Admin Portal</title>
</head>

<?php
include("Session_Check_Admin.php");
?>

<body>
<body style="font-family: segoe UI; background-color: #efd19f"; background-size: cover">
<div style="background-color: #C6893F; height: 50px; margin: -8px -8px 0px -8px; "></div>
<div style="float: right; background-color: black; width: 130px; height: 200px; border-radius: 100px; margin: -60px 100px 0px -8px; "></div>
<div style="float: right; background-color: white; border-radius: 50px; margin: 25px -106px 0px 0px; "><a href="TheTeaCulture.php"><img src="../TEA CULTURE LOGO 9.png" width="100px"></div>
<link rel="stylesheet" href="w3.css">
<div class="w3-display-topmiddle w3-container w3-padding-large w3-center">
<br><br>
<a href="../logout.php" class="logout" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" style="color: black;" onclick="return confirm('Are you sure you want to EXIT?');">Log out</a><br><br>

<?php
connect();
function connect(){
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "theteacultureph2";
	$Num = $_SESSION['username'];
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}	
	
	$sql = "SELECT username FROM admins WHERE username = '$Num'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		echo "<h1 style='font-family: Claytonia, cursive;'>Welcome " . $row["username"]. "</h1><br>";
		}
	}
		
	$conn->close();
}
?>
<form action='GeneratePayroll.php' method='post'>
<input type='submit' value='Generate Employees Payrolls'/></form>
<form action='Registration.php' method='post'>
<input type='submit' value='Add New Employee'/></form>
<form action='Benefits.php' method='post'>
<input type='submit' value='Employee Benefits'/></form>
<form action='EditInformation.php' method='post'>
<input type='submit' value='Update Employee Information'/></form>
</div>
</body>
</html>