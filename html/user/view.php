<?php
session_start();

$id = $_SESSION['id'];

include("/nfs/c06/h04/mnt/157266/domains/register.team2342.org/data/database_pwd.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    unset($_SESSION['login']);
	$sql = "UPDATE Users SET pwd='' WHERE ID='$id'";
	$conn->query($sql);
}
$_SESSION['LAST_ACTIVITY'] = time();

if(isset($_SESSION['login']) == false || $id == false){
  header('Location: /user/login.php');
}

$sql = "SELECT * FROM Users WHERE ID='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0){
while($row = $result->fetch_assoc()){
  $Sfirstname = $row['firstname'];
  $Slastname = $row['lastname'];
  $Saddress1 = $row['address1'];
  $Saddress2 = $row['address2'];
  $Scity = $row['city'];
  $Sstate = $row['state'];
  $Szip = $row['zip'];
  $SmPhoneType = $row['mPhoneType'];
  $SmPhone1 = $row['mPhone1'];
  $SmPhone2 = $row['mPhone2'];
  $SmPhone3 = $row['mPhone3'];
  $SsPhoneType = $row['sPhoneType'];
  $SsPhone1 = $row['sPhone1'];
  $SsPhone2 = $row['sPhone2'];
  $SsPhone3 = $row['sPhone3'];
  $Semail = $row['email'];
  $Sbirthday = strtotime($row['birthday']);
  $Sgender = $row['gender'];
  $Sethnicity = $row['ethnicity'];
  $Sschool = $row['school'];
  $Syog = $row['YOG'];
  $Stshirt = $row['tshirt'];
  $Hdoctor = $row['Hdoctor'];
  $Haddress1 = $row['Haddress1'];
  $Haddress2 = $row['Haddress2'];
  $Hcity = $row['Hcity'];
  $Hstate = $row['Hstate'];
  $Hzip = $row['Hzip'];
  $Hphone1 = $row['Hphone1'];
  $Hphone2 = $row['Hphone2'];
  $Hphone3 = $row['Hphone3'];
  $Hhospital = $row['Hhospital'];
  $Hallergies = $row['Hallergies'];
  $HallergiesE = $row['HallergiesE'];
  $P1id = $row['parent1ID'];
  $P2id = $row['parent2ID'];
  $type = $row['type'];
  $approvedBy = $row['parentApprovedBy'];
  $approvedDate = date("F j, Y",strtotime($row['parentApprovedDate']));
}
}

if ($type == "mentor"){
  $approvedBy = $Sfirstname." ".$Slastname;
}

$sql = "SELECT * FROM Users WHERE ID='$P1id'";
$result = $conn->query($sql);
if ($result->num_rows > 0){while($row = $result->fetch_assoc()){$P1firstname = $row['firstname'];$P1lastname = $row['lastname'];$P1mPhoneType = $row['mPhoneType'];$P1mPhone1 = $row['mPhone1'];$P1mPhone2 = $row['mPhone2'];$P1mPhone3 = $row['mPhone3'];$P1sPhoneType = $row['sPhoneType'];$P1sPhone1 = $row['sPhone1'];$P1sPhone2 = $row['sPhone2'];$P1sPhone3 = $row['sPhone3'];$P1email = $row['email'];}}

$sql = "SELECT * FROM Users WHERE ID='$P2id'";
$result = $conn->query($sql);
if ($result->num_rows > 0){while($row = $result->fetch_assoc()){$P2firstname = $row['firstname'];$P2lastname = $row['lastname'];$P2mPhoneType = $row['mPhoneType'];$P2mPhone1 = $row['mPhone1'];$P2mPhone2 = $row['mPhone2'];$P2mPhone3 = $row['mPhone3'];$P2sPhoneType = $row['sPhoneType'];$P2sPhone1 = $row['sPhone1'];$P2sPhone2 = $row['sPhone2'];$P2sPhone3 = $row['sPhone3'];$P2email = $row['email'];}}
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/head.php"); ?>
	<style>span{color:#d1391e;}</style>
	<script type="text/javascript">
	  window.setTimeout("window.location='/user/logout.php?r=timeout';",1800000);
	</script>
  </head>
  <body>
    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/noscript.php"); ?>
	<div>
	  <div>
	    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/heading.php"); ?>
		<div>
		  <a id="login" href="/user/logout.php">Logout</a>
		  <span id="menu"><a style="background-color:white;color:#750909;">View</a> <a href="/user/edit.php">Edit</a></span><p class="sb">&nbsp;</p><p class="sb">&nbsp;</p>
		  <h2 class="sb">Welcome <?php echo $Sfirstname." ".$Slastname ?>!</h2>
		  <h3 class="sb center">Membership Information</h3>
		  <p class="b sb"><?php if($type == "student"){echo "Student";}else{echo "Mentor";} ?></p>
		  <p class="sb">Name: <span><?php echo $Sfirstname." ".$Slastname ?></span></p>
		  <p class="sb">Street Address 1: <span><?php echo $Saddress1 ?></span></p>
		  <p class="sb">Street Address 2: <span><?php echo $Saddress2 ?></span></p>
		  <p class="sb">City: <span><?php echo $Scity ?></span></p>
		  <p class="sb">State: <span><?php echo $Sstate ?></span></p>
		  <p class="sb">Zip: <span><?php echo $Szip ?></span></p>
		  <p class="sb"><?php echo $SmPhoneType ?> Phone: <span>(<?php echo $SmPhone1 ?>) <?php echo $SmPhone2 ?>-<?php echo $SmPhone3 ?></span>
		  <?php if($SsPhoneType <> ""): ?><p class="sb"><?php echo $SsPhoneType ?> Phone: <span>(<?php echo $SsPhone1 ?>) <?php echo $SsPhone2 ?>-<?php echo $SsPhone3 ?></span><?php endif ?>
		  <p class="sb">Email: <span><?php echo $Semail ?></span></p>
		  <p class="sb">Birthday: <span><?php echo date("m/d/Y",$Sbirthday) ?></span></p>
		  <p class="sb">Gender: <span><?php echo $Sgender ?></span></p>
		  <p class="sb">Ethnicity: <span><?php echo $Sethnicity ?></span></p>
		  <?php if($type == "student"): ?>
		  <p class="sb">School: <span><?php echo $Sschool ?></span></p>
		  <p class="sb">Year of Graduation: <span><?php echo $Syog ?></span></p>
		  <?php endif; ?>
		  <p class="sb">T-Shirt Size: <span><?php echo $Stshirt ?></span></p>
		  <p class="b sb"><?php if($type == "mentor"){echo "Emergency Contact";}else{echo "Parent(s)/Guardian";} ?></p>
		  <p class="sb">Name: <span><?php echo $P1firstname." ".$P1lastname ?></span></p>
		  <p class="sb"><?php echo $P1mPhoneType ?> Phone: <span>(<?php echo $P1mPhone1 ?>) <?php echo $P1mPhone2 ?>-<?php echo $P1mPhone3 ?></span>
		  <?php if($P1sPhoneType <> ""): ?><p class="sb"><?php echo $P1sPhoneType ?> Phone: <span>(<?php echo $P1sPhone1 ?>) <?php echo $P1sPhone2 ?>-<?php echo $P1sPhone3 ?></span><?php endif ?>
		  <p class="sb">Email: <span><?php echo $P1email ?></span></p>
		  <?php if($type == "student" && $P2firstname <> ""): ?>
		  <p>&nbsp;</p>
		  <p class="sb">Name: <span><?php echo $P2firstname." ".$P2lastname ?></span></p>
		  <p class="sb"><?php echo $P2mPhoneType ?> Phone: <span>(<?php echo $P2mPhone1 ?>) <?php echo $P2mPhone2 ?>-<?php echo $P2mPhone3 ?></span>
		  <?php if($P2sPhoneType <> ""): ?><p class="sb"><?php echo $P2sPhoneType ?> Phone: <span>(<?php echo $P2sPhone1 ?>) <?php echo $P2sPhone2 ?>-<?php echo $P2sPhone3 ?></span><?php endif ?>
		  <p class="sb">Email: <span><?php echo $P2email ?></span></p>
		  <?php endif ?>
		  <h3 class="center"><?php if($type == "student"){echo "Student";}else{echo "Mentor";} ?> Health Information</h3>
		  <p class="b sb">Doctor</p>
		  <p class="sb">Name: <span><?php echo $Hdoctor ?></span></p>
		  <p class="sb">Street Address 1: <span><?php echo $Haddress1 ?></span></p>
		  <p class="sb">Street Address 2: <span><?php echo $Haddress2 ?></span></p>
		  <p class="sb">City: <span><?php echo $Hcity ?></span></p>
		  <p class="sb">State: <span><?php echo $Hstate ?></span></p>
		  <p class="sb">Zip: <span><?php echo $Hzip ?></span></p>
		  <p class="sb">Phone: <span>(<?php echo $Hphone1 ?>) <?php echo $Hphone2 ?>-<?php echo $Hphone3 ?></span>
		  <p>&nbsp;</p>
		  <p class="sb">Preferred Hospital: <span><?php echo $Hhospital ?></span></p>
		  <span><?php if($Hallergies == ""){echo "No allergies";}else{echo "<span style='color:black'>Allergies: </span>".$HallergiesE;} ?></span>
		  <h3 class="sb center">Agreement</h3>
		  <p class="sb"><input type="checkbox" checked disabled readonly> I agree to my photo being taken at any team activity/event and used for team publicity purposes by mail, email, newsletter or website.</p>
		  <p class="sb"><input type="checkbox" checked disabled readonly> I agree to my personal contact information being shared with other team members and parents.</p>
		  <p class="sb"><input type="checkbox" checked disabled readonly> I have read and agree to the <a href="/files/TeamHandbook-RevF.pdf" target="_blank">Team Handbook</a>.</p>
		  <p class="sb"><input type="checkbox" checked disabled readonly> I have read the <a href="http://www.firstinspires.org/resource-library/youth-protection-policy" target="_blank">FIRST Youth Protection Program Guide</a>.</p>
		  <p class="sb"><input type="checkbox" checked disabled readonly> I have read the <a href="http://www.firstinspires.org/resource-library/frc/safety-manual" target="_blank">FIRST Safety Manual</a>.</p>
		  <?php if($type == "mentor"): ?><p class="sb"><input type="checkbox" checked disabled readonly> I have read the <a href="http://archive.firstinspires.org/uploadedFiles/Community/FRC/Team_Resources/Mentoring%20Guide.pdf" target="_blank">FIRST Mentoring Guide</a>.</p><?php endif ?>
		  <p><b>Signed by:</b> <?php echo $approvedBy ?> <b>on</b> <?php echo $approvedDate ?></p>
		  </form>
		</div>
	  </div>
	</div>
  </body>
</html>