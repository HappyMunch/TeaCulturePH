<html>
<head>
<title></title>
<head>

<?php
include("Session_Check.php");
?>

<body style="font-family: segoe UI; background-color: #efd19f"; background-size: cover">
<div style="background-color: #C6893F; height: 50px; margin: -8px -8px 0px -8px; "></div>
<div style="float: right; background-color: black; width: 130px; height: 200px; border-radius: 100px; margin: -60px 100px 0px -8px; "></div>
<div style="float: right; background-color: white; border-radius: 50px; margin: 25px -106px 0px 0px; "><a href="TheTeaCulture.php"><img src="../TEA CULTURE LOGO 9.png" width="100px"></div>
<link rel="stylesheet" href="w3.css">
<div class="w3-display-topmiddle w3-container w3-padding-large w3-center">
<br><br>
<a href = "home_employees.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='black'" style="color: black;">Home</a>

<h1>Welcome to the Time Table Updating Page<h1>

<h2>Please select the appropriate action<h2>

<br>
<form method = "GET" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<input type = "hidden" name = "WorkDate" value = "<?php print strftime('%Y-%m-%d') ?>">
<input type = "hidden" name = "AddTime" value = "TimeIn">
<input type=submit value = "Time In">
</form>

<form method = "GET" action = "<?php echo $_SERVER['PHP_SELF'];?>">
<input type = "hidden" name = "WorkDate" value = "<?php print strftime('%Y-%m-%d') ?>">
<input type = "hidden" name = "AddTime" value = "TimeOut">
<input type=submit value = "Time Out">
</form> 

<?php
	if($_SERVER["REQUEST_METHOD"] == "GET"){
	connect();
	}
	function connect(){
		date_default_timezone_set('Asia/Singapore');
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "theteacultureph2";
		$flag = 0;
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		
		$empid = $_SESSION["EmployeeNumber"];
		$WorkDate = $_GET["WorkDate"];
		$AddTime = $_GET["AddTime"];
		$TimeIn = date('H:i');
		$TimeOut = date('H:i');
		
		if($AddTime == "TimeIn"){
			$result = mysqli_query($conn, "SELECT WorkDate FROM employees WHERE EmployeeNumber = '$empid'");
			$all_property= array();
		   
			if($result->num_rows > 0){
				while($property= mysqli_fetch_field($result)){
					array_push($all_property, $property->name );
				}
				while($row= mysqli_fetch_array($result)){
					foreach ($all_property as $item){
						if($row[$item] == $WorkDate){
							$flag++;
						}
					}
				}
			}
		
			if($flag == 0){
				$sql = "INSERT INTO employees VALUES ( '', '1', '$empid', '$WorkDate', '$TimeIn', '', '', '', '', '', '' )";
				if($conn->query($sql) === TRUE)
				{
					echo "Database created successfully ";
					echo "Timed In at: ", $TimeIn;
				}
				else echo "Error creating database: ".$conn->error;
			}
		
			else{
				echo "Already Timed In Today";
			}
		}
		
		else if($AddTime == "TimeOut"){
			
			$result = mysqli_query($conn, "SELECT TimeOut FROM employees WHERE EmployeeNumber = '$empid' AND WorkDate = '$WorkDate'");
			$all_property= array();
			
			if($result->num_rows == 0){
				echo "Haven't timed in today yet";
				return 0;
			}
			
			if($result->num_rows > 0){
				while($property= mysqli_fetch_field($result)){
					array_push($all_property, $property->name );
				}
				while($row= mysqli_fetch_array($result)){
					foreach ($all_property as $item){
						if($row[$item] != ''){
							$flag++;
						}
					}
				}
			}
		
			if($flag == 0){
				$TimeInsql = "SELECT TimeIn as timein FROM employees WHERE EmployeeNumber = '$empid' AND WorkDate = '$WorkDate'";
				$TimeInquery = $conn->query($TimeInsql);
				$TimeInrow = $TimeInquery->fetch_assoc();
				$TimeIn = $TimeInrow['timein'];
				$a = strtotime($TimeIn);
				$b = strtotime($TimeOut);
				
				echo $a.' '.$b.'<br>';
				
				$hourdiff = intval(($b - $a)/3600);
				$mindiff = (int)(($b - $a) / 60);
				$Hours = $hourdiff.'.'.$mindiff;
				//$interval = $a->diff($b);
				//$Time = $interval->format("%H:%I");
				
				//$HoursComp = str_replace(":",".",$Time,$HoursComp);
				//$Hoursonly = floor($HoursComp);
				//$mins = round(($HoursComp - $Hoursonly) * 60);
				//$Hours = $Hoursonly.'.'.$mins;
				
				
				$BasicPay = 0; //(I Dunno Mechanics yet)
	
				$HourSchedulesql = "SELECT HourSchedule as hourschedule FROM users WHERE EmployeeNumber = '$empid'";
				$HourSchedulequery = $conn->query($HourSchedulesql);
				$HourSchedulerow = $HourSchedulequery->fetch_assoc();
				$HourSchedule = $HourSchedulerow['hourschedule'];
				if($HourSchedule < $Hours)
				{
					$OvertimePay = ((float)$Hours - $HourSchedule) * 50;
				}
				else
				{
					$OvertimePay = 0;
				}
	
				//Add Array of holidays then ibutang sa while or for loop then set prics
				$IsHoliday = date(m-d);
				$Holidays = array("01-01", "02-25", "04-09", "05-01", "06-12", "08-21", "08-30", "11-01", "11-30", "12-08", "12-25", "12-30", "12-31");
				$Length = count($Holidays);
				$counter = 0;
				while( $counter < $Length ){
					if($IsHoliday == $Holidays[$counter])
					{
						$HolidayPay = $Hours * 50; //(I Dunno Mechanics yet)
					}
					$counter++;
				}
				
				
				//echo $HourSchedule;
				//echo (int)$HourSchedule;
				$GrossPay = $BasicPay + $HolidayPay + $OvertimePay + ($HourSchedule * 50); //(I Dunno Mechanics yet)
				//echo $GrossPay;
	
				$sql = "UPDATE employees SET TimeOut = '$TimeOut', Hours = '$Hours', BasicPay = '$BasicPay', HolidayPay = '$HolidayPay', OvertimePay = '$OvertimePay', GrossPay = '$GrossPay' WHERE WorkDate = '$WorkDate' AND EmployeeNumber = '$empid'";
				if($conn->query($sql) === TRUE)
				{
					echo "Database created successfully ";
					echo "Timed Out at: ", $TimeOut;
				}
				else echo "Error creating database: ".$conn->error;
			}
		
			else{
				echo "Already Timed Out Today";
			}
		}
		
		
	
		$conn->close();
	}
	?>
</div>
</body>
</html>