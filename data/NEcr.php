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
	
	$sql = "SELECT * FROM Users WHERE (type='student' OR type='mentor') AND approved='1' AND parentApproved='1' AND stims='1' AND NEcr='0' ORDER BY firstname, lastname";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
		require_once("/nfs/c06/h04/mnt/157266/domains/register.team2342.org/data/PHPMailer/class.phpmailer.php");
		while($row = $result->fetch_assoc()){
			$address = $row['email'];
	        $name = $row['firstname']." ".$row['lastname'];
			$bodytext = "
Dear $name,

The last step for your registration is to complete the New England FIRST Consent and Release agreement (the PDF form is attached). Please print it out and give it to the Team Leader when possible (you can also print it at a meeting if needed). This needs to be completed by both Students and Mentors.

Thank you for your time,
The Team Member Registration System
";
			$email = new PHPMailer();
			$email->From = "help@team2342.org";
			$email->FromName = "Team Member Registration System";
			$email->Subject = "Your Registration with New England FIRST";
			$email->Body = $bodytext;
			$email->AddAddress($address);
			$file = "/nfs/c06/h04/mnt/157266/domains/register.team2342.org/html/files/CONSENT AND RELEASE AGREEMENT ingenuityNE 1.0-2.pdf";
			$email->AddAttachment($file,"CONSENT AND RELEASE AGREEMENT ingenuityNE 1.0-2.pdf");
			$email->Send();
			echo "NE FIRST reminder sent to $name\r\n";
		}
	}
}

?>