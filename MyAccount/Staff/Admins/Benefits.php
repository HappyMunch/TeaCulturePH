<html>
<head></head>

<?php
include("Session_Check_Admin.php");
?>

<body style="font-family: segoe UI; background-color: #efd19f"; background-size: cover">
<div style="background-color: #C6893F; height: 50px; margin: -8px -8px 0px -8px; "></div>
<div style="float: right; background-color: black; width: 130px; height: 200px; border-radius: 100px; margin: -60px 100px 0px -8px; "></div>
<div style="float: right; background-color: white; border-radius: 50px; margin: 25px -106px 0px 0px; "><a href="TheTeaCulture.php"><img src="../TEA CULTURE LOGO 9.png" width="100px"></div>
<link rel="stylesheet" href="w3.css">
<div class="w3-display-topmiddle w3-container w3-padding-large w3-center">
<br><br>
<a href = "home_admins.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" style="color: black;">Home</a>

<h1>Welcome to the Benefits Page<h1>
<br>

	<?php
		   $servername = "localhost";
		   $username = "root";
		   $password = "";
		   $database = "theteacultureph2";
		   // Create connection
		   $conn = new mysqli($servername, $username, $password, $database);
		   // Check connection
		   if ($conn->connect_error) {
			 die("Connection failed: " . $conn->connect_error);
		   }
		   $sql = "INSERT INTO benefits VALUES ( '0', '', '', '' )";
		   if($conn->query($sql) === TRUE)
			{
				//created
			}
		   $result = mysqli_query($conn, "SELECT * FROM benefits");
		   $all_property= array();
		   
		   if($result){
			   $result = mysqli_query($conn, "SELECT SSS, PagIbig, PHIC FROM benefits");
				$all_property= array();
		   
				if($result->num_rows > 0){
				echo '<table class= "w3-table-all w3-centered">
				<tr class = "data-heading">';
	
				while($property= mysqli_fetch_field($result)){
					echo '<td>'.$property->name. '</td>';
					array_push($all_property, $property->name );
				}
				echo '<td>'."Edit Benefits Here". '</td>';
				echo '</tr>';
				while($row= mysqli_fetch_array($result)){
					echo '<tr>';
					foreach ($all_property as $item){
						echo '<td>'.$row[$item].'</td>';
					}
					echo "<td><form method=\"post\" action=\"EditBenefits.php\">
					<select name=\"index\">
					<option value=\"SSS\">SSS</option>
					<option value=\"PagIbig\">Pag Ibig</option>
					<option value=\"PHIC\">Phil-Health</option>
					</select>
					<input name=\"code\" type=\"hidden\" value=\"1\">
					<input name=\"Change\" type=\"text\">
					<input name=\"submit\" type=\"submit\" value=\"Edit\"></form></td>";
					echo '</tr>';
				}
				echo '</table>';
				}
				else echo "Database is empty";
	
				$conn->close();
		    }
		   
		   else{
			    $sql = "INSERT INTO benefits VALUES ( '0', '', '', '' )";
				if($conn->query($sql) === TRUE)
				{
					echo "Benefits initialized";
				}
		   }
		   
		   
				
	?>

</body>
</div>
</html>	