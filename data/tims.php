<?php
include("/nfs/c06/h04/mnt/157266/domains/register.team2342.org/data/database_pwd.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('America/New_York');

$today = date("N");
$month = (int) date("n");
if(($today == '1' || $today == '3' || $today == '5') && ($month <= 3 || $month >= 9)){
    $headers = "From: Team Member Registration System <help@team2342.org>"."\r\n";
	$headers .= "MIME-Version: 1.0"."\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8";
	
    $sql = "SELECT * FROM Users WHERE type='student' AND approved='1' AND stims='0' ORDER BY firstname, lastname";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $email = $row['email'];
	        $name = $row['firstname']." ".$row['lastname'];
	        mail($email,"Your Registration with FIRST (TIMS)",
"
<html>
<head>
<title>Your Registration with FIRST</title>
<style>
.sb
{
margin-bottom:12px;
}
</style>
</head>
<body>
<p class='sb'>Dear $name,</p>
<p class='sb'>In order to complete your registration for FIRST Robotics Team 2342, you must register with FIRST Robotics through a system called TIMS. To do so, please visit <a href='https://my.usfirst.org/stims/site.lasso' target='_blank'>https://my.usfirst.org/frc/tims/site.lasso</a>.</p>
<p class='sb'>Thank you for your time,<br>The Team Member Registration System</p>
<p>P.S. If you have already registered through TIMS, you should not be getting these reminder emails. Please contact <a href='mailto:help@team2342.org'>help@team2342.org</a> and we will resolve the issue.</p>
</body>
</html>
",$headers);
	        echo "TIMS reminder sent to $name\r\n";
        }
		echo "\r\n";
    }
}

$up = "UPDATE Users SET pwd=''";
$conn->query($up);
?>