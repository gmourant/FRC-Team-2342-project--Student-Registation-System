<?php
$form = true;
$thx = false;

$id = str_replace("'","",$_REQUEST['id']);

include("/nfs/c06/h04/mnt/157266/domains/register.team2342.org/data/database_pwd.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('America/New_York');
$today = date("Y-m-d");

$sql = "SELECT firstname, lastname, parent1ID, parent2ID, email FROM Users WHERE type='student' AND approved='1' AND parentApproved='0' AND ID='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
        $student = $row["firstname"]." ".$row["lastname"];
		$P1ID = $row["parent1ID"];
		$P2ID = $row["parent2ID"];
		$Semail = $row["email"];
    }
} else {
    $error = true;
}

$sql = "SELECT firstname, lastname, email FROM Users WHERE ID='$P1ID'";
$result = $conn->query($sql);
if (($result->num_rows > 0) && ($error == false)) {
	while($row = $result->fetch_assoc()) {
        $parent1 = $row["firstname"]." ".$row["lastname"];
		$P1email = $row['email'];
    }
} else {
    $error = true;
}

$sql = "SELECT firstname, lastname, email FROM Users WHERE ID='$P2ID'";
$result = $conn->query($sql);
if (($result->num_rows > 0) && ($error == false)) {
	while($row = $result->fetch_assoc()) {
        $parent2 = $row["firstname"]." ".$row["lastname"];
		$P2email = $row['email'];
    }
}

if (($_SERVER["REQUEST_METHOD"] == "POST") && ($error == false)) {
  $disErrorP = "alert('There was an error in the confirmation of your child, please try again.')";
  $parent = str_replace("'","",$_REQUEST['parent']); // parent name in HTML (not secured)
  if($parent2 == ''){ // child has no second parent in database
		$parent2T = $parent1; // parent 2 temperary equals parent 1 (both parents equal parent 1)
	} else {
		$parent2T = $parent2; // parent 2 temperary eqauls parent 2
	}
  if($parent != $parent1 && $parent != $parent2T){ // if parent in HTML does not equal parents from database fail
      $disError = $disErrorP;
  } elseif($_REQUEST['health'] != 'true' || $_REQUEST['takePhoto'] != 'true' || $_REQUEST['contact'] != 'true' || $_REQUEST['handbook'] != 'true' || $_REQUEST['youth'] != 'true' || $_REQUEST['safety'] != 'true'){ // checking values were checked
      $disError = $disErrorP;
  } else {
  $form = false;
  $thx = true;
  
  $up = "UPDATE Users SET parentApproved='1', parentApprovedBy='$parent', parentApprovedDate='$today' WHERE ID='$id'";
  $conn->query($up);
  $up = "UPDATE Users SET parentApproved='1' WHERE ID='$P1ID'";
  $conn->query($up);
  $up = "UPDATE Users SET parentApproved='1' WHERE ID='$P2ID'";
  $conn->query($up);
  mail($Semail,"You're registered with Team 2342",
"Dear $student,

Your registration with FIRST Robotics Team 2342 has been confirmed by both the team and your parents.

Thank you for your time,
The Team Member Registration System
", "From: Team Member Registration System <help@team2342.org>");
  $headers = "From: Team 2342 Mentors <info@team2342.org>"."\r\n";
  $headers .= "MIME-Version: 1.0"."\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8"."\r\n";
  mail("$P1email, $P2email","Your Child's a member of Team 2342",
"
<html>
<head>
<title>Your Child's a member of Team 2342</title>
<style>
.sb
{
margin-bottom:12px;
}
</style>
</head>
<body>
<p class='sb'>Greetings,</p>
<p class='sb'>We are confirming that:</p>
<ul class='sb'>
  <li>your child (name) <i>$student</i></li>
  <li>is now a member of FIRST Team # <i>2342</i> Team Name <i>Team Phoenix</i></li>
  <li>hosted by (name of school/organization) <i>Daniel Webster College</i></li>
  <li>the Team will be meeting at (list all organizations/addresses where Team may meet regularly, noting if it is a private home):<br><i>Daniel Webster Hall &ndash; 20 University Dr, Nashua, NH 03063</i></li>
  <li>Our Team will hold a Safety Meeting that will include an age-appropriate training film about avoiding safety risks including child abuse and molestation; you are welcome to view the video in advance by contacting one of us and you are encouraged to attend the Safety Meeting &mdash; we will notify you of the date and time.</li>
  <li>Our Team may work with student mentors who are older than your child; we will provide you with specific information about the role of these student-mentors and our oversight of their involvement upon request.</li>
  <li>You understand that you, as the Team member's parent/guardian, are fully responsible for arranging transportation, and supervising the manner in which your child travels, to and from places where the Team meets, and for informing one of us as the Team Lead Coach/Mentor of any restrictions you wish to place on your child's access to, or dismissal from, the Team meeting place. We will try to accommodate any restrictions you may require and will inform you if we are unable to do so.</li>
</ul>
<p class='sb'>As part of its FIRST Youth Protection Program, FIRST strongly encourages all parents/guardians of Team members to: be aware of how FIRST programs are conducted; participate in Team activities; and, read <a href='http://www.usfirst.org/sites/default/files/uploadedFiles/About_Us/FIRST-YPP-ProgramGuide.pdf' target='_blank'>FIRST Guidelines for Parents</a> (page 32).</p>
<p class='sb'>Please contact us at info@team2342.org for information about our Team's activities.</p>
<p class='sb'>Sincerely yours,<br>Bruce George<br>Lead Mentor</p>
<p>This email was sent in compliance with the <a href='http://www.usfirst.org/sites/default/files/uploadedFiles/About_Us/FIRST-YPP-ProgramGuide.pdf' target='_blank'>FIRST Youth Protection Program</a>.</p>
</body>
</html>
",$headers);
  }
}

if($error == true){
  $form = false;
  $thx = false;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/head.php"); ?>
	<script><?php echo $disError ?></script>
  </head>
  <body>
    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/noscript.php"); ?>
	<div>
	  <div>
	    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/heading.php"); ?>
		<div>
		  <?php if($thx == true): ?>
		  <p>Thank you for confirming your child's registration with Team Phoenix. Your child will receive an email within a few days about registering with FIRST through a system called STIMS, which should be completed before the new year.</p>
		  <?php endif ?>
		  <?php if($form == true): ?>
		  <form id="registration-form" action="/confirmation.php?id=<?php echo $id ?>" method="post">
		    <p class="right"><span>*</span> indicates Required</p>
			<h2 class="sb">Student Registration</h2>
			<p><b>Student Name:</b> <?php echo $student ?></p>
			<p><span>*</span><b>I am:</b> <select name="parent" required><option></option><option><?php echo $parent1 ?></option><?php if($parent2 != ''){echo "<option>".$parent2."</option>";} ?></select></p>
			<h3 class="sb center">Parent/Guardian Agreement</h3>
			<p class="sb"><span>*</span><input type="checkbox" name="health" value="true" required> I give permission for a licensed medical authority to administer first aid or for a doctor selected by the Club to hospitalize, secure proper treatment for, and to order medicine, injections, anesthesia, surgery or x­rays to my child following a robotics team related injury. I will not hold the Club responsible for any injury or repercussion from medical attention. I also give permission to transport my child to a medical facility for the purpose of obtaining medical care following an injury.<br><b>EVERY ATTEMPT WILL BE MADE TO CONTACT YOU PRIOR TO ANY DECISIONS.</b></p>
			<p class="sb"><span>*</span><input type="checkbox" name="takePhoto" value="true" required> I agree to my photo and my child's photo being taken at any team activity/event and used for team publicity purposes by mail, email, newsletter or website.</p>
			<p class="sb"><span>*</span><input type="checkbox" name="contact" value="true" required> I agree to my personal contact information and my child's personal contact information being shared with other team members and parents.</p>
			<p class="sb"><span>*</span><input type="checkbox" name="handbook" value="true" required> My child and I have read and agree to the <a href="/files/TeamHandbook-RevF.pdf" target="_blank">Team Handbook</a>.</p>
			<p class="sb"><span>*</span><input type="checkbox" name="youth" value="true" required> My child and I have read the <a href="http://www.firstinspires.org/resource-library/youth-protection-policy" target="_blank">FIRST Youth Protection Program Guide</a>.</p>
			<p class="sb"><span>*</span><input type="checkbox" name="safety" value="true" required> My child and I have read the <a href="http://www.firstinspires.org/resource-library/frc/safety-manual" target="_blank">FIRST Safety Manual</a>.</p>
			<input type="submit" value="Agree" class="sb">
			<p>Clicking the <i>Agree</i> button above constitutes my online signing of this agreement.</p>
		  </form>
		  <?php endif ?>
		  <?php if($error == true): ?>
		  <p>Error. This ID is not accessible. Either it has already been confirmed (probably by the other parent), or it was never pending confirmation.</p>
		  <?php endif ?>
		</div>
	  </div>
	</div>
  </body>
</html>