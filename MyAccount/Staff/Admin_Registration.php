<html>
	<head>
	<title></title>
	</head>
	
	<?php
	session_start();
	if(isset($_POST["adminpassword"])){
		$_SESSION["AdminPassword"] = $_POST["adminpassword"];
	}
	include("Session_Check.php");
	
	
	?>

	<body style="font-family: segoe UI; background-color: #efd19f; background-size: cover;">
		<div style="background-color: #C6893F; height: 20px; margin: -8px -8px 0px -8px; "></div>
		<div style="float: left; width: 22%; margin: 100px 0px 0px 100px ; background-color: white; text-align: center; padding: 30px;">
		<form method = "POST" action = "PerformAdminRegistration.php">
			<p style="color: black; font-family: Claytonia, cursive; font-size: 25px">REGISTRATION</p>
			<label for="StudentNumber" style="color: black;">Username: </label><br>
			<input type = "text" name = "username"  placeholder="Username" required>
			<br><br>
			<span style="color: black;">Password: </span><br>
			<input type = "password" name = "password" placeholder="Password" required>
			<br><br><br>
			
			<input type="submit" value="Submit" style="background-color: #C6893F; color: white; border: hidden; padding: 10px 35px; border-radius: 20px;">
			<br><br>
		</form>
		<p style="color: black"> <a href="SecretLogin.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='#C6893F'" style="color: #C6893F;"> Back to Login</a></p>
		<p style="color: black"> <a href="logout.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='#C6893F'" style="color: #C6893F;"> Home</a></p>
		</div>
		<div style="float: right; background-color: black; width: 130px; height: 200px; border-radius: 80px; margin: -60px 100px 0px -8px; "></div>
		<div style="float: right; background-color: white; border-radius: 50px; margin: 25px -106px 0px 0px; "><a href="TheTeaCulture.php"><img src="TEA CULTURE LOGO 9.png" width="100px"></div>
	</body>
</html>