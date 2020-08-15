<?php
session_start();

include("/nfs/c06/h04/mnt/157266/domains/register.team2342.org/data/database_pwd.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_SESSION['id'];

$sql = "UPDATE Users SET pwd='' WHERE ID='$id'";
$conn->query($sql);

unset($_SESSION['login']);
unset($_SESSION['id']);
unset($_SESSION['LAST_ACTIVITY']);

if($_GET['r'] != 'timeout'){
  header("Location: /");
}
?>
<!DOCTYPE html>
<html>
<head>
<script>alert("Session timed out");window.location="/";</script>
</head>
<body>Redirecting...</body>
</html>