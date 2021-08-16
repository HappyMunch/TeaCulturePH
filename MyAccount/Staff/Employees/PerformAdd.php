<html>
<head>
<title></title>
</head>

<?php
include("Session_Check.php");
?>

<body>
<a href = "home_employees.php">Home</a>
<br>
</body>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
connect();
}
function connect(){
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "theteacultureph2";

	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$EmployeeNumber = $_SESSION['EmployeeNumber'];
	$WorkDate = $_POST["WorkDate"];
	$TimeIn = $_POST["TimeIn"];
	$TimeOut = $_POST["TimeOut"];
	$a = new DateTime($TimeIn);
	$b = new DateTime($TimeOut);
	$interval = $a->diff($b);
	$Hours = $interval->format("%H.%I");
	
	$BasicPay = 0; //(I Dunno Mechanics yet)
	
	$HourSchedulesql = "SELECT HourSchedule as hourschedule FROM users WHERE EmployeeNumber = '$EmployeeNumber'";
	$HourSchedulequery = $conn->query($HourSchedulesql);
	$HourSchedulerow = $HourSchedulequery->fetch_assoc();
	$HourSchedule = $HourSchedulerow['hourschedule'];
	if($HourSchedule < $Hours)
	{
		$OvertimePay = ((int)$Hours - $HourSchedule) * 20;
	}
	else
	{
		$OvertimePay = 0;
	}
	
	//Add Array of holidays then ibutang sa while or for loop then set prics
	$HolidayPay = 0; //(I Dunno Mechanics yet)
	
	echo $HourSchedule;
	echo (int)$HourSchedule;
	$GrossPay = $BasicPay + $HolidayPay + $OvertimePay + ($HourSchedule * 20); //(I Dunno Mechanics yet)
	echo $GrossPay;
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if(mysqli_connect_error())
		die("Connection failed".mysqli_connect_error());
		else echo "Connected Successfuly"."<br>";
	
	$sql = "INSERT INTO employees VALUES ( '', '1', '$EmployeeNumber', '$WorkDate', '$TimeIn', '$TimeOut', '$Hours', '$BasicPay', '$HolidayPay', '$OvertimePay', '$GrossPay' )";
	if($conn->query($sql) === TRUE)
		echo "Database created successfully";
		else echo "Error creating database: ".$conn->error;
		
	$conn->close();
}
?>

</html>
