<?php
session_start();
if (isset($_SESSION['admin_LAST_ACTIVITY']) && (time() - $_SESSION['admin_LAST_ACTIVITY'] > 1800)) {
    unset($_SESSION['admin_login']);
}
$_SESSION['admin_LAST_ACTIVITY'] = time();

if(isset($_SESSION['admin_login']) == false){
  header('Location: /admin/login.php');
}

include("/nfs/c06/h04/mnt/157266/domains/register.team2342.org/data/database_pwd.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('America/New_York');

function age($date){
    $from = new DateTime($date);
	$to   = new DateTime('today');
	return $from->diff($to)->y;
}

$page = $_REQUEST['c'];

if($page == 'saa'){
  $title = 'Potenial Students Awaiting Approval';
} elseif($page == 'stims'){
  $title = 'Students Registered with STIMS';
} elseif($page == 'nes'){
  $title = 'NE FIRST Consent and Release Agreement (Students)';
} elseif($page == 'sapa'){
  $title = 'Potenial Students Awaiting Parent Approval';
} elseif($page == 'sl'){
  $title = 'List of Students with Parents';
} elseif($page == 'maa'){
  $title = 'Potenial Mentors Awaiting Approval';
} elseif($page == 'tims'){
  $title = 'Mentors Registered with TIMS';
} elseif($page == 'nem'){
  $title = 'NE FIRST Consent and Release Agreement (Mentors)';
} elseif($page == 'ml'){
  $title = 'List of Mentors';
} elseif($page == 'txt'){
  $title = 'Texting List';
} elseif($page == ''){
  $page = "home";
  $title = "Home";
}

$id = str_replace("'","",$_REQUEST['id']);
$e = str_replace("'","",$_REQUEST['e']);

if ($_SERVER["REQUEST_METHOD"] == "POST" && ($page == 'sl' || $page == 'ml') && $id == true && $e == true) {
  $Sfirstname      = ucwords(str_replace("'","",$_REQUEST['Sfirstname']));
  $Slastname       = ucwords(str_replace("'","",$_REQUEST['Slastname']));
  $Saddress1       = ucwords(str_replace("'","",$_REQUEST['Saddress1']));
  $Saddress2       = ucwords(str_replace("'","",$_REQUEST['Saddress2']));
  $Scity           = ucwords(str_replace("'","",$_REQUEST['Scity']));
  $Sstate          = str_replace("'","",$_REQUEST['Sstate']);
  $Szip            = str_replace("'","",$_REQUEST['Szip']);
  $SmPhoneType     = str_replace("'","",$_REQUEST['SmPhoneType']);
  $SmPhone1        = str_replace("'","",$_REQUEST['SmPhone1']);
  $SmPhone2        = str_replace("'","",$_REQUEST['SmPhone2']);
  $SmPhone3        = str_replace("'","",$_REQUEST['SmPhone3']);
  $SsPhoneType     = str_replace("'","",$_REQUEST['SsPhoneType']);
  $SsPhone1        = str_replace("'","",$_REQUEST['SsPhone1']);
  $SsPhone2        = str_replace("'","",$_REQUEST['SsPhone2']);
  $SsPhone3        = str_replace("'","",$_REQUEST['SsPhone3']);
  $Semail          = strtolower(str_replace("'","",$_REQUEST['Semail']));
  $Sbirthday       = str_replace("'","",$_REQUEST['SbirthdayY']."-".$_REQUEST['SbirthdayM']."-".$_REQUEST['SbirthdayD']);
  $Sgender         = str_replace("'","",$_REQUEST['Sgender']);
  $Sethnicity      = str_replace("'","",$_REQUEST['Sethnicity']);
  $Sschool         = str_replace("'","",$_REQUEST['Sschool']);
  $Sschoolother    = str_replace("'","",$_REQUEST['Sschoolother']);
  $Syog            = str_replace("'","",$_REQUEST['Syog']);
  $Stshirt         = str_replace("'","",$_REQUEST['Stshirt']);
  $Hdoctor         = ucwords(str_replace("'","",$_REQUEST['Hdoctor']));
  $Haddress1       = ucwords(str_replace("'","",$_REQUEST['Haddress1']));
  $Haddress2       = ucwords(str_replace("'","",$_REQUEST['Haddress2']));
  $Hcity           = ucwords(str_replace("'","",$_REQUEST['Hcity']));
  $Hstate          = str_replace("'","",$_REQUEST['Hstate']);
  $Hzip            = str_replace("'","",$_REQUEST['Hzip']);
  $Hphone1         = str_replace("'","",$_REQUEST['Hphone1']);
  $Hphone2         = str_replace("'","",$_REQUEST['Hphone2']);
  $Hphone3         = str_replace("'","",$_REQUEST['Hphone3']);
  $Hhospital       = ucwords(str_replace("'","",$_REQUEST['Hhospital']));
  $Hallergies      = str_replace("'","",$_REQUEST['Hallergies']);
  $HallergiesE     = str_replace("'","",$_REQUEST['HallergiesE']);

if($Sschool == "Other") $Sschool = $Sschoolother;

$sql = "UPDATE Users SET 
firstname='$Sfirstname', 
lastname='$Slastname', 
address1='$Saddress1', 
address2='$Saddress2', 
city='$Scity', 
state='$Sstate', 
zip='$Szip', 
mPhoneType='$SmPhoneType', 
mPhone1='$SmPhone1', 
mPhone2='$SmPhone2', 
mPhone3='$SmPhone3', 
sPhoneType='$SsPhoneType', 
sPhone1='$SsPhone1', 
sPhone2='$SsPhone2', 
sPhone3='$SsPhone3', 
email='$Semail',
birthday='$Sbirthday', 
gender='$Sgender', 
ethnicity='$Sethnicity', 
school='$Sschool', 
YOG='$Syog', 
tshirt='$Stshirt', 
Hdoctor='$Hdoctor', 
Haddress1='$Haddress1', 
Haddress2='$Haddress2', 
Hcity='$Hcity', 
Hstate='$Hstate', 
Hzip='$Hzip', 
Hphone1='$Hphone1', 
Hphone2='$Hphone2', 
Hphone3='$Hphone3', 
Hhospital='$Hhospital', 
Hallergies='$Hallergies', 
HallergiesE='$HallergiesE' 
WHERE ID=".$id;
$conn->query($sql);
  
  $form = false;
  $thx = true;
  
  header("Location: /admin/back.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/head.php"); ?>
<style>
td
{
width:200px;
border-bottom:1px solid #d3d3d3;
padding-bottom:3px;
}
tr:first-child td
{
font-weight:bold;
}
table#list tr td
{
width:400px;
color:#424242;
}
table#list tr td:first-child
{
width:150px;
color:black;
}
table#list tr.title td
{
font-weight:bold;
}
</style>
<script type="text/javascript">
window.setTimeout("window.location='/admin/logout.php?r=timeout';",1800000);
</script>
  </head>
  <body>
    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/noscript.php"); ?>
	<div>
	  <div>
	    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/heading.php"); ?>
		<div>
		  <a id="login" href="/admin/logout.php">Logout</a>
		  <h2 class="sb"><a style="color:black;text-decoration:none;" href="./">Admin Console</a></h2>
		  <div id="admin-menu">
		    <ul>
			  <li>Students</li>
			  <ul>
			    <li><a href="?c=saa">Awaiting Approval</a></li>
				<li><a href="?c=sapa">Awating Parent Approval</a></li>
				<li><a href="?c=stims">STIMS</a></li>
				<li><a href="?c=nes">NE FIRST</a></li>
				<li><a href="?c=sl">List</a></li>
			  </ul>
			  <li>Mentors</li>
			  <ul>
			    <li><a href="?c=maa">Awaiting Approval</a></li>
				<li><a href="?c=tims">TIMS</a></li>
				<li><a href="?c=nem">NE FIRST</a></li>
				<li><a href="?c=ml">List</a></li>
			  </ul>
			  <li><a href="?c=txt">Texting List</a></li>
			  <li><a href="/stats.php">Statistics and Demographics</a></li>
			</ul>
		  </div>
		  <div id="admin-content">
		    <h2><?php echo $title ?></h2>
<?php if($page == 'home'):
$sql = "SELECT * FROM Users WHERE type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$sN = (string)$result->num_rows;
$sql = "SELECT * FROM Users WHERE type='student' AND approved='0'";
$result = $conn->query($sql);
$saaN = (string)$result->num_rows;
$sql = "SELECT * FROM Users WHERE type='student' AND approved='1' AND parentApproved='0'";
$result = $conn->query($sql);
$sapaN = (string)$result->num_rows;
$sql = "SELECT * FROM Users WHERE type='student' AND approved='1' AND parentApproved='1' AND stims='0'";
$result = $conn->query($sql);
$stimsN = (string)$result->num_rows;
$sql = "SELECT * FROM Users WHERE type='mentor' AND approved='1'";
$result = $conn->query($sql);
$mN = (string)$result->num_rows;
$sql = "SELECT * FROM Users WHERE type='mentor' AND approved='0'";
$result = $conn->query($sql);
$maaN = (string)$result->num_rows;
$sql = "SELECT * FROM Users WHERE type='mentor' AND approved='1' AND stims='0'";
$result = $conn->query($sql);
$timsN = (string)$result->num_rows;
$parents = "ID='0'";
$sql = "SELECT * FROM Users WHERE type='student' AND approved='1' AND parentApproved='1' ORDER BY firstname";
$result = $conn->query($sql);
if ($result->num_rows > 0){
	while($row = $result->fetch_assoc()){
		$parents .= " OR ID='".$row["parent1ID"]."'";
		if($row["parent2ID"] != '0') $parents .= " OR ID='".$row["parent2ID"]."'";
	}
}
$sql = "SELECT * FROM Users WHERE (type='student' OR type='mentor' OR ($parents)) AND approved='1' AND parentApproved='1' AND txt='0'";
$result = $conn->query($sql);
if ($result->num_rows > 1){$upd = "<b>Requires</b>";}else{$upd = "Does Not Require";}
?>
<p>&nbsp;</p>
<h3><?php echo $sN ?> Student(s) registered</h3>
<p>&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $saaN ?></b> awaiting approval</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $sapaN ?></b> awaiting parent approval</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $stimsN ?></b> not registered for STIMS</p>
<p>&nbsp;</p>
<h3><?php echo $mN ?> Mentor(s) registered</h3>
<p>&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $maaN ?></b> awaiting approval</p>
<p>&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $timsN ?></b> not registered for TIMS</p>
<p>&nbsp;</p>
<p>Texting List <?php echo $upd ?> Updating</p>
<?php endif; ?>
<?php if($page == 'saa'):
$id = $_REQUEST["id"];
$approve = $_REQUEST["a"];
if($id == true){
    $sql = "SELECT * FROM Users WHERE type='student' AND ID=".$id;
	$result = $conn->query($sql);
    if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
            echo "Name: ".$row['firstname']." ".$row['lastname']."<br>
Email: ".$row['email']."<br>
School: ".$row['school']."<br>
<a href='?c=sl&id=".$id."'>Details</a><br><br>
<h3><a href='?c=saa&id=".$id."&a=true'>Approve</a></h3>
<a id='login' href='?c=saa'>Back</a>";
$Sfirstname = $row['firstname'];
$Slastname = $row['lastname'];
$Semail = $row['email'];
$P1ID = $row['parent1ID'];
$P2ID = $row['parent2ID'];
$ap = $row['approved'];
$age = age($row['birthday']);
	    }
    } else {
        echo "Error";
    }
	if($approve == true && $ap == '0'){
		$up = "UPDATE Users SET approved='1' WHERE ID=".$id;
		$conn->query($up);
		$sql = "SELECT * FROM Users WHERE ID=".$P1ID;
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){$P1firstname = $row['firstname'];$P1lastname = $row['lastname'];$P1email = $row['email'];$P1mPhoneType = $row['mPhoneType'];$P1mPhone1 = $row['mPhone1'];$P1mPhone2 = $row['mPhone2'];$P1mPhone3 = $row['mPhone3'];$P1sPhoneType = $row['sPhoneType'];$P1sPhone1 = $row['sPhone1'];$P1sPhone2 = $row['sPhone2'];$P1sPhone3 = $row['sPhone3'];}
		$sql = "SELECT * FROM Users WHERE ID=".$P2ID;
		$result = $conn->query($sql);
		if($age < 18){
			while($row = $result->fetch_assoc()){$P2firstname = $row['firstname'];$P2lastname = $row['lastname'];$P2email = $row['email'];$P2mPhoneType = $row['mPhoneType'];$P2mPhone1 = $row['mPhone1'];$P2mPhone2 = $row['mPhone2'];$P2mPhone3 = $row['mPhone3'];$P2sPhoneType = $row['sPhoneType'];$P2sPhone1 = $row['sPhone1'];$P2sPhone2 = $row['sPhone2'];$P2sPhone3 = $row['sPhone3'];}
			mail("$P1email, $P2email", "Your Child's Registration with FRC Team 2342",
"Dear Parent(s)/Guardian of $Sfirstname $Slastname,

Your child has resently registered with FIRST Robotics Team 2342's online member registration system. We require that at least one parent/guardian to agree to our terms and conditions. Please visit http://register.team2342.org/confirmation.php?id=$id to confirm and agree.

Thank you for your time,
The Team Member Registration System
", "From: Team Member Registration System <help@team2342.org>");
		}
		$sql = "SELECT * FROM Users WHERE firstname='$P1firstname' AND lastname='$P1lastname' AND (type='mentor' OR type='parent') AND approved='1' AND !(ID=$P1ID)";
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){$P1IDnew = $row['ID'];}
			$sql = "UPDATE Users SET mPhoneType='$P1mPhoneType', mPhone1='$P1mPhone1', mPhone2='$P1mPhone2', mPhone3='$P1mPhone3', sPhoneType='$P1sPhoneType', sPhone1='$P1sPhone1', sPhone2='$P1sPhone2', sPhone3='$P1sPhone3', email='$P1email' WHERE ID=".$P1IDnew;
			$conn->query($sql);
			$sql = "UPDATE Users SET parent1ID='$P1IDnew' WHERE ID=".$id;
			$conn->query($sql);
			$sql = "DELETE FROM Users WHERE ID=".$P1ID;
			$conn->query($sql);
			$P1ID = $P1IDnew;
		} else {
			$up = "UPDATE Users SET approved='1' WHERE ID=".$P1ID;
			$conn->query($up);
		}
		$sql = "SELECT * FROM Users WHERE firstname='$P2firstname' AND lastname='$P2lastname' AND (type='mentor' OR type='parent') AND approved='1' AND !(ID=$P2ID)";
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){$P2IDnew = $row['ID'];}
			$sql = "UPDATE Users SET mPhoneType='$P2mPhoneType', mPhone1='$P2mPhone1', mPhone2='$P2mPhone2', mPhone3='$P2mPhone3', sPhoneType='$P2sPhoneType', sPhone1='$P2sPhone1', sPhone2='$P2sPhone2', sPhone3='$P2sPhone3', email='$P2email' WHERE ID=".$P2IDnew;
			$conn->query($sql);
			$sql = "UPDATE Users SET parent2ID='$P2IDnew' WHERE ID=".$id;
			$conn->query($sql);
			$sql = "DELETE FROM Users WHERE ID=".$P2ID;
			$conn->query($sql);
			$P2ID = $P2IDnew;
		} else {
			$up = "UPDATE Users SET approved='1' WHERE ID=".$P2ID;
			$conn->query($up);
		}
		if($P1ID == $P2ID){
			$P2ID = '0';
			$sql = "UPDATE Users SET parent2ID='0' WHERE ID=".$id;
			$conn->query($sql);
		}
		if($age >= 18){
			$up = "UPDATE Users SET parentApproved='1' WHERE ID=".$id;
			$conn->query($up);
			$up = "UPDATE Users SET parentApproved='1' WHERE ID=".$P1ID;
			$conn->query($up);
			$up = "UPDATE Users SET parentApproved='1' WHERE ID=".$P2ID;
			$conn->query($up);
			mail("$Semail","You're registered with Team 2342",
"Dear $Sfirstname $Slastname,

Your registration with FIRST Robotics Team 2342 has been confirmed.

Thank you for your time,
The Team Member Registration System
", "From: Team Member Registration System <help@team2342.org>");
		}
		echo " Approved.";
	}
} else {
$sql = "SELECT firstname, lastname, ID, school FROM Users WHERE type='student' AND approved='0'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
	echo "<tr><td>Name</td><td>School</td><td>ID</td></tr>";
	while($row = $result->fetch_assoc()) {
        echo "<tr>"."<td><a href='?c=saa&id=".$row["ID"]."'>".$row["firstname"]." ".$row["lastname"]."</a></td>"."<td>".$row["school"]."</td>"."<td>".$row["ID"]."</td>"."</tr>";
    }
	echo "</table>";
} else {
    echo "0 results";
}
} endif; ?>
<?php if($page == 'sapa'):
$id = $_REQUEST["id"];
if($id == true){
	$sql = "SELECT * FROM Users WHERE type='student' AND approved='1' AND parentApproved='0' AND ID=".$id;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
			$P1ID = $row['parent1ID'];
			$P2ID = $row['parent2ID'];
		}
		$sql = "SELECT * FROM Users WHERE ID=".$P1ID;
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){$P1email = $row['email'];}
		$sql = "SELECT * FROM Users WHERE ID=".$P2ID;
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){$P2email = $row['email'];}
		mail("$P1email, $P2email", "Your Child's Registration with FRC Team 2342",
"Dear Parent(s)/Guardian of $firstname $lastname,

Your child has resently registered with FIRST Robotics Team 2342's online member registration system. We require that at least one parent/guardian to agree to our terms and conditions. Please visit http://register.team2342.org/confirmation.php?id=$id to confirm and agree.

Thank you for your time,
The Team Member Registration System
", "From: Team Member Registration System <help@team2342.org>");
		echo "Confirmation message resent to $firstname $lastname's parents.<br><br><a id='login' href='javascript:history.go(-1)'>Back</a>";
	} else {
		echo "Error.";
	}
} else {
$sql = "SELECT firstname, lastname, ID, school FROM Users WHERE type='student' AND approved='1' AND parentApproved='0'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
	echo "<tr><td>Name</td><td>ID</td><td>Resend confirmation</td></tr>";
	while($row = $result->fetch_assoc()) {
        echo "<tr><td><a href='?c=sl&id=".$row["ID"]."'>".$row["firstname"]." ".$row["lastname"]."</a></td>"."<td>".$row["ID"]."</td>"."<td><a href='?c=sapa&id=".$row["ID"]."'>Resend</a></td></tr>";
    }
	echo "</table>";
} else {
    echo "0 results";
}
} endif; ?>
<?php if($page == 'stims' || $page == 'tims'):
$id = $_REQUEST["id"];
$reType = $_REQUEST["r"];

if($id == true){
$sql = "SELECT stims FROM Users WHERE ID=".$id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if($row['stims'] == '0' && $reType == '1'){
		    $up = "UPDATE Users SET stims='1' WHERE ID=".$id;
			$conn->query($up);
			echo "Status changed to Registered.<br><br><a id='login' href='javascript:history.go(-1)'>Back</a>";
		} elseif($row['stims'] == '1' && $reType == '0'){
		    $up = "UPDATE Users SET stims='0' WHERE ID=".$id;
			$conn->query($up);
			echo "Status changed to Not Registered.<br><br><a id='login' href='javascript:history.go(-1)'>Back</a>";
		} else {
			echo "Error";
		}
    }
} else {
    echo "Error";
}

} else {
if($page == 'stims') $sql = "SELECT firstname, lastname, stims, ID FROM Users WHERE type='student' AND approved='1' AND parentApproved='1' ORDER BY firstname, lastname";
if($page == 'tims') $sql = "SELECT firstname, lastname, stims, ID FROM Users WHERE type='mentor' AND approved='1' ORDER BY firstname, lastname";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
	echo "<tr><td>Name</td><td>Status</td><td></td></tr>";
	while($row = $result->fetch_assoc()) {
        echo "<tr>"."<td>".$row["firstname"]." ".$row["lastname"]."</td>";
		echo "<td>";
		if($row["stims"] == '0'){
			if($page == 'stims') echo "<a href='?c=stims&r=1&id=".$row["ID"]."' title='Click to change'>Not Registered</a>";
			if($page == 'tims') echo "<a href='?c=tims&r=1&id=".$row["ID"]."' title='Click to change'>Not Registered</a>";
		} elseif($row["stims"] == '1'){
			if($page == 'stims') echo "<a href='?c=stims&r=0&id=".$row["ID"]."' title='Click to change'>Registered</a>";
			if($page == 'tims') echo "<a href='?c=tims&r=0&id=".$row["ID"]."' title='Click to change'>Registered</a>";
		}
		echo "</td>";
		echo "</tr>";
    }
	echo "</table>";
} else {
    echo "0 results";
}
} endif; ?>
<?php if($page == 'nes' || $page == 'nem'):
$id = $_REQUEST["id"];
$reType = $_REQUEST["r"];

if($id == true){
$sql = "SELECT NEcr FROM Users WHERE ID=".$id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		if($row['NEcr'] == '0' && $reType == '1'){
		    $up = "UPDATE Users SET NEcr='1' WHERE ID=".$id;
			$conn->query($up);
			echo "Status changed to Completed.<br><br><a id='login' href='javascript:history.go(-1)'>Back</a>";
		} elseif($row['NEcr'] == '1' && $reType == '0'){
		    $up = "UPDATE Users SET NEcr='0' WHERE ID=".$id;
			$conn->query($up);
			echo "Status changed to Not Completed.<br><br><a id='login' href='javascript:history.go(-1)'>Back</a>";
		} else {
			echo "Error";
		}
    }
} else {
    echo "Error";
}

} else {
if($page == 'nes') $sql = "SELECT firstname, lastname, NEcr, ID FROM Users WHERE type='student' AND approved='1' AND parentApproved='1' AND stims='1' ORDER BY firstname, lastname";
if($page == 'nem') $sql = "SELECT firstname, lastname, NEcr, ID FROM Users WHERE type='mentor' AND approved='1' AND stims='1' ORDER BY firstname, lastname";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
	echo "<tr><td>Name</td><td>Status</td><td></td></tr>";
	while($row = $result->fetch_assoc()) {
        echo "<tr>"."<td>".$row["firstname"]." ".$row["lastname"]."</td>";
		echo "<td>";
		if($row["NEcr"] == '0'){
			if($page == 'nes') echo "<a href='?c=nes&r=1&id=".$row["ID"]."' title='Click to change'>Not Completed</a>";
			if($page == 'nem') echo "<a href='?c=nem&r=1&id=".$row["ID"]."' title='Click to change'>Not Completed</a>";
		} elseif($row["NEcr"] == '1'){
			if($page == 'nes') echo "<a href='?c=nes&r=0&id=".$row["ID"]."' title='Click to change'>Completed</a>";
			if($page == 'nem') echo "<a href='?c=nem&r=0&id=".$row["ID"]."' title='Click to change'>Completed</a>";
		}
		echo "</td>";
		echo "</tr>";
    }
	echo "</table>";
} else {
    echo "0 results";
}
} endif; ?>
<?php if($page == 'txt'):
echo "<p class='sb'>Send a text to the team.</p>";
echo "
<form id='registration-form' action='/admin/send-text.php' method='post'>
<p class='sb'>Groups: 
	<select name='groups'>
		<option name='s,m'>Students, Mentors</option>
		<option name='s,m,p'>Students, Mentors, Parents</option>
		<option name='s'>Students</option>
		<option name='m'>Mentors</option>
		<option name='p'>Parents</option>
		<option name='m,p'>Mentors, Parents</option>
		<option name='s,p'>Students, Parents</option>
	</select>
</p>
<p class='sb'>Text Message:<br><textarea name='textmessage' maxlength='160'></textarea></p>
<p class='sb'>Use <a href='http://goo.gl' target='_blank'>goo.gl</a> URL shortener for shorter URLs.</p>
<p><input type='submit' value='Send'></p>
";
endif; ?>
<?php if($page == 'maa'):
$Mid = $_REQUEST["id"];
$Mapprove = $_REQUEST["a"];
if($Mid == true){
    $sql = "SELECT * FROM Users WHERE type='mentor' AND ID=".$Mid;
	$result = $conn->query($sql);
    if ($result->num_rows > 0) {
	    while($row = $result->fetch_assoc()) {
            if($row['gender'] == 'Male'){$dg = 'him';}elseif($row['gender'] == 'Female'){$dg = 'her';}else{$dg = 'him/her';}
			echo "Name: ".$row['firstname']." ".$row['lastname']."<br>
Email: ".$row['email']."<br>
<a href='?c=sl&id=".$Mid."'>Details</a><br><br>
<b>Do not approve this mentor until you have invited $dg in TIMS.</b><br><br>
<h3><a href='?c=maa&id=".$Mid."&a=true'>Approve</a></h3>
<a id='login' href='?c=maa'>Back</a>";
$P1ID = $row['parent1ID'];
$Mfirstname = $row['firstname'];
$Mlastname = $row['lastname'];
$address1 = $row['address1'];
$address2 = $row['address2'];
$city = $row['city'];
$state = $row['state'];
$zip = $row['zip'];
$mPhoneType = $row['mPhoneType'];
$mPhone1 = $row['mPhone1'];
$mPhone2 = $row['mPhone2'];
$mPhone3 = $row['mPhone3'];
$sPhoneType = $row['sPhoneType'];
$sPhone1 = $row['sPhone1'];
$sPhone2 = $row['sPhone2'];
$sPhone3 = $row['sPhone3'];
$Memail = $row['email'];
$birthday = $row['birthday'];
$gender = $row['gender'];
$ethnicity = $row['ethnicity'];
$tshirt = $row['tshirt'];
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
$Map = $row['approved'];
	    }
    } else {
        echo "Error";
    }
	if($Mapprove == true && $Map == '0'){
		mail($Memail, "Your Registration with FRC Team 2342",
"Dear $Mfirstname $Mlastname,

Your registration with FIRST Robotics Team 2342 has been approved.

Thank you for your time,
The Team Member Registration System
", "From: Team Member Registration System <help@team2342.org>");
		$sql = "SELECT * FROM Users WHERE firstname='$Mfirstname' AND lastname='$Mlastname' AND (type='mentor' OR type='parent') AND approved='1' AND !(ID=$Mid)";
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){$MIDnew = $row['ID'];}
			$sql = "UPDATE Users SET firstname='$Mfirstname', lastname='$Mlastname', address1='$address1', address2='$address2', city='$city', state='$state', zip='$zip', mPhoneType='$mPhoneType', mPhone1='$mPhone1', mPhone2='$mPhone2', mPhone3='$mPhone3', sPhoneType='$sPhoneType', sPhone1='$sPhone1', sPhone2='$sPhone2', sPhone3='$sPhone3', email='$Memail', birthday='$birthday', gender='$gender', ethnicity='$ethnicity', tshirt='$tshirt', Hdoctor='$Hdoctor', Haddress1='$Haddress1', Haddress2='$Haddress2', Hcity='$Hcity', Hstate='$Hstate', Hzip='$Hzip', Hphone1='$Hphone1', Hphone2='$Hphone2', Hphone3='$Hphone3', Hhospital='$Hhospital', Hallergies='$Hallergies', HallergiesE='$HallergiesE', type='mentor' WHERE ID=".$MIDnew;
			$conn->query($sql);
			$sql = "DELETE FROM Users WHERE ID=".$Mid;
			$conn->query($sql);
			$Mid = $MIDnew;
		} else {
			$up = "UPDATE Users SET approved='1' WHERE ID=".$Mid;
			$conn->query($up);
		}
		$sql = "SELECT * FROM Users WHERE ID=".$P1ID;
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){$P1firstname = $row['firstname'];$P1lastname = $row['lastname'];$P1email = $row['email'];$P1mPhoneType = $row['mPhoneType'];$P1mPhone1 = $row['mPhone1'];$P1mPhone2 = $row['mPhone2'];$P1mPhone3 = $row['mPhone3'];$P1sPhoneType = $row['sPhoneType'];$P1sPhone1 = $row['sPhone1'];$P1sPhone2 = $row['sPhone2'];$P1sPhone3 = $row['sPhone3'];}
		$sql = "SELECT * FROM Users WHERE firstname='$P1firstname' AND lastname='$P1lastname' AND (type='mentor' OR type='parent') AND approved='1' AND !(ID=$P1ID)";
		$result = $conn->query($sql);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()){$P1IDnew = $row['ID'];}
			$sql = "UPDATE Users SET mPhoneType='$P1mPhoneType', mPhone1='$P1mPhone1', mPhone2='$P1mPhone2', mPhone3='$P1mPhone3', sPhoneType='$P1sPhoneType', sPhone1='$P1sPhone1', sPhone2='$P1sPhone2', sPhone3='$P1sPhone3', email='$P1email' WHERE ID=".$P1IDnew;
			$conn->query($sql);
			$sql = "UPDATE Users SET parent1ID='$P1IDnew' WHERE ID=".$Mid;
			$conn->query($sql);
			$sql = "DELETE FROM Users WHERE ID=".$P1ID;
			$conn->query($sql);
			$P1ID = $P1IDnew;
		} else {
			$up = "UPDATE Users SET approved='1' WHERE ID=".$P1ID;
			$conn->query($up);
		}
		$sql = "UPDATE Users SET parentApproved='1' WHERE ID=".$Mid;
		$conn->query($sql);
		$sql = "UPDATE Users SET parentApproved='1' WHERE ID=".$P1ID;
		$conn->query($sql);
		echo " Approved.";
	}
} else {
$sql = "SELECT firstname, lastname, ID FROM Users WHERE type='mentor' AND approved='0'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
	echo "<tr><td>Name</td><td>ID</td><td></td></tr>";
	while($row = $result->fetch_assoc()) {
        echo "<tr>"."<td><a href='?c=maa&id=".$row["ID"]."'>".$row["firstname"]." ".$row["lastname"]."</a></td>"."<td>".$row["ID"]."</td>"."</tr>";
    }
	echo "</table>";
} else {
    echo "0 results";
}
} endif; ?>
<?php if($page == 'sl' || $page == 'ml'):
$id = str_replace("'","",$_REQUEST['id']);
$e =  str_replace("'","",$_REQUEST['e']);
if($e == true && $id == true){
$sql = "SELECT * FROM Users WHERE ID=".$id;
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
  $Sbirthday = $row['birthday'];
  $SbirthdayY = substr($row['birthday'],0,4);
  $SbirthdayM = substr($row['birthday'],5,2);
  $SbirthdayD = substr($row['birthday'],-2,2);
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
  $type = $row['type'];
}
} else {echo "Error";}
}
if($result->num_rows > 0): ?>
<script type="text/javascript">
<!--
function showMe (it, box) {
  var vis = (box.checked) ? "block" : "none";
  document.getElementById(it).style.display = vis;
}
//-->
</script>
<script type="text/javascript">
function CheckSchool(val){
 if(val==='Other'){
   document.getElementById('school').style.visibility='visible';
 } else{
   document.getElementById('school').style.visibility='hidden';
 }
}
</script>
<form id="registration-form" action="/admin/?c=<?php echo $page ?>&id=<?php echo $id ?>&e=true" method="post">
		    <a id="login" href="javascript:history.go(-1)">Back</a>
			<h3 class="sb center">Membership Information</h3>
		    <p class="b sb">Student</p>
		    <p class="sb">Name: <input type="text" name="Sfirstname" value="<?php echo $Sfirstname ?>"> <input type="text" name="Slastname" value="<?php echo $Slastname ?>"></p>
		    <p class="sb">Street Address 1: <input style="text-transform:capitalize;" type="text" size="40" name="Saddress1" onkeypress="return filter(event,numbers+letters+dot+space)" value="<?php echo $Saddress1 ?>"></p>
			<p class="sb">Street Address 2: <input style="text-transform:capitalize;" type="text" size="40" name="Saddress2" onkeypress="return filter(event,numbers+letters+dot+space)" value="<?php echo $Saddress2 ?>"></p>
			<p class="sb">City: <input style="text-transform:capitalize;" type="text" name="Scity" onkeypress="return filter(event,letters)" value="<?php echo $Scity ?>"></p>
			<p class="sb">State: <select name="Sstate"><option></option><option value="CT" <?php if($Sstate=='CT'){echo 'selected';} ?>>Connecticut</option><option value="ME" <?php if($Sstate=='ME'){echo 'selected';} ?>>Maine</option><option value="MA" <?php if($Sstate=='MA'){echo 'selected';} ?>>Massachusetts</option><option value="NH" <?php if($Sstate=='NH'){echo 'selected';} ?>>New Hampshire</option><option value="RI" <?php if($Sstate=='RI'){echo 'selected';} ?>>Rhode Island</option><option value="VT" <?php if($Sstate=='VT'){echo 'selected';} ?>>Vermont</option></select></p>
			<p class="sb">Zip: <input type="text" size="6" name="Szip" maxlength="5" onkeypress="return filter(event,numbers)" value="<?php echo $Szip ?>"></p>
			<p class="sb">Main Phone: <select name="SmPhoneType"><option></option><option <?php if($SmPhoneType=='Mobile'){echo 'selected';} ?>>Mobile</option><option <?php if($SmPhoneType=='Home'){echo 'selected';} ?>>Home</option><option <?php if($SmPhoneType=='Work'){echo 'selected';} ?>>Work</option></select> (<input id="SmPhone1" type="text" style="width:2em" name="SmPhone1" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $SmPhone1 ?>">) <input id="SmPhone2" type="text" style="width:2em" name="SmPhone2" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $SmPhone2 ?>">-<input id="SmPhone3" type="text" style="width:3em" name="SmPhone3" maxlength="4" onkeypress="return filter(event,numbers)" value="<?php echo $SmPhone3 ?>"></p>
			<p class="sb">Secondary Phone: <select name="SsPhoneType"><option></option><option <?php if($SsPhoneType=='Mobile'){echo 'selected';} ?>>Mobile</option><option <?php if($SsPhoneType=='Home'){echo 'selected';} ?>>Home</option><option <?php if($SsPhoneType=='Work'){echo 'selected';} ?>>Work</option></select> (<input id="SsPhone1" type="text" style="width:2em" name="SsPhone1" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $SsPhone1 ?>">) <input id="SsPhone2" type="text" style="width:2em" name="SsPhone2" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $SsPhone2 ?>">-<input id="SsPhone3" type="text" style="width:3em" name="SsPhone3" maxlength="4" onkeypress="return filter(event,numbers)" value="<?php echo $SsPhone3 ?>"></p>
			<p class="sb">Email: <input type="email" size="40" name="Semail" value="<?php echo $Semail ?>"></p>
			<p class="sb">Birthday<small style="color:gray">(MM/DD/YYYY)</small>: <input type="text" name="SbirthdayM" style="width:1.5em" maxlength="2" onkeypress="return filter(event,numbers)" value="<?php echo $SbirthdayM ?>">/<input type="text" name="SbirthdayD" style="width:1.5em" maxlength="2" onkeypress="return filter(event,numbers)" value="<?php echo $SbirthdayD ?>">/<input type="text" name="SbirthdayY" style="width:2.5em" maxlength="4" onkeypress="return filter(event,numbers)" value="<?php echo $SbirthdayY ?>"></p>
			<p class="sb">Gender: <select name="Sgender"><option></option><option <?php if($Sgender=='Male'){echo 'selected';} ?>>Male</option><option <?php if($Sgender=='Female'){echo 'selected';} ?>>Female</option><option <?php if($Sgender=='Other'){echo 'selected';} ?>>Other</option></select></p>
			<p class="sb">Ethnicity: <select name="Sethnicity"><option></option><option <?php if($Sethnicity=='African American/Black'){echo 'selected';} ?>>African American/Black</option><option <?php if($Sethnicity=='American Indian/Alaskan Native'){echo 'selected';} ?>>American Indian/Alaskan Native</option><option <?php if($Sethnicity=='Asian/Pacific Islander'){echo 'selected';} ?>>Asian/Pacific Islander</option><option <?php if($Sethnicity=='Caucasian/White'){echo 'selected';} ?>>Caucasian/White</option><option <?php if($Sethnicity=='Latino/Latina/Hispanic'){echo 'selected';} ?>>Latino/Latina/Hispanic</option><option <?php if($Sethnicity=='Other'){echo 'selected';} ?>>Other</option></select></p>
			<?php if($type == "student"): ?>
			<p class="sb">
			  School: 
			    <select name="Sschool" onchange="CheckSchool(this.value)">
				  <option></option><?php $other = true ?>
				  <option <?php if($Sschool=='Academy for Science and Design'){echo 'selected';$other=false;} ?>>Academy for Science and Design</option>
				  <option <?php if($Sschool=='Alvirne High School'){echo 'selected';$other=false;} ?>>Alvirne High School</option>
				  <option <?php if($Sschool=='Campbell High School'){echo 'selected';$other=false;} ?>>Campbell High School</option>
				  <option <?php if($Sschool=='Chelmsford High School'){echo 'selected';$other=false;} ?>>Chelmsford High School</option>
				  <option <?php if($Sschool=='Concord Christian Academy'){echo 'selected';$other=false;} ?>>Concord Christian Academy</option>
				  <option <?php if($Sschool=='Groton Dunstable Regional High School'){echo 'selected';$other=false;} ?>>Groton Dunstable Regional High School</option>
				  <option <?php if($Sschool=='Hollis Brookline High School'){echo 'selected';$other=false;} ?>>Hollis Brookline High School</option>
				  <option <?php if($Sschool=='Home School'){echo 'selected';$other=false;} ?>>Home School</option>
				  <option <?php if($Sschool=='Lowell High School'){echo 'selected';$other=false;} ?>>Lowell High School</option>
				  <option <?php if($Sschool=='Merrimack High School'){echo 'selected';$other=false;} ?>>Merrimack High School</option>
				  <option <?php if($Sschool=='Milford High School'){echo 'selected';$other=false;} ?>>Milford High School</option>
				  <option <?php if($Sschool=='Nashua High School North'){echo 'selected';$other=false;} ?>>Nashua High School North</option>
				  <option <?php if($Sschool=='Nashua High School South'){echo 'selected';$other=false;} ?>>Nashua High School South</option>
				  <option <?php if($Sschool=='Next Charter School'){echo 'selected';$other=false;} ?>>Next Charter School</option>
				  <option <?php if($Sschool=='Souhegan High School'){echo 'selected';$other=false;} ?>>Souhegan High School</option>
				  <option <?php if($Sschool=='Westford Academy'){echo 'selected';$other=false;} ?>>Westford Academy</option>
				  <option <?php if($other == true) echo 'selected' ?>>Other</option>
				</select>
			  <input type="text" size="30" name="Sschoolother" id="school" style="<?php if($Sschoolother == true || $other == true){}else{echo 'visibility:hidden';} ?>" placeholder="Other School" value="<?php if($Sschoolother == true){echo $Sschoolother;}elseif($other == true){echo $Sschool;} ?>">
			</p>
<?php
date_default_timezone_set('America/New_York');
$year = date("Y",strtotime("+5 months"));
$twelfth = $year;
$eleventh = $year + 1;
$tenth = $year + 2;
$ninth = $year + 3;
$eighth = $year + 4;
?>
			<p class="sb">Year of Graduation: 
			  <select name="Syog">
			    <option></option>
				<option <?php if($Syog==$twelfth) echo 'selected' ?>><?php echo $twelfth ?></option>
				<option <?php if($Syog==$eleventh) echo 'selected' ?>><?php echo $eleventh ?></option>
				<option <?php if($Syog==$tenth) echo 'selected' ?>><?php echo $tenth ?></option>
				<option <?php if($Syog==$ninth) echo 'selected' ?>><?php echo $ninth ?></option>
				<option <?php if($Syog==$eighth) echo 'selected' ?>><?php echo $eighth ?></option>
			  </select>
			</p>
			<?php endif; ?>
			<p class="sb">T-Shirt Size: <select name="Stshirt"><option></option><option value="S" <?php if($Stshirt=='S'){echo 'selected';} ?>>S</option><option value="M" <?php if($Stshirt=='M'){echo 'selected';} ?>>M</option><option value="L" <?php if($Stshirt=='L'){echo 'selected';} ?>>L</option><option value="XL" <?php if($Stshirt=='XL'){echo 'selected';} ?>>XL</option><option value="XXL" <?php if($Stshirt=='XXL'){echo 'selected';} ?>>XXL</option><option value="XXXL" <?php if($Stshirt=='XXXL'){echo 'selected';} ?>>XXXL</option></select></p>
		    <h3 class="center">Health Information</h3>
			<p class="b sb">Doctor</p>
			<p class="sb">Name: <input type="text" name="Hdoctor" value="<?php echo $Hdoctor ?>"></p>
			<p class="sb">Street Address 1: <input style="text-transform:capitalize;" type="text" size="40" name="Haddress1" onkeypress="return filter(event,numbers+letters+dot+space)" value="<?php echo $Haddress1 ?>"></p>
			<p class="sb">Street Address 2: <input style="text-transform:capitalize;" type="text" size="40" name="Haddress2" onkeypress="return filter(event,numbers+letters+dot+space)" value="<?php echo $Haddress2 ?>"></p>
			<p class="sb">City: <input style="text-transform:capitalize;" type="text" name="Hcity" onkeypress="return filter(event,letters)" value="<?php echo $Hcity ?>"></p>
			<p class="sb">State: <select name="Hstate"><option></option><option value="CT" <?php if($Hstate=='CT'){echo 'selected';} ?>>Connecticut</option><option value="ME" <?php if($Hstate=='ME'){echo 'selected';} ?>>Maine</option><option value="MA" <?php if($Hstate=='MA'){echo 'selected';} ?>>Massachusetts</option><option value="NH" <?php if($Hstate=='NH'){echo 'selected';} ?>>New Hampshire</option><option value="RI" <?php if($Hstate=='RI'){echo 'selected';} ?>>Rhode Island</option><option value="VT" <?php if($Hstate=='VT'){echo 'selected';} ?>>Vermont</option></select></p>
			<p class="sb">Zip: <input type="text" size="6" name="Hzip" maxlength="5" onkeypress="return filter(event,numbers)" value="<?php echo $Hzip ?>"></p>
			<p class="sb">Phone: (<input id="Hphone1" type="text" style="width:2em" name="Hphone1" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $Hphone1 ?>">) <input id="Hphone2" type="text" style="width:2em" name="Hphone2" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $Hphone2 ?>">-<input id="Hphone3" type="text" style="width:3em" name="Hphone3" maxlength="4" onkeypress="return filter(event,numbers)" value="<?php echo $Hphone3 ?>"></p>
			<p>&nbsp;</p>
			<p class="sb">Preferred Hospital: <input type="text" size="40" name="Hhospital" value="<?php echo $Hhospital ?>"></p>
			<p class="sb"><input type="checkbox" name="Hallergies" value="true" onclick="showMe('HallergiesE', this)" <?php if($Hallergies==true){echo 'checked';$Hshow=true;} ?>> I have Allergies / medical conditions</p>
			<span id="HallergiesE" style="<?php if($Hshow==true){}else{echo 'display:none;';} ?>color:black;">
			  <p>Please explain:</p>
			  <textarea name="HallergiesE"><?php echo $HallergiesE ?></textarea>
			</span>
			<p style="margin-top:12px"><input type="submit" value="Update"></p>
		  </form>
<?php endif;
if($id == true && $e == false){
    $sql = "SELECT * FROM Users WHERE ID=".$id;
	$result = $conn->query($sql);
	if ($result->num_rows > 0){while($row = $result->fetch_assoc()){$P1id = $row['parent1ID'];$P2id = $row['parent2ID'];}}
	
	$sql = "SELECT * FROM Users WHERE ID=".$P1id;
	$result = $conn->query($sql);
	if ($result->num_rows > 0){while($row = $result->fetch_assoc()){$P1firstname = $row['firstname'];$P1lastname = $row['lastname'];$P1mPhoneType = $row['mPhoneType'];$P1mPhone1 = $row['mPhone1'];$P1mPhone2 = $row['mPhone2'];$P1mPhone3 = $row['mPhone3'];$P1sPhoneType = $row['sPhoneType'];$P1sPhone1 = $row['sPhone1'];$P1sPhone2 = $row['sPhone2'];$P1sPhone3 = $row['sPhone3'];$P1email = $row['email'];}}
	
	$sql = "SELECT * FROM Users WHERE ID=".$P2id;
	$result = $conn->query($sql);
	if ($result->num_rows > 0){while($row = $result->fetch_assoc()){$P2firstname = $row['firstname'];$P2lastname = $row['lastname'];$P2mPhoneType = $row['mPhoneType'];$P2mPhone1 = $row['mPhone1'];$P2mPhone2 = $row['mPhone2'];$P2mPhone3 = $row['mPhone3'];$P2sPhoneType = $row['sPhoneType'];$P2sPhone1 = $row['sPhone1'];$P2sPhone2 = $row['sPhone2'];$P2sPhone3 = $row['sPhone3'];$P2email = $row['email'];}}
	
	$sql = "SELECT * FROM Users WHERE ID=".$id;
	$result = $conn->query($sql);
	if ($result->num_rows > 0){
		echo "<a id='login' href='javascript:history.go(-1)'>Back</a>";
    	echo "<p>&nbsp;</p>";
		echo "<h3 class='center'>Membership Information</h3>";
		while($row = $result->fetch_assoc()) {
        	echo "<table id='list'>";
			if($row['address2'] != "") $address2 = $row['address2'].",";
			echo "<tr class='title'><td>Student</td><td><a href='/admin/?c=$page&id=$id&e=true'>Edit</a></td></tr>";
			echo "<tr><td>Name</td><td>".$row['firstname']." ".$row['lastname']."</td></tr>";
			echo "<tr><td>Address</td><td>".$row['address1'].", ".$address2." ".$row['city'].", ".$row['state']." ".$row['zip']."</td></tr>";
			echo "<tr><td>Main Phone</td><td>".$row['mPhoneType']." ".$row['mPhone1']." ".$row['mPhone2']." ".$row['mPhone3']."</td></tr>";
			echo "<tr><td>Secondary Phone</td><td>".$row['sPhoneType']." ".$row['sPhone1']." ".$row['sPhone2']." ".$row['sPhone3']."</td></tr>";
			echo "<tr><td>Email</td><td>".$row['email']."</td></tr>";
			$age = age($row['birthday']);
			echo "<tr><td>Birthday</td><td>".date("F j, Y",strtotime($row['birthday']))." (Age $age)</td></tr>";
			echo "<tr><td>Gender</td><td>".$row['gender']."</td></tr>";
			echo "<tr><td>Ethnicity</td><td>".$row['ethnicity']."</td></tr>";
			if($row['type']=='student'){
				echo "<tr><td>School</td><td>".$row['school']."</td></tr>";
				echo "<tr><td>Year of Graduation</td><td>".$row['YOG']."</td></tr>";
			}
			echo "<tr><td>T-Shirt Size</td><td>".$row['tshirt']."</td></tr>";
			if($row['type']=='student'){
				echo "<tr class='title'><td>Parent/Guardian 1</td><td><a href='/admin/?c=$page&id=$P1id&e=true'>Edit</a></td></tr>";
			} elseif($row['type']=='mentor'){
				echo "<tr class='title'><td>Emergency Contact</td><td><a href='/admin/?c=$page&id=$P1id&e=true'>Edit</a></td></tr>";
			}
			echo "<tr><td>Name</td><td>".$P1firstname." ".$P1lastname."</td></tr>";
			echo "<tr><td>Main Phone</td><td>".$P1mPhoneType." ".$P1mPhone1." ".$P1mPhone2." ".$P1mPhone3."</td></tr>";
			echo "<tr><td>Secondary Phone</td><td>".$P1sPhoneType." ".$P1sPhone1." ".$P1sPhone2." ".$P1sPhone3."</td></tr>";
			echo "<tr><td>Email</td><td>".$P1email."</td></tr>";
			if($row['type']=='student' && $P2id != '0'){
				echo "<tr class='title'><td>Parent/Guardian 2</td><td><a href='/admin/?c=$page&id=$P2id&e=true'>Edit</a></td></tr>";
				echo "<tr><td>Name</td><td>".$P2firstname." ".$P2lastname."</td></tr>";
				echo "<tr><td>Main Phone</td><td>".$P2mPhoneType." ".$P2mPhone1." ".$P2mPhone2." ".$P2mPhone3."</td></tr>";
				echo "<tr><td>Secondary Phone</td><td>".$P2sPhoneType." ".$P2sPhone1." ".$P2sPhone2." ".$P2sPhone3."</td></tr>";
				echo "<tr><td>Email</td><td>".$P2email."</td></tr>";
			}
			echo "</table>";
			echo "</table>";
			echo "<p>&nbsp;</p>";
			echo "<h3 class='center'>Health Information</h3>";
			if($row['Haddress2'] != "") $Haddress2 = $row['Haddress2'].",";
			echo "<table id='list'>";
			echo "<tr class='title'><td>Doctor</td><td><a href='/admin/?c=$page&id=$id&e=true'>Edit</a></td></tr>";
			echo "<tr><td>Name</td><td>".$row['Hdoctor']."</td></tr>";
			echo "<tr><td>Address</td><td>".$row['Haddress1'].", ".$Haddress2." ".$row['Hcity'].", ".$row['Hstate']." ".$row['Hzip']."</td></tr>";
			echo "<tr><td>Phone</td><td>".$row['Hphone1']." ".$row['Hphone2']." ".$row['Hphone3']."</td></tr>";
			echo "<tr><td>Preferred Hospital</td><td>".$row['Hhospital']."</td></tr>";
			if($row['Hallergies'] == ""){
				$Hallergies = "";
			} else {
				$Hallergies = $row['HallergiesE'];
			}
			echo "<tr><td>Allergies / medical conditions</td><td>".$Hallergies."</td></tr>";
    	}
		echo "</table>";
	} else {
    	echo "Error";
	}
} elseif($e == false) {
if($page == 'sl') $sql = "SELECT firstname, lastname, ID FROM Users WHERE type='student' AND approved='1' AND parentApproved='1' ORDER BY firstname, lastname";
if($page == 'ml') $sql = "SELECT firstname, lastname, ID FROM Users WHERE type='mentor' AND approved='1' ORDER BY firstname, lastname";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
	echo "<tr><td>Name</td><td>ID</td><td></td></tr>";
	while($row = $result->fetch_assoc()) {
        echo "<tr>"."<td><a href='?c=sl&id=".$row["ID"]."'>".$row["firstname"]." ".$row["lastname"]."</a></td>"."<td>".$row["ID"]."</td>"."</tr>";
    }
	echo "</table>";
} else {
    echo "0 results";
}
} endif;
?>
		  </div>
		</div>
	  </div>
	</div>
  </body>
</html>