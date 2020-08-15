<?php
include("/nfs/c06/h04/mnt/157266/domains/register.team2342.org/data/database_pwd.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT firstname, lastname, tshirt FROM Users WHERE type='student' OR type='mentor' AND approved='1' AND parentApproved='1' ORDER BY type, firstname, lastname";
$result = $conn->query($sql);

if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		echo $row['firstname']." ".$row['lastname']." --> ".$row['tshirt']."<br>";
	}
}