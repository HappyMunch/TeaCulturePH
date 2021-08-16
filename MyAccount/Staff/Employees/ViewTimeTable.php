<html>
<head></head>

<body style="font-family: segoe UI; background-color: #efd19f"; background-size: cover">
<div style="background-color: #C6893F; height: 50px; margin: -8px -8px 0px -8px; "></div>
<div style="float: right; background-color: black; width: 130px; height: 200px; border-radius: 100px; margin: -60px 100px 0px -8px; "></div>
<div style="float: right; background-color: white; border-radius: 50px; margin: 25px -106px 0px 0px; "><a href="TheTeaCulture.php"><img src="../TEA CULTURE LOGO 9.png" width="100px"></div>
<link rel="stylesheet" href="w3.css">
<div class="w3-display-topmiddle w3-container w3-padding-large w3-center">
<br><br>
<a href = "home_employees.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" style="color: black;">Home</a>

<h1>Welcome to the Time Table Viewing Page<h1>
<br>
<?php
include("Session_Check.php");
?>

	<?php
		   $servername = "localhost";
		   $username = "root";
		   $password = "";
		   $database = "theteacultureph2";
		   $EN = $_SESSION["EmployeeNumber"];
		   // Create connection
		   $conn = new mysqli($servername, $username, $password, $database);
		   // Check connection
		   if ($conn->connect_error) {
			 die("Connection failed: " . $conn->connect_error);
		   }
		   $result = mysqli_query($conn, "SELECT EmployeeNumber, DATE_FORMAT(WorkDate, '%M %d, %Y') AS WorkDate, TimeIn, TimeOut, Hours, BasicPay, HolidayPay, OvertimePay, GrossPay FROM employees WHERE EmployeeNumber = '$EN'");
		   $all_property= array();
		   
		   if($result->num_rows > 0){
			echo '<table class= "w3-table-all w3-centered">
			<tr class = "data-heading">';
	
			while($property= mysqli_fetch_field($result)){
				echo '<td>'.$property->name. '</td>';
				array_push($all_property, $property->name );
			}
			echo '</tr>';
			while($row= mysqli_fetch_array($result)){
				echo '<tr>';
				foreach ($all_property as $item){
					echo '<td>'.$row[$item].'</td>';
				}
				echo '</tr>';
			}
			echo '</table>';
			}
			else echo "Database is empty";
	
			$conn->close();
				
	?>
</body>
</div>
</html>	