<?php
session_start();

include("/nfs/c06/h04/mnt/157266/domains/register.team2342.org/data/database_pwd.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstname = str_replace("'","",$_POST['firstname']);
  $lastname = str_replace("'","",$_POST['lastname']);
  $type = str_replace("'","",$_POST['type']);
  if($type <> 'student' && $type <> 'mentor') $firstname = $lastname = '';
  $sql = "SELECT ID, email FROM Users WHERE type='$type' AND firstname='$firstname' AND lastname='$lastname'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){$id = $row['ID'];$email = $row['email'];}
	$pwd = randomPassword();
	$sql = "UPDATE Users SET pwd='$pwd' WHERE ID='$id'";
	$conn->query($sql);
	mail($email,"TMRS Login","Please visit http://register.team2342.org/user/login.php?id=$id&pwd=$pwd to login. This link will auto expire at 4am.", "From: Team Member Registration System <help@team2342.org>");
	$error = " The login link has been sent to your email";
  } else {
    $error = " Invalid login credentials";
  }
}

$loginPWD = str_replace("'","",$_GET['pwd']);
$loginID = str_replace("'","",$_GET['id']);
  if($loginID == true && $loginPWD == true){
    $sql = "SELECT pwd FROM Users WHERE ID='$loginID'";
	$result = $conn->query($sql);
    if ($result->num_rows > 0){
      while($row = $result->fetch_assoc()){$dataPWD = $row['pwd'];}
      if($dataPWD == $loginPWD){
        $_SESSION['id'] = $loginID;
        $_SESSION['login'] = true;
        header('Location: /user/view.php');
      } else {
        $error = " Invalid login credentials";
      }
    } else {
	  $error = " Invalid login credentials";
	}
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/head.php"); ?>
  </head>
  <body>
    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/noscript.php"); ?>
	<div>
	  <div>
	    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/heading.php"); ?>
		<div>
		  <form id="registration-form" action="/user/login.php" method="post">
			<h2 class="sb">Login</h2>
			<p class="sb">Name: 
			  <input type="text" name="firstname" placeholder="First" required>
			  <input type="text" name="lastname" placeholder="Last" required>
			  <select name="type" required>
			    <option></option>
				<option>student</option>
				<option>mentor</option>
			  </select>
			</p>
			<input type="submit" value="Login"><?php echo $error ?>
		  </form>
		</div>
	  </div>
	</div>
  </body>
</html>