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
	$password = $_POST["password"];
	
	//echo "<input type='hidden' value='$EmployeeNumber' name='d0'>";
	
	if($StudentNumber == "00GuidanceOffice11" && $Password == "Wecareforourstudents")
	{
		header('Location: Teachers.php');
	}
	else
	{
		$conn = new mysqli($servername, $username, $password, $dbname);
		$result = mysqli_query($conn,"SELECT * FROM users");
		if(mysqli_connect_error())
			die("Connection failed".mysqli_connect_error());
			else echo "Connected Successfuly"."<br>";
	
		if (mysqli_num_rows($result) > 0) 
		{
			$i=0;
			while($row = mysqli_fetch_array($result)) 
			{
				if($row["EmployeeNumber"] == $EmployeeNumber && $row["password"] == $password)
				{
					session_start();
					$_SESSION['EmployeeNumber'] = $row["EmployeeNumber"];
					header('Location: 1st_Page_Form.php');
					exit();
				}
				$i++;
			}
			
			echo "Login failed username or password is incorrect"."<br>";
		}
		
		$conn->close();
	}
}
?>