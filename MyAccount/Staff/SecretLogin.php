<html>
<head>
<title>Admin Log In</title>
</head>

<?php
	session_start();
	if(isset($_POST["adminpassword"])){
		$_SESSION["AdminPassword"] = $_POST["adminpassword"];
	}
	include("Session_Check.php");
	
	
?>

<body style="font-family: segoe UI; background-color: #efd19f"; background-size: cover">
	<div style="background-color: #C6893F; height: 50px; margin: -8px -8px 0px -8px; "></div>
	<div style="float: right; background-color: black; width: 130px; height: 250px; border-radius: 80px; margin: -110px 100px 0px -8px; "></div>
	<div style="float: right; background-color: white; border-radius: 50px; margin: 20px -106px 0px 0px; "><a href="TheTeaCulture.php"><img src="TEA CULTURE LOGO 9.png" width="100px"></a></div>
	<form method = "GET" action = "<?php echo $_SERVER['PHP_SELF'];?>">
		<div style="color: black; font-family: Claytonia, cursive ; font-size: 35px; width: 300px; padding-left: 0px; margin: 95px 0px 0px 90px">ADMIN LOG IN</div>
		<br>
		<div style="float: left; margin: 50px 0px 0px 60px">
			<input type = "text" name = "EmployeeNumber" placeholder="Username" style="padding: 15px 0px 15px 10px; width: 225px; font-size: 15px;">
			<br><br>
			<input type = "password" name = "password" placeholder="Password" style="padding: 15px 0px 15px 10px; width: 225px; font-size: 15px;">
			<br><br><br><br>

			<input type="submit" value="Log In" style="background-color: #C6893F; color: white; border: hidden; padding: 15px 50px; border-radius: 40px; margin-left: 30px; font-size: 20px;" >
			<br><br><br><br><br><br><br>
			<p style="color: black">Don't have an account? <a href="Admin_Registration.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='white'" style="color: white;"> Register</a></p>
			<p style="color: black"> <a href="logout.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='white'" style="color: white;"> Home</a></p>
		</div>
	</form>

	<?php
	if($_SERVER["REQUEST_METHOD"] == "GET"){
		if(isset($_GET["EmployeeNumber"]) && isset($_GET["password"])){
			connect();
		}
	}
	function connect(){
		//StudentID varchar (10) primary key, kulang pa
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "theteacultureph2";
		
		$conn = new mysqli($servername, $username, $password, $dbname);
			
		$username = $_GET["EmployeeNumber"];
		$Password = $_GET["password"];
			
		$result = mysqli_query($conn,"SELECT * FROM admins");
		if(mysqli_connect_error())
			die("Connection failed".mysqli_connect_error());
			//else echo "Connected Successfuly"."<br>";	
		
		if (mysqli_num_rows($result) > 0) 
		{
			$i=0;
			while($row = mysqli_fetch_array($result)) 
			{
				if($row["username"] == $username && $row["password"] == $Password)
				{
					session_start();
					$_SESSION['username'] = $row["username"];
					//echo "<input type='hidden' value='$StudentNumber' name='d0'>";
					header('Location: Admins/home_admins.php');
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