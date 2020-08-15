<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pwd = str_replace("'","",$_REQUEST['pwd']);
  include("/nfs/c06/h04/mnt/157266/domains/register.team2342.org/data/admin_pwd.php");
  if($pwd == $admin_pwd){
    $_SESSION['admin_login'] = true;
	header('Location: /admin/');
  } else {
    $incorrect = " <span>Invalid password</span>";
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
		  <form id="registration-form" action="/admin/login.php" method="post">
			<h2 class="sb">Admin Login</h2>
			<p class="sb">Password: <input type="password" name="pwd" required><?php echo $incorrect ?></p>
			<input type="submit" value="Login" class="sb">
			<p style="color:gray"><small>If you are a team member looking for the Statistics and Demographics page, <a href="/stats.php">click here</a>.</small></p>
		  </form>
		</div>
	  </div>
	</div>
  </body>
</html>