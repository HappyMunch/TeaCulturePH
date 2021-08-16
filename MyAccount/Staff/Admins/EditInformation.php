<html>
<head>
<title></title>
<head>
<style>
table, th, td{
	border: 2px solid black;
	width: 50%;
}
</style>
<body style="font-family: segoe UI; background-color: #efd19f"; background-size: cover">
<div style="background-color: #C6893F; height: 50px; margin: -8px -8px 0px -8px; "></div>
<div style="float: right; background-color: black; width: 130px; height: 200px; border-radius: 100px; margin: -60px 100px 0px -8px; "></div>
<div style="float: right; background-color: white; border-radius: 50px; margin: 25px -106px 0px 0px; "><a href="TheTeaCulture.php"><img src="../TEA CULTURE LOGO 9.png" width="100px"></div>
<link rel="stylesheet" href="w3.css">
<div class="w3-display-topmiddle w3-container w3-padding-large w3-center">
<br><br>
<a href = "home_admins.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" style="color: black;">Home</a>
<h1>Welcome to the Updating Employee Information Page<h1>
<h3>Select the Information to be Edited and fill in the correponding information<h3>
<br>

<?php
include("Session_Check_Admin.php");
?>


<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "theteacultureph2";
	$index = 0;

	$conn = new mysqli($servername, $username, $password, $database);
	
	$result = mysqli_query($conn, "SELECT  * FROM users");
	$all_property= array();
	
	if($result->num_rows > 0){
		echo '<table class= "w3-table-all w3-centered">
			<tr class = "data-heading">';
	
		while($property= mysqli_fetch_field($result)){
			echo '<td>'.$property->name. '</td>';
			array_push($all_property, $property->name );
		}

		echo '<td>'."Edit Information Here". '</td>';
		echo '</tr>';
		while($row= mysqli_fetch_array($result)){
			echo '<tr>';
			foreach ($all_property as $item){
				echo '<td>'.$row[$item].'</td>';
			}
			echo "<td><form id= \"$index\" method=\"post\" action=\"PerformEdit.php\">
			<select name=\"index\">
			<option value=\"EmployeeNumber\">Employee Number</option>
			<option value=\"LastName\">Last Name</option>
			<option value=\"FirstName\">First Name</option>
			<option value=\"SSS\">SSS</option>
			<option value=\"PagIbig\">PagIbig</option>
			<option value=\"Philhealth\">Philhealth</option>
			<option value=\"DaySchedule\">Day Schedule</option>
			<option value=\"HourSchedule\">Hour Schedule</option>
			<option value=\"password\">Password</option>
			</select>
			<input name=\"code\" type=\"hidden\" value=\"$row[0]\">
			<input name=\"Change\" type=\"text\">
			<input name=\"submit\" type=\"submit\" value=\"Edit\"></form></td>";
			echo '</tr>';
		}
		echo '</table>';
	}
	else echo "Database is empty";
	
	$conn->close();
?>
</div>
</body>
</html>