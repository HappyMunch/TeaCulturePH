<html>
	<head>
	<title></title>
	</head>
	
<?php
include("Session_Check_Admin.php");
?>

	<body style="font-family: segoe UI; background-color: #efd19f; background-size: cover;">
		<div style="background-color: #C6893F; height: 20px; margin: -8px -8px 0px -8px; "></div>
		<div style="float: left; width: 22%; margin: 15px 0px 0px 100px ; background-color: white; text-align: center; padding: 30px;">
		<form method = "POST" action = "PerformRegister.php">
			<p style="color: black; font-family: Claytonia, cursive; font-size: 25px">REGISTRATION</p>
			<label for="StudentNumber" style="color: black;">Employee Number: </label><br>
			<input type = "text" name = "EmployeeNumber" pattern="[0-9]+" placeholder="Employee Number" required>
			<br><br>
			<span style="color: black;">Last Name: </span><br>
			<input type = "text" name = "LastName" placeholder="Last Name" required>
			<br><br>
			<span style="color: black;">First Name: </span><br>
			<input type = "text" name = "FirstName" placeholder="First Name" required>
			<br><br>
			<span style="color: black;">Password: </span><br>
			<input type = "password" name = "password" placeholder="password" required>
			<br><br>

			<label for="SSSYes">SSS Member?</label><br>
			<input type="radio" id="SSSYes" name="SSS" value="Yes" required>
			<label for="SSSYes">Yes</label>
			<input type="radio" id="SSSNo" name="SSS" value="No" required>
			<label for="SSSNo">No</label><br>
			<label for="PagIbigYes">PagIbig Member?</label><br>
			<input type="radio" id="PagIbigYes" name="PagIbig" value="Yes" required>
			<label for="PagIbigYes">Yes</label>
			<input type="radio" id="PagIbigNo" name="PagIbig" value="No" required>
			<label for="PagIbigNo">No</label><br>
			<label for="PhilHealthYes">PhilHealth Member?</label><br>
			<input type="radio" id="PhilHealthYes" name="PhilHealth" value="Yes" required>
			<label for="PhilHealthYes">Yes</label>
			<input type="radio" id="PhilHealthNo" name="PhilHealth" value="No" required>
			<label for="PhilHealthNo">No</label><br><br>
			
			<span style="color: black;">Days of Work a Week?: </span><br>
			<input type = "int" name = "DaySchedule" placeholder="0" required><br>
			<span style="color: black;">Hours a Week?: </span><br>
			<input type = "int" name = "HourSchedule" placeholder="0" required>
			<br><br>
			
			<input type="submit" value="Submit" style="background-color: #C6893F; color: white; border: hidden; padding: 10px 35px; border-radius: 20px;">
			
		</form>
		<p style="color: black"> <a href="home_admins.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='#C6893F'" style="color: #C6893F;"> Home</a></p>
		</div>
		<div style="float: right; background-color: black; width: 130px; height: 200px; border-radius: 80px; margin: -60px 100px 0px -8px; "></div>
		<div style="float: right; background-color: white; border-radius: 50px; margin: 25px -106px 0px 0px; "><a href="TheTeaCulture.php"><img src="../TEA CULTURE LOGO 9.png" width="100px"></div>
	</body>
</html>