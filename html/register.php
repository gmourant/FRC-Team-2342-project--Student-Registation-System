<?php
include("/nfs/c06/h04/mnt/157266/domains/register.team2342.org/data/database_pwd.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function age($date){
    $from = new DateTime($date);
	$to   = new DateTime('today');
	return $from->diff($to)->y;
}

$form = true;

$type = str_replace("'","",$_GET['t']);
$Type = ucwords($type);
if($type == "student") $student = true;
if($type == "mentor") $mentor = true;
if($student == false && $mentor == false) header("Location: /");

date_default_timezone_set('America/New_York');
if($mentor == true) $today = date("Y-m-d");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
  $P1firstname     = ucwords(str_replace("'","",$_REQUEST['P1firstname']));
  $P1lastname      = ucwords(str_replace("'","",$_REQUEST['P1lastname']));
  $P1mPhoneType    = str_replace("'","",$_REQUEST['P1mPhoneType']);
  $P1mPhone1       = str_replace("'","",$_REQUEST['P1mPhone1']);
  $P1mPhone2       = str_replace("'","",$_REQUEST['P1mPhone2']);
  $P1mPhone3       = str_replace("'","",$_REQUEST['P1mPhone3']);
  $P1sPhoneType    = str_replace("'","",$_REQUEST['P1sPhoneType']);
  $P1sPhone1       = str_replace("'","",$_REQUEST['P1sPhone1']);
  $P1sPhone2       = str_replace("'","",$_REQUEST['P1sPhone2']);
  $P1sPhone3       = str_replace("'","",$_REQUEST['P1sPhone3']);
  $P1email         = strtolower(str_replace("'","",$_REQUEST['P1email']));
  $P2firstname     = ucwords(str_replace("'","",$_REQUEST['P2firstname']));
  $P2lastname      = ucwords(str_replace("'","",$_REQUEST['P2lastname']));
  $P2mPhoneType    = str_replace("'","",$_REQUEST['P2mPhoneType']);
  $P2mPhone1       = str_replace("'","",$_REQUEST['P2mPhone1']);
  $P2mPhone2       = str_replace("'","",$_REQUEST['P2mPhone2']);
  $P2mPhone3       = str_replace("'","",$_REQUEST['P2mPhone3']);
  $P2sPhoneType    = str_replace("'","",$_REQUEST['P2sPhoneType']);
  $P2sPhone1       = str_replace("'","",$_REQUEST['P2sPhone1']);
  $P2sPhone2       = str_replace("'","",$_REQUEST['P2sPhone2']);
  $P2sPhone3       = str_replace("'","",$_REQUEST['P2sPhone3']);
  $P2email         = strtolower(str_replace("'","",$_REQUEST['P2email']));
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
  $StakePhoto      = str_replace("'","",$_REQUEST['StakePhoto']);
  $Scontact        = str_replace("'","",$_REQUEST['Scontact']);
  $Shandbook       = str_replace("'","",$_REQUEST['Shandbook']);
  $Syouth          = str_replace("'","",$_REQUEST['Syouth']);
  $Ssafety         = str_replace("'","",$_REQUEST['Ssafety']);
  $Smentoring      = str_replace("'","",$_REQUEST['Smentoring']);
  
  $sql = "SELECT * FROM Users WHERE firstname='$Sfirstname' AND lastname='$Slastname' AND type='$type'";
  $result = $conn->query($sql);
  $fields = "alert('Please fill out all required fields');";
  if(empty($Sfirstname)||empty($Slastname)||empty($Saddress1)||empty($Scity)||empty($Sstate)||empty($Szip)||
  empty($SmPhoneType)||empty($SmPhone1)||empty($SmPhone2)||empty($SmPhone3)||
  empty($Semail)||empty($_REQUEST['SbirthdayY'])||empty($_REQUEST['SbirthdayM'])||empty($_REQUEST['SbirthdayD'])||empty($Sgender)||empty($Sethnicity)||empty($Stshirt)||
  empty($P1firstname)||empty($P1lastname)||empty($P1mPhoneType)||empty($P1mPhone1)||empty($P1mPhone2)||empty($P1mPhone3)||empty($P1email)||
  empty($Hdoctor)||empty($Haddress1)||empty($Hcity)||empty($Hstate)||empty($Hzip)||
  empty($Hphone1)||empty($Hphone2)||empty($Hphone3)||empty($Hhospital)
  ){
    $error = $fields;
  } elseif(($student == true) && (empty($Sschool)||empty($Syog))){
    $error = $fields;
  } elseif($StakePhoto != 'true' || $Scontact != 'true' || $Shandbook != 'true' || $Syouth != 'true' || $Ssafety != 'true'){
    $error = $fields;
  } elseif($mentor == true && $Smentoring != 'true'){
    $error = $fields;
  } elseif($Hallergies == 'true' && empty($HallergiesE)){
    $error = $fields;
  } elseif($Sschool == 'Other' && empty($Sschoolother)){
    $error = $fields;
  } elseif ($result->num_rows > 0){
    $error = "alert('$Type user already exists, please login or contact admin (help@team2342.org)');";
  } else {
    $form = false;
    $thx = true;
	
	if($Sschool == "Other") $Sschool = $Sschoolother;
	
	if($student == true){
	  $P1type = "parent";
	  $P2type = "parent";
	  $Stype = "student";
	} elseif($mentor == true) {
	  $P1type = "parent";
	  $Stype = "mentor";
	}
	
	$sql = "INSERT INTO Users (firstname, lastname, mPhoneType, mPhone1, mPhone2, mPhone3, sPhoneType, sPhone1, sPhone2, sPhone3, email, type) VALUES ('$P1firstname', '$P1lastname', '$P1mPhoneType', '$P1mPhone1', '$P1mPhone2', '$P1mPhone3', '$P1sPhoneType', '$P1sPhone1', '$P1sPhone2', '$P1sPhone3', '$P1email', '$P1type')";
	$conn->query($sql);
	$P1id = (string)$conn->insert_id;
	if($P2firstname != "" && $P2lastname != ""){
	  $sql = "INSERT INTO Users (firstname, lastname, mPhoneType, mPhone1, mPhone2, mPhone3, sPhoneType, sPhone1, sPhone2, sPhone3, email, type) VALUES ('$P2firstname', '$P2lastname', '$P2mPhoneType', '$P2mPhone1', '$P2mPhone2', '$P2mPhone3', '$P2sPhoneType', '$P2sPhone1', '$P2sPhone2', '$P2sPhone3', '$P2email', '$P2type')";
	  $conn->query($sql);
	  $P2id = (string)$conn->insert_id;
	}
	$sql = "INSERT INTO Users (firstname, lastname, address1, address2, city, state, zip, mPhoneType, mPhone1, mPhone2, mPhone3, sPhoneType, sPhone1, sPhone2, sPhone3, email, birthday, gender, ethnicity, school, YOG, tshirt, Hdoctor, Haddress1, Haddress2, Hcity, Hstate, Hzip, Hphone1, Hphone2, Hphone3, Hhospital, Hallergies, HallergiesE, parent1ID, parent2ID, type, parentApprovedDate) VALUES ('$Sfirstname', '$Slastname', '$Saddress1', '$Saddress2', '$Scity', '$Sstate', '$Szip', '$SmPhoneType', '$SmPhone1', '$SmPhone2', '$SmPhone3', '$SsPhoneType', '$SsPhone1', '$SsPhone2', '$SsPhone3', '$Semail', '$Sbirthday', '$Sgender', '$Sethnicity', '$Sschool', '$Syog', '$Stshirt', '$Hdoctor', '$Haddress1', '$Haddress2', '$Hcity', '$Hstate', '$Hzip', '$Hphone1', '$Hphone2', '$Hphone3', '$Hhospital', '$Hallergies', '$HallergiesE', '$P1id', '$P2id', '$Stype', '$today')";
	$conn->query($sql);
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/head.php"); ?>
<script type="text/javascript">
<!--
var letters = 'ABCÇDEFGHIJKLMNÑOPQRSTUVWXYZabcçdefghijklmnñopqrstuvwxyzàáÀÁéèÈÉíìÍÌïÏóòÓÒúùÚÙüÜ'
var numbers = '1234567890'
var signs = ',.:;@-\''
var dot = '.'
var dash = '-'
var space = ' '
var mathsigns = '+-=()*/'
var custom = '<>#$%&?¿'

function filter(e,allow) {
	 var k;
	 k=document.all?parseInt(e.keyCode): parseInt(e.which);
	 if (e.keyCode != 8){
     return (allow.indexOf(String.fromCharCode(k))!=-1);
	 }
}

// -->
</script>
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
<script type="text/javascript"><?php echo $error ?></script>
  </head>
  <body>
    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/noscript.php"); ?>
	<div>
	  <div>
	    <?php include($_SERVER["DOCUMENT_ROOT"]."/structure/heading.php"); ?>
		<div>
		  <?php if($thx == true): ?>
		  <p>Thank you for registering with Team Phoenix. Once your registration is confirmed, <?php if(($student == true) && (age($birthday) < 18)){echo "your parents will receive an email with a confirmation link.";}else{echo "you will receive a welcome email.";} ?></p>
		  <?php endif ?>
		  <?php if($form == true): ?>
		  <form id="registration-form" action="<?php echo '/register.php?t='.$type ?>" method="post">
		    <p class="right"><span>*</span> indicates Required</p>
		    <h2 class="sb"><?php echo $Type ?> Registration</h2>
			<p class="sb">Please read through the entire form to make sure you have all the necessary information before you begin.</p>
		    <h3 class="sb center">Membership Information</h3>
		    <p class="b sb"><?php echo $Type ?></p>
		    <p class="sb"><span>*</span>Name: <input style="text-transform:capitalize;" type="text" name="Sfirstname" placeholder="First" required onkeypress="return filter(event,letters+dash)" value="<?php echo $Sfirstname ?>"> <input style="text-transform:capitalize;" type="text" name="Slastname" placeholder="Last" required onkeypress="return filter(event,letters+dash)" value="<?php echo $Slastname ?>"></p>
		    <p class="sb"><span>*</span>Street Address 1: <input style="text-transform:capitalize;" type="text" size="40" name="Saddress1" required onkeypress="return filter(event,numbers+letters+dot+space)" value="<?php echo $Saddress1 ?>"></p>
			<p class="sb">Street Address 2: <input style="text-transform:capitalize;" type="text" size="40" name="Saddress2" onkeypress="return filter(event,numbers+letters+dot+space)" value="<?php echo $Saddress2 ?>"></p>
			<p class="sb">
			  <span>*</span>City: <input style="text-transform:capitalize;" type="text" name="Scity" required onkeypress="return filter(event,letters)" value="<?php echo $Scity ?>">
		      <span>*</span>State: <select name="Sstate" required><option></option><option value="CT" <?php if($Sstate=='CT'){echo 'selected';} ?>>Connecticut</option><option value="ME" <?php if($Sstate=='ME'){echo 'selected';} ?>>Maine</option><option value="MA" <?php if($Sstate=='MA'){echo 'selected';} ?>>Massachusetts</option><option value="NH" <?php if($Sstate=='NH'){echo 'selected';} ?>>New Hampshire</option><option value="RI" <?php if($Sstate=='RI'){echo 'selected';} ?>>Rhode Island</option><option value="VT" <?php if($Sstate=='VT'){echo 'selected';} ?>>Vermont</option></select>
		      <span>*</span>Zip: <input type="text" size="6" name="Szip" maxlength="5" required onkeypress="return filter(event,numbers)" value="<?php echo $Szip ?>">
			</p>
			<p class="sb"><span>*</span>Main Phone: <select name="SmPhoneType" required><option></option><option <?php if($SmPhoneType=='Mobile'){echo 'selected';} ?>>Mobile</option><option <?php if($SmPhoneType=='Home'){echo 'selected';} ?>>Home</option><option <?php if($SmPhoneType=='Work'){echo 'selected';} ?>>Work</option></select> (<input id="SmPhone1" type="text" style="width:2em" name="SmPhone1" maxlength="3" required onkeypress="return filter(event,numbers)" value="<?php echo $SmPhone1 ?>">) <input id="SmPhone2" type="text" style="width:2em" name="SmPhone2" maxlength="3" required onkeypress="return filter(event,numbers)" value="<?php echo $SmPhone2 ?>">-<input id="SmPhone3" type="text" style="width:3em" name="SmPhone3" maxlength="4" required onkeypress="return filter(event,numbers)" value="<?php echo $SmPhone3 ?>"></p>
			<p class="sb">Secondary Phone: <select name="SsPhoneType"><option></option><option <?php if($SsPhoneType=='Mobile'){echo 'selected';} ?>>Mobile</option><option <?php if($SsPhoneType=='Home'){echo 'selected';} ?>>Home</option><option <?php if($SsPhoneType=='Work'){echo 'selected';} ?>>Work</option></select> (<input id="SsPhone1" type="text" style="width:2em" name="SsPhone1" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $SsPhone1 ?>">) <input id="SsPhone2" type="text" style="width:2em" name="SsPhone2" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $SsPhone2 ?>">-<input id="SsPhone3" type="text" style="width:3em" name="SsPhone3" maxlength="4" onkeypress="return filter(event,numbers)" value="<?php echo $SsPhone3 ?>"></p>
			<p class="sb"><span>*</span>Email: <input type="email" size="40" name="Semail" required value="<?php echo $Semail ?>"></p>
			<p class="sb"><span>*</span>Birthday<small style="color:gray">(MM/DD/YYYY)</small>: <input type="text" name="SbirthdayM" style="width:1.5em" maxlength="2" required onkeypress="return filter(event,numbers)" value="<?php echo $_REQUEST['SbirthdayM'] ?>">/<input type="text" name="SbirthdayD" style="width:1.5em" maxlength="2" required onkeypress="return filter(event,numbers)" value="<?php echo $_REQUEST['SbirthdayD'] ?>">/<input type="text" name="SbirthdayY" style="width:2.5em" maxlength="4" required onkeypress="return filter(event,numbers)" value="<?php echo $_REQUEST['SbirthdayY'] ?>"></p>
			<p class="sb"><span>*</span>Gender: <select name="Sgender" required><option></option><option <?php if($Sgender=='Male'){echo 'selected';} ?>>Male</option><option <?php if($Sgender=='Female'){echo 'selected';} ?>>Female</option><option <?php if($Sgender=='Other'){echo 'selected';} ?>>Other</option></select></p>
			<p class="sb"><span>*</span>Ethnicity: <select name="Sethnicity" required><option></option><option <?php if($Sethnicity=='African American/Black'){echo 'selected';} ?>>African American/Black</option><option <?php if($Sethnicity=='American Indian/Alaskan Native'){echo 'selected';} ?>>American Indian/Alaskan Native</option><option <?php if($Sethnicity=='Asian/Pacific Islander'){echo 'selected';} ?>>Asian/Pacific Islander</option><option <?php if($Sethnicity=='Caucasian/White'){echo 'selected';} ?>>Caucasian/White</option><option <?php if($Sethnicity=='Latino/Latina/Hispanic'){echo 'selected';} ?>>Latino/Latina/Hispanic</option><option <?php if($Sethnicity=='Other'){echo 'selected';} ?>>Other</option></select></p>
			<?php if($student == true): ?><p class="sb">
			  <span>*</span>School: 
			    <select name="Sschool" required onchange="CheckSchool(this.value)">
				  <option></option>
				  <option <?php if($Sschool=='Academy for Science and Design') echo 'selected' ?>>Academy for Science and Design</option>
				  <option <?php if($Sschool=='Alvirne High School') echo 'selected' ?>>Alvirne High School</option>
				  <option <?php if($Sschool=='Campbell High School') echo 'selected' ?>>Campbell High School</option>
				  <option <?php if($Sschool=='Chelmsford High School') echo 'selected' ?>>Chelmsford High School</option>
				  <option <?php if($Sschool=='Concord Christian Academy') echo 'selected' ?>>Concord Christian Academy</option>
				  <option <?php if($Sschool=='Groton Dunstable Regional High School') echo 'selected' ?>>Groton Dunstable Regional High School</option>
				  <option <?php if($Sschool=='Hollis Brookline High School') echo 'selected' ?>>Hollis Brookline High School</option>
				  <option <?php if($Sschool=='Home School') echo 'selected' ?>>Home School</option>
				  <option <?php if($Sschool=='Lowell High School') echo 'selected' ?>>Lowell High School</option>
				  <option <?php if($Sschool=='Merrimack High School') echo 'selected' ?>>Merrimack High School</option>
				  <option <?php if($Sschool=='Milford High School') echo 'selected' ?>>Milford High School</option>
				  <option <?php if($Sschool=='Nashua High School North') echo 'selected' ?>>Nashua High School North</option>
				  <option <?php if($Sschool=='Nashua High School South') echo 'selected' ?>>Nashua High School South</option>
				  <option <?php if($Sschool=='Next Charter School') echo 'selected' ?>>Next Charter School</option>
				  <option <?php if($Sschool=='Souhegan High School') echo 'selected' ?>>Souhegan High School</option>
				  <option <?php if($Sschool=='Westford Academy') echo 'selected' ?>>Westford Academy</option>
				  <option <?php if($Sschool=='Other') echo 'selected' ?>>Other</option>
				</select>
			  <input type="text" size="30" name="Sschoolother" id="school" style="<?php if($Sschool=='Other'){}else{echo 'visibility:hidden';} ?>" placeholder="Other School" value="<?php echo $Sschoolother ?>">
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
			<p class="sb"><span>*</span>Year of Graduation: 
			  <select name="Syog" required>
			    <option></option>
				<option <?php if($Syog==$twelfth) echo 'selected' ?>><?php echo $twelfth ?></option>
				<option <?php if($Syog==$eleventh) echo 'selected' ?>><?php echo $eleventh ?></option>
				<option <?php if($Syog==$tenth) echo 'selected' ?>><?php echo $tenth ?></option>
				<option <?php if($Syog==$ninth) echo 'selected' ?>><?php echo $ninth ?></option>
				<option <?php if($Syog==$eighth) echo 'selected' ?>><?php echo $eighth ?></option>
			  </select>
			</p>
			<?php endif ?>
			<p class="sb"><span>*</span>T-Shirt Size: <select name="Stshirt" required><option></option><option value="S" <?php if($Stshirt=='S'){echo 'selected';} ?>>S</option><option value="M" <?php if($Stshirt=='M'){echo 'selected';} ?>>M</option><option value="L" <?php if($Stshirt=='L'){echo 'selected';} ?>>L</option><option value="XL" <?php if($Stshirt=='XL'){echo 'selected';} ?>>XL</option><option value="XXL" <?php if($Stshirt=='XXL'){echo 'selected';} ?>>XXL</option><option value="XXXL" <?php if($Stshirt=='XXXL'){echo 'selected';} ?>>XXXL</option></select></p>
			<p class="b sb"><?php if($student == true){echo "Parent(s)/Guardian";}elseif($mentor == true){echo "Emergency Contact";}?></p>
		    <p class="sb"><span>*</span>Name: <input style="text-transform:capitalize;" type="text" name="P1firstname" placeholder="First" required onkeypress="return filter(event,letters+dash)" value="<?php echo $P1firstname ?>"> <input style="text-transform:capitalize;" type="text" name="P1lastname" placeholder="Last" required onkeypress="return filter(event,letters+dash)" value="<?php echo $P1lastname ?>"></p>
			<p class="sb"><span>*</span>Main Phone: <select name="P1mPhoneType" required><option></option><option <?php if($P1mPhoneType=='Mobile'){echo 'selected';} ?>>Mobile</option><option <?php if($P1mPhoneType=='Home'){echo 'selected';} ?>>Home</option><option <?php if($P1mPhoneType=='Work'){echo 'selected';} ?>>Work</option></select> (<input id="P1mPhone1" type="text" style="width:2em" name="P1mPhone1" maxlength="3" required onkeypress="return filter(event,numbers)" value="<?php echo $P1mPhone1 ?>">) <input id="P1mPhone2" type="text" style="width:2em" name="P1mPhone2" maxlength="3" required onkeypress="return filter(event,numbers)" value="<?php echo $P1mPhone2 ?>">-<input id="P1mPhone3" type="text" style="width:3em" name="P1mPhone3" maxlength="4" required onkeypress="return filter(event,numbers)" value="<?php echo $P1mPhone3 ?>"></p>
			<p class="sb">Secondary Phone: <select name="P1sPhoneType"><option></option><option <?php if($P1sPhoneType=='Mobile'){echo 'selected';} ?>>Mobile</option><option <?php if($P1sPhoneType=='Home'){echo 'selected';} ?>>Home</option><option <?php if($P1sPhoneType=='Work'){echo 'selected';} ?>>Work</option></select> (<input id="P1sPhone1" type="text" style="width:2em" name="P1sPhone1" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $P1sPhone1 ?>">) <input id="P1sPhone2" type="text" style="width:2em" name="P1sPhone2" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $P1sPhone2 ?>">-<input id="P1sPhone3" type="text" style="width:3em" name="P1sPhone3" maxlength="4" onkeypress="return filter(event,numbers)" value="<?php echo $P1sPhone3 ?>"></p>
			<p class="sb"><span>*</span>Email: <input type="email" size="40" name="P1email" required value="<?php echo $P1email ?>"></p>
			<?php if($student == true): ?><p>&nbsp;</p>
		    <p class="sb">Name: <input style="text-transform:capitalize;" type="text" name="P2firstname" placeholder="First" onkeypress="return filter(event,letters+dash)" value="<?php echo $P2firstname ?>"> <input style="text-transform:capitalize;" type="text" name="P2lastname" placeholder="Last" onkeypress="return filter(event,letters+dash)" value="<?php echo $P2firstname ?>"></p>
			<p class="sb">Main Phone: <select name="P2mPhoneType"><option></option><option <?php if($P2mPhoneType=='Mobile'){echo 'selected';} ?>>Mobile</option><option <?php if($P2mPhoneType=='Home'){echo 'selected';} ?>>Home</option><option <?php if($P2mPhoneType=='Work'){echo 'selected';} ?>>Work</option></select> (<input id="P2mPhone1" type="text" style="width:2em" name="P2mPhone1" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $P2mPhone1 ?>">) <input id="P2mPhone2" type="text" style="width:2em" name="P2mPhone2" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $P2mPhone2 ?>">-<input id="P2mPhone3" type="text" style="width:3em" name="P2mPhone3" maxlength="4" onkeypress="return filter(event,numbers)" value="<?php echo $P2mPhone3 ?>"></p>
			<p class="sb">Secondary Phone: <select name="P2sPhoneType"><option></option><option <?php if($P2sPhoneType=='Mobile'){echo 'selected';} ?>>Mobile</option><option <?php if($P2sPhoneType=='Home'){echo 'selected';} ?>>Home</option><option <?php if($P2sPhoneType=='Work'){echo 'selected';} ?>>Work</option></select> (<input id="P2sPhone1" type="text" style="width:2em" name="P2sPhone1" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $P2sPhone1 ?>">) <input id="P2sPhone2" type="text" style="width:2em" name="P2sPhone2" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $P2sPhone2 ?>">-<input id="P2sPhone3" type="text" style="width:3em" name="P2sPhone3" maxlength="4" onkeypress="return filter(event,numbers)" value="<?php echo $P2sPhone3 ?>"></p>
			<p class="sb">Email: <input type="email" size="40" name="P2email" value="<?php echo $P2email ?>"></p><?php endif ?>
		    <h3 class="center"><?php echo $Type ?> Health Information</h3>
			<p class="sb center">The following information will be held confidential by the team Safety Captain and used in the event of an emergency.</p>
			<p class="b sb">Doctor</p>
			<p class="sb"><span>*</span>Name: <input type="text" name="Hdoctor" required value="<?php echo $Hdoctor ?>"></p>
			<p class="sb"><span>*</span>Street Address 1: <input style="text-transform:capitalize;" type="text" size="40" name="Haddress1" required onkeypress="return filter(event,numbers+letters+dot+space)" value="<?php echo $Haddress1 ?>"></p>
			<p class="sb">Street Address 2: <input style="text-transform:capitalize;" type="text" size="40" name="Haddress2" onkeypress="return filter(event,numbers+letters+dot+space)" value="<?php echo $Haddress2 ?>"></p>
			<p class="sb">
			  <span>*</span>City: <input style="text-transform:capitalize;" type="text" name="Hcity" required onkeypress="return filter(event,letters)" value="<?php echo $Hcity ?>">
		      <span>*</span>State: <select name="Hstate" required><option></option><option value="CT" <?php if($Hstate=='CT'){echo 'selected';} ?>>Connecticut</option><option value="ME" <?php if($Hstate=='ME'){echo 'selected';} ?>>Maine</option><option value="MA" <?php if($Hstate=='MA'){echo 'selected';} ?>>Massachusetts</option><option value="NH" <?php if($Hstate=='NH'){echo 'selected';} ?>>New Hampshire</option><option value="RI" <?php if($Hstate=='RI'){echo 'selected';} ?>>Rhode Island</option><option value="VT" <?php if($Hstate=='VT'){echo 'selected';} ?>>Vermont</option></select>
		      <span>*</span>Zip: <input type="text" size="6" name="Hzip" maxlength="5" required onkeypress="return filter(event,numbers)" value="<?php echo $Hzip ?>">
			</p>
			<p class="sb"><span>*</span>Phone: (<input id="Hphone1" type="text" style="width:2em" name="Hphone1" maxlength="3" required onkeypress="return filter(event,numbers)" value="<?php echo $Hphone1 ?>">) <input id="Hphone2" type="text" style="width:2em" name="Hphone2" maxlength="3" required onkeypress="return filter(event,numbers)" value="<?php echo $Hphone2 ?>">-<input id="Hphone3" type="text" style="width:3em" name="Hphone3" maxlength="4" required onkeypress="return filter(event,numbers)" value="<?php echo $Hphone3 ?>"></p>
			<p>&nbsp;</p>
			<p class="sb"><span>*</span>Preferred Hospital: <input type="text" size="40" name="Hhospital" required value="<?php echo $Hhospital ?>"></p>
			<p class="sb"><input type="checkbox" name="Hallergies" value="true" onclick="showMe('HallergiesE', this)" <?php if($Hallergies==true){echo 'checked';$Hshow=true;} ?>> I have Allergies / medical conditions</p>
			<span id="HallergiesE" style="<?php if($Hshow==true){}else{echo 'display:none;';} ?>color:black;">
			  <p><span>*</span>Please explain:</p>
			  <textarea name="HallergiesE"><?php echo $HallergiesE ?></textarea>
			</span>
			<h3 class="sb center">Agreement</h3>
			<p class="sb"><span>*</span><input type="checkbox" name="StakePhoto" value="true" required> I agree to my photo being taken at any team activity/event and used for team publicity purposes by mail, email, newsletter or website.</p>
			<p class="sb"><span>*</span><input type="checkbox" name="Scontact" value="true" required> I agree to my personal contact information being shared with other team members and parents.</p>
			<p class="sb"><span>*</span><input type="checkbox" name="Shandbook" value="true" required> I have read and agree to the <a href="/files/TeamHandbook-RevF.pdf" target="_blank">Team Handbook</a>.</p>
			<p class="sb"><span>*</span><input type="checkbox" name="Syouth" value="true" required> I have read the <a href="http://www.firstinspires.org/resource-library/youth-protection-policy" target="_blank">FIRST Youth Protection Program Guide</a>.</p>
			<p class="sb"><span>*</span><input type="checkbox" name="Ssafety" value="true" required> I have read the <a href="http://www.firstinspires.org/resource-library/frc/safety-manual" target="_blank">FIRST Safety Manual</a>.</p>
			<?php if($mentor == true): ?><p class="sb"><span>*</span><input type="checkbox" name="Smentoring" value="true" required> I have read the <a href="http://archive.firstinspires.org/uploadedFiles/Community/FRC/Team_Resources/Mentoring%20Guide.pdf" target="_blank">FIRST Mentoring Guide</a>.</p><?php endif ?>
			<input type="submit" value="Register"<?php if($mentor == true) echo " class='sb'" ?>>
			<?php if($mentor == true): ?><p>Clicking the <i>Register</i> button above constitutes my online signing of this agreement.</p><?php endif ?>
		  </form>
		  <?php endif ?>
		</div>
	  </div>
	</div>
  </body>
</html>