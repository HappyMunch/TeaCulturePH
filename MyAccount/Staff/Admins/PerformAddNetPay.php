<html>
<head>
<title></title>
</head>

<?php
include("Session_Check_Admin.php");
?>


<body>
<link rel="stylesheet" href="w3.css">
<a href = "home_admins.php">Home</a>
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
	
	
	//wala pang deductions
    //$sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
    //$query = $conn->query($sql);
    //$drow = $query->fetch_assoc();
    //$deduction = $drow['total_amount'];
                  
    $to = date('F d, Y', strtotime($_POST["EndDate"]));
    $from = date('F d, Y', strtotime($_POST["StartDate"]));

                    /*if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode(' - ', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }*/
	echo "Period Covered: " . $from . " to ".	 $to;
	
	echo "<br>
			".'<table class= "w3-table-all w3-centered">
			<tr class = "data-heading">'."
            <tr>
            <td>Last Name</td>
			<td>First Name</td>
			<td>Days of work</td>
			<td>Rate per Day</td>
			<td>Basic Pay</td>
			<td>Holiday Pay</td>
			<td>Overtime Pay</td>
			<td>Gross Pay</td>
			<td>Tardiness/Absences</td>
			<td>SSS</td>
			<td>Pag-Ibig</td>
			<td>Phil Health</td>
			<td>Total Deductions</td>
			<td>Net Pay</td>
            </tr>
			</tr>
            ";

    $sql = "SELECT *, SUM(Hours) AS total_hr, employees.EmployeeNumber AS empid FROM employees LEFT JOIN users ON users.EmployeeNumber=employees.EmployeeNumber WHERE WorkDate BETWEEN '$from' AND '$to' GROUP BY employees.EmployeeNumber ORDER BY users.LastName ASC, users.FirstName ASC";

    $query = $conn->query($sql);
    $total = 0;
	$i = 1;
    while($row = $query->fetch_assoc())
	{
		echo "</br>";
        $empid = $row['empid'];
		$Hours = $row['total_hr'];
		
		$Daysql = "SELECT *, SUM(Days) AS days FROM employees WHERE EmployeeNumber ='$empid' AND WorkDate BETWEEN '$from' AND '$to'";
		$Dayquery = $conn->query($Daysql);
        $Dayrow = $Dayquery->fetch_assoc();
        $Days = $Dayrow['days'];
		
		$HourSchedulesql = "SELECT HourSchedule AS hourschedule FROM users WHERE EmployeeNumber = '$empid'";
		$HourSchedulequery = $conn->query($HourSchedulesql);
		$HourSchedulerow = $HourSchedulequery->fetch_assoc();
		$HourSchedule = $HourSchedulerow['hourschedule'];
		
		if($HourSchedule > $Hours / $Days)
		{
			$Late = ($HourSchedule - $Hours / $Days) * 50;
		}
		else
		{
			$Late = 0;
		}
                      
        $BPsql = "SELECT *, SUM(BasicPay) AS basicpay FROM employees WHERE EmployeeNumber ='$empid' AND WorkDate BETWEEN '$from' AND '$to'";
		$BPquery = $conn->query($BPsql);
        $BProw = $BPquery->fetch_assoc();
        $BasicPay = $BProw['basicpay'];
		
		$HPsql = "SELECT *, SUM(HolidayPay) AS holidaypay FROM employees WHERE EmployeeNumber ='$empid' AND WorkDate BETWEEN '$from' AND '$to'";
		$HPquery = $conn->query($HPsql);
        $HProw = $HPquery->fetch_assoc();
        $HolidayPay = $HProw['holidaypay'];
		
		$OPsql = "SELECT *, SUM(OvertimePay) AS overtimepay FROM employees WHERE EmployeeNumber ='$empid' AND WorkDate BETWEEN '$from' AND '$to'";
		$OPquery = $conn->query($OPsql);
        $OProw = $OPquery->fetch_assoc();
        $OvertimePay = $OProw['overtimepay'];
		
		$GPsql = "SELECT *, SUM(GrossPay) AS grosspay FROM employees WHERE EmployeeNumber ='$empid' AND WorkDate BETWEEN '$from' AND '$to'";
		$GPquery = $conn->query($GPsql);
        $GProw = $GPquery->fetch_assoc();
        $GrossPay = $GProw['grosspay'];
		
		//need ni for deductions later
		/*$HourSchedulesql = "SELECT HourSchedule, SUM(HourSchedule) AS hourschedule FROM users WHERE EmployeeNumber = '$empid'";
		$HourSchedulequery = $conn->query($HourSchedulesql);
		$HourSchedulerow = $HourSchedulequery->fetch_assoc();
		$HourSchedule = $HourSchedulerow['hourschedule'];
		if($HourSchedulerow < $Hours)
		{
			$OvertimePay = ((int)$Hours - $HourSchedule) * 20;
		}
		else
		{
			$OvertimePay = 0;
		}*/
		
		$SSSsql = "SELECT SSS AS sss FROM users WHERE EmployeeNumber = '$empid'";
		$SSSquery = $conn->query($SSSsql);
		$SSSrow = $SSSquery->fetch_assoc();
		$SSSstatus = $SSSrow['sss'];
		if($SSSstatus == "Yes")
		{
			$SSS = 225; //tentative SSS semi-monthly
		}
		else
		{
			$SSS = 0;
		}
		
		$PagIbigsql = "SELECT PagIbig AS pagibig FROM users WHERE EmployeeNumber = '$empid'";
		$PagIbigquery = $conn->query($PagIbigsql);
		$PagIbigrow = $PagIbigquery->fetch_assoc();
		$PagIbigstatus = $PagIbigrow['pagibig'];
		if($PagIbigstatus == "Yes")
		{
			$PagIbig = 225; //tentative SSS semi-monthly
		}
		else
		{
			$PagIbig = 0;
		}
		
		$PhilHealthsql = "SELECT PhilHealth AS philhealth FROM users WHERE EmployeeNumber = '$empid'";
		$PhilHealthquery = $conn->query($PhilHealthsql);
		$PhilHealthrow = $PhilHealthquery->fetch_assoc();
		$PhilHealthstatus = $PhilHealthrow['philhealth'];
		if($PhilHealthstatus == "Yes")
		{
			$PhilHealth = 225; //tentative SSS semi-monthly
		}
		else
		{
			$PhilHealth = 0;
		}
		
        $TotalDeduction = $Late + $SSS + $PagIbig + $PhilHealth;
		$NetPay = $GrossPay - $TotalDeduction;
        //$net = $gross - $total_deduction;
		
		//not sure sa rate 20 placeholder
        echo "
            <tr>
            <td>".$row['LastName'].",</td>
			<td>".$row['FirstName']."</td>
            <td>".$Days."</td>
			<td>".$HourSchedule * 20 ."</td>
            <td>".number_format($BasicPay, 2)."</td>
			<td>".number_format($HolidayPay, 2)."</td>
			<td>".number_format($OvertimePay, 2)."</td>
			<td>".number_format($GrossPay, 2)."</td>
			<td>".number_format($Late, 2)."</td>
			<td>".number_format($SSS, 2)."</td>
			<td>".number_format($PagIbig, 2)."</td>
			<td>".number_format($PhilHealth, 2)."</td>
			<td>".number_format($TotalDeduction, 2)."</td>
			<td>".number_format($NetPay, 2)."</td>
            </tr>
            ";
    }
					
	/*$EmployeeNumber = $_SESSION['EmployeeNumber'];
	$WorkDate = $_POST["WorkDate"];
	$TimeIn = $_POST["TimeIn"];
	$TimeOut = $_POST["TimeOut"];
	$a = new DateTime($TimeIn);
	$b = new DateTime($TimeOut);
	$interval = $a->diff($b);
	$Hours = $interval->format("%H");
	$BasicPay = $Hours * 20; //(I Dunno Mechanics yet)
	$HolidayPay = 0; //(I Dunno Mechanics yet)
	$OvertimePay = 0; //(I Dunno Mechanics yet)
	$GrossPay = $BasicPay + $HolidayPay + $OvertimePay; //(I Dunno Mechanics yet)
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if(mysqli_connect_error())
		die("Connection failed".mysqli_connect_error());
		else echo "Connected Successfuly"."<br>";
	
	$sql = "INSERT INTO employees VALUES ( '', '$EmployeeNumber', '$WorkDate', '$TimeIn', '$TimeOut', '$Hours', '$BasicPay', '$HolidayPay', '$OvertimePay', '$GrossPay' )";
	if($conn->query($sql) === TRUE)
		echo "Database created successfully";
		else echo "Error creating database: ".$conn->error;
		
	$conn->close();*/
}
?>
	
	
	
	
		

</html>
