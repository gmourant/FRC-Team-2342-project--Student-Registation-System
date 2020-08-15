<?php
session_start();
unset($_SESSION['admin_login']);
unset($_SESSION['admin_LAST_ACTIVITY']);
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