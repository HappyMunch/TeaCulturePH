<html>
<head>
<title>Log In</title>
</head>

<script type="text/javascript"> var password = prompt("Please Input Key for Staff Access");
if (password != "password")
{
	alert("Password Incorrect Will Return to My Account Page");
	window.location.href = "../My Account.php";
}
</script>

<style>
body, h1, h2, h3, h4, h5, h6  {
  font-family: Claytonia, cursive ;
}
a:hover {
  color: red;
  background-color: transparent;
  text-decoration: underline;
}
</style>

<body style="font-family: segoe UI; background-color: #efd19f"; background-size: cover">
	<div style="background-color: #C6893F; height: 50px; margin: -8px -8px 0px -8px; "></div>
	<div style="float: right; background-color: black; width: 130px; height: 250px; border-radius: 80px; margin: -110px 100px 0px -8px; "></div>
	<div style="float: right; background-color: white; border-radius: 50px; margin: 20px -106px 0px 0px; "><a href="TheTeaCulture.php"><img src="TEA CULTURE LOGO 9.png" width="100px"></a></div>
	<form method = "POST" action = "<?php echo $_SERVER['PHP_SELF'];?>">
		<div style="color: black; font-family: Claytonia, cursive ; font-size: 35px; width: 300px; padding-left: 0px; margin: 95px 0px 0px 90px">LOG IN</div>
		<br>
		<div style="float: left; margin: 50px 0px 0px 60px">
			<input type = "text" name = "EmployeeNumber" placeholder="EmployeeNumber" style="padding: 15px 0px 15px 10px; width: 225px; font-size: 15px;">
			<br><br>
			<input type = "password" name = "password" placeholder="Password" style="padding: 15px 0px 15px 10px; width: 225px; font-size: 15px;">
			<br><br><br><br>

			<input type="submit" value="Log In" style="background-color: #C6893F; color: white; border: hidden; padding: 15px 50px; border-radius: 40px; margin-left: 30px; font-size: 20px;" >
			<br>
			<p style="color: black"> <a href="../My Account.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" style="color: black; border: hidden; padding: 15px 50px; border-radius: 40px; margin-left: 0px; font-size: 20px;">Return to Home</a></p>
		<br><br>
	</form>
	
	<form method = "POST" action = "SecretLogin.php">
	<input type = "password" name = "adminpassword" placeholder = "Password Required for Admin Access" style="padding: 15px 0px 15px 0px; width: 260px; font-size: 15px;">
	<br><br>
	<input type = "submit" value = "Admin Login" style="background-color: #C6893F; color: white; border: hidden; padding: 15px 50px; border-radius: 40px; margin-left: 0px; font-size: 20px;" >
	</form>
	</div>
	<div style="float: right; background-color: efd19f; margin: 45px -8px 0px 0px; "><img src="BLOB1.png" width="750px">
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
		$Password = $_POST["password"];
		
		//if($StudentNumber == "00GuidanceOffice11" && $Password == "Wecareforourstudents")
		//{
		//	header('Location: home_faculty.php');
		//}
		//else
		//{
			$conn = new mysqli($servername, $username, $password, $dbname);
			$result = mysqli_query($conn,"SELECT * FROM users");
			if(mysqli_connect_error())
				die("Connection failed".mysqli_connect_error());
				//else echo "Connected Successfuly"."<br>";
		
			if (mysqli_num_rows($result) > 0) 
			{
				$i=0;
				while($row = mysqli_fetch_array($result)) 
				{
					if($row["EmployeeNumber"] == $EmployeeNumber && $row["password"] == $Password)
					{
						session_start();
						$_SESSION['EmployeeNumber'] = $row["EmployeeNumber"];
						//echo "<input type='hidden' value='$StudentNumber' name='d0'>";
						header('Location: Employees/home_employees.php');
						exit();
					}
					$i++;
				}
				
				echo "<script type='text/javascript'>";
				echo "alert('Username or Password is incorrect.')";
				echo "</script>";
			}
			
			$conn->close();
		//}
	}
	?>
	</body>
</html>