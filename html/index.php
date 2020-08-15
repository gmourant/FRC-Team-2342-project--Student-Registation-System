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
		  <a id="login" href="/user/login.php">Login</a>
		  <h2 class="sb">Welcome to our new registration system!</h2>
		  <p class="sb b">Steps for student registration:</p>
		  <ul class="sb">
		    <li>Fill out registration form and agree to our terms and conditions.</li>
			<li>Get apporved by admin.</li>
			<li>One of your parents (or guardian) must agree to terms and conditions (they will receive an email).</li>
			<li>Done! Almost...</li>
			<li>You will receive an email about registering with FIRST through a system called STIMS, which should be completed before the new year.</li>
		  </ul>
		  <a href="/register.php?t=student" id="button" class="sb">Register as a student</a>
		  <p class="sb b">Steps for mentor registration:</p>
		  <ul class="sb">
		    <li>Fill out registration form and agree to our terms and conditions.</li>
			<li>Get apporved by admin.</li>
			<li>Done! Almost...</li>
			<li>You will receive an email about registering with FIRST through a system called TIMS, which should be completed before the new year.</li>
		  </ul>
		  <a href="/register.php?t=mentor" id="button" class="sb">Register as a mentor</a>
		  <p class="sb">If you have any questions, please contact <a href="mailto:help@team2342.org?subject=Registration Question(s)" target="_blank">help@team2342.org</a>.</p>
		  <p id="footer"><a href="/admin/">Admin Login</a></p>
		</div>
	  </div>
	</div>
  </body>
</html>