<?php
include("/nfs/c06/h04/mnt/157266/domains/register.team2342.org/data/database_pwd.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('America/New_York');

function get_age($date){
    $from = new DateTime($date);
	$to   = new DateTime('today');
	return $from->diff($to)->y;
}

$date = date("m-d");
if($date == $date){
	// Removes parent approved
	$sql = "UPDATE Users SET parentApproved='0', parentApprovedBy='', parentApprovedDate='0000-00-00' WHERE type='student' AND ID='60'";
	$conn->query($sql);
	// Re-sends emails
	$sql = "SELECT * FROM Users WHERE type='student' AND ID='60'";
	$students = $conn->query($sql);
	while($student = $students->fetch_assoc()){
		$id = $student['ID'];
		$firstname = $student['firstname'];
		$lastname = $student['lastname'];
		$email = $student['email'];
		$P1ID = $student['parent1ID'];
		$P2ID = $student['parent2ID'];
		$age = get_age($student['birthday']);
		if($age < 18){
			$sql = "SELECT * FROM Users WHERE ID=".$P1ID;
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()) $P1email = $row['email'];
			
			$sql = "SELECT * FROM Users WHERE ID=".$P2ID;
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()) $P2email = $row['email'];			
			mail("$P1email, $P2email", "Your Child's Registration with FRC Team 2342",
"Dear Parent(s)/Guardian of $firstname $lastname,

Your child's registration with FIRST Robotics Team 2342's online member registration system requires your re-confirmation. We require that at least one parent/guardian to re-agree to our terms and conditions. Please visit http://register.team2342.org/confirmation.php?id=$id to confirm and agree.

Thank you for your time,
The Team Member Registration System
", "From: Team Member Registration System <help@team2342.org>");

		} else {
			$up = "UPDATE Users SET parentApproved='1' WHERE ID=".$id;
			$conn->query($up);
			
			$up = "UPDATE Users SET parentApproved='1' WHERE ID=".$P1ID;
			$conn->query($up);
			
			$up = "UPDATE Users SET parentApproved='1' WHERE ID=".$P2ID;
			$conn->query($up);
			
			mail("$email","You're registered with Team 2342",
"Dear $firstname $lastname,

Your registration with FIRST Robotics Team 2342 has been re-confirmed.

Thank you for your time,
The Team Member Registration System
", "From: Team Member Registration System <help@team2342.org>");
		}
	}
}
?>