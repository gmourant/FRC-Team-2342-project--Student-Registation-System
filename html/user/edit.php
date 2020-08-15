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
}
}

$sql = "SELECT * FROM Users WHERE ID='$P1id'";
$result = $conn->query($sql);
if ($result->num_rows > 0){while($row = $result->fetch_assoc()){$P1firstname = $row['firstname'];$P1lastname = $row['lastname'];$P1mPhoneType = $row['mPhoneType'];$P1mPhone1 = $row['mPhone1'];$P1mPhone2 = $row['mPhone2'];$P1mPhone3 = $row['mPhone3'];$P1sPhoneType = $row['sPhoneType'];$P1sPhone1 = $row['sPhone1'];$P1sPhone2 = $row['sPhone2'];$P1sPhone3 = $row['sPhone3'];$P1email = $row['email'];}}

$sql = "SELECT * FROM Users WHERE ID='$P2id'";
$result = $conn->query($sql);
if ($result->num_rows > 0){while($row = $result->fetch_assoc()){$P2firstname = $row['firstname'];$P2lastname = $row['lastname'];$P2mPhoneType = $row['mPhoneType'];$P2mPhone1 = $row['mPhone1'];$P2mPhone2 = $row['mPhone2'];$P2mPhone3 = $row['mPhone3'];$P2sPhoneType = $row['sPhoneType'];$P2sPhone1 = $row['sPhone1'];$P2sPhone2 = $row['sPhone2'];$P2sPhone3 = $row['sPhone3'];$P2email = $row['email'];}}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
WHERE ID='$id'";
$conn->query($sql);
  
  $form = false;
  $thx = true;
  
  header("Location: /user/view.php");
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
		  <form id="registration-form" action="/user/edit.php" method="post">
		    <a id="login" href="/user/logout.php">Logout</a>
			<span id="menu"><a href="/user/view.php">View</a> <a style="background-color:white;color:#750909;">Edit</a></span><p class="sb">&nbsp;</p><p class="sb">&nbsp;</p>
		    <h3 class="sb center">Membership Information</h3>
			<p class="right"><span>*</span> indicates Required</p>
		    <p class="b sb">Student</p>
		    <p class="sb"><span>*</span>Name: <input type="text" disabled readonly value="<?php echo $Sfirstname ?>"> <input type="text" disabled readonly value="<?php echo $Slastname ?>"></p>
		    <p class="sb"><span>*</span>Street Address 1: <input style="text-transform:capitalize;" type="text" size="40" name="Saddress1" required onkeypress="return filter(event,numbers+letters+dot+space)" value="<?php echo $Saddress1 ?>"></p>
			<p class="sb">Street Address 2: <input style="text-transform:capitalize;" type="text" size="40" name="Saddress2" onkeypress="return filter(event,numbers+letters+dot+space)" value="<?php echo $Saddress2 ?>"></p>
			<p class="sb"><span>*</span>City: <input style="text-transform:capitalize;" type="text" name="Scity" required onkeypress="return filter(event,letters)" value="<?php echo $Scity ?>"></p>
			<p class="sb"><span>*</span>State: <select name="Sstate" required><option></option><option value="CT" <?php if($Sstate=='CT'){echo 'selected';} ?>>Connecticut</option><option value="ME" <?php if($Sstate=='ME'){echo 'selected';} ?>>Maine</option><option value="MA" <?php if($Sstate=='MA'){echo 'selected';} ?>>Massachusetts</option><option value="NH" <?php if($Sstate=='NH'){echo 'selected';} ?>>New Hampshire</option><option value="RI" <?php if($Sstate=='RI'){echo 'selected';} ?>>Rhode Island</option><option value="VT" <?php if($Sstate=='VT'){echo 'selected';} ?>>Vermont</option></select></p>
			<p class="sb"><span>*</span>Zip: <input type="text" size="6" name="Szip" maxlength="5" required onkeypress="return filter(event,numbers)" value="<?php echo $Szip ?>"></p>
			<p class="sb"><span>*</span>Main Phone: <select name="SmPhoneType" required><option></option><option <?php if($SmPhoneType=='Mobile'){echo 'selected';} ?>>Mobile</option><option <?php if($SmPhoneType=='Home'){echo 'selected';} ?>>Home</option><option <?php if($SmPhoneType=='Work'){echo 'selected';} ?>>Work</option></select> (<input id="SmPhone1" type="text" style="width:2em" name="SmPhone1" maxlength="3" required onkeypress="return filter(event,numbers)" value="<?php echo $SmPhone1 ?>">) <input id="SmPhone2" type="text" style="width:2em" name="SmPhone2" maxlength="3" required onkeypress="return filter(event,numbers)" value="<?php echo $SmPhone2 ?>">-<input id="SmPhone3" type="text" style="width:3em" name="SmPhone3" maxlength="4" required onkeypress="return filter(event,numbers)" value="<?php echo $SmPhone3 ?>"></p>
			<p class="sb">Secondary Phone: <select name="SsPhoneType"><option></option><option <?php if($SsPhoneType=='Mobile'){echo 'selected';} ?>>Mobile</option><option <?php if($SsPhoneType=='Home'){echo 'selected';} ?>>Home</option><option <?php if($SsPhoneType=='Work'){echo 'selected';} ?>>Work</option></select> (<input id="SsPhone1" type="text" style="width:2em" name="SsPhone1" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $SsPhone1 ?>">) <input id="SsPhone2" type="text" style="width:2em" name="SsPhone2" maxlength="3" onkeypress="return filter(event,numbers)" value="<?php echo $SsPhone2 ?>">-<input id="SsPhone3" type="text" style="width:3em" name="SsPhone3" maxlength="4" onkeypress="return filter(event,numbers)" value="<?php echo $SsPhone3 ?>"></p>
			<p class="sb"><span>*</span>Email: <input type="email" size="40" name="Semail" required value="<?php echo $Semail ?>"><br><i style="color:gray">Please note: Changing your email here will not change your email on the team email list, please contact <a href="mailto:help@team2342.org?subject=Change of email for email list">help@team2342.org</a> to change your email on the team email list.</i></p>
			<p class="sb"><span>*</span>Birthday<small style="color:gray">(MM/DD/YYYY)</small>: <input type="text" name="SbirthdayM" style="width:1.5em" maxlength="2" required onkeypress="return filter(event,numbers)" value="<?php echo date('m',$Sbirthday) ?>">/<input type="text" name="SbirthdayD" style="width:1.5em" maxlength="2" required onkeypress="return filter(event,numbers)" value="<?php echo date('d',$Sbirthday) ?>">/<input type="text" name="SbirthdayY" style="width:2.5em" maxlength="4" required onkeypress="return filter(event,numbers)" value="<?php echo date('Y',$Sbirthday) ?>"></p>
			<p class="sb"><span>*</span>Gender: <select name="Sgender" required><option></option><option <?php if($Sgender=='Male'){echo 'selected';} ?>>Male</option><option <?php if($Sgender=='Female'){echo 'selected';} ?>>Female</option><option <?php if($Sgender=='Other'){echo 'selected';} ?>>Other</option></select></p>
			<p class="sb"><span>*</span>Ethnicity: <select name="Sethnicity" required><option></option><option <?php if($Sethnicity=='African American/Black'){echo 'selected';} ?>>African American/Black</option><option <?php if($Sethnicity=='American Indian/Alaskan Native'){echo 'selected';} ?>>American Indian/Alaskan Native</option><option <?php if($Sethnicity=='Asian/Pacific Islander'){echo 'selected';} ?>>Asian/Pacific Islander</option><option <?php if($Sethnicity=='Caucasian/White'){echo 'selected';} ?>>Caucasian/White</option><option <?php if($Sethnicity=='Latino/Latina/Hispanic'){echo 'selected';} ?>>Latino/Latina/Hispanic</option><option <?php if($Sethnicity=='Other'){echo 'selected';} ?>>Other</option></select></p>
			<?php if($type == "student"): ?>
			<p class="sb">
			  <span>*</span>School: 
			    <select name="Sschool" required onchange="CheckSchool(this.value)">
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
			<?php endif; ?>
			<p class="sb"><span>*</span>T-Shirt Size: <select name="Stshirt" required><option></option><option value="S" <?php if($Stshirt=='S'){echo 'selected';} ?>>S</option><option value="M" <?php if($Stshirt=='M'){echo 'selected';} ?>>M</option><option value="L" <?php if($Stshirt=='L'){echo 'selected';} ?>>L</option><option value="XL" <?php if($Stshirt=='XL'){echo 'selected';} ?>>XL</option><option value="XXL" <?php if($Stshirt=='XXL'){echo 'selected';} ?>>XXL</option><option value="XXXL" <?php if($Stshirt=='XXXL'){echo 'selected';} ?>>XXXL</option></select></p>
			<p class="b sb">Please contact <a href="mailto:help@team2342.org?subject=Parent Conact Info Change">help@team2342.org</a> to change <?php if($type == "student"){echo "parent";}else{echo "emergency contact";} ?> information.</p>
		    <h3 class="center"><?php if($type == "student"){echo "Student";}else{echo "Mentor";} ?> Health Information</h3>
			<p class="sb center">The following information will be held confidential by the team Safety Captain and used in the event of an emergency.</p>
			<p class="b sb">Doctor</p>
			<p class="sb"><span>*</span>Name: <input type="text" name="Hdoctor" required value="<?php echo $Hdoctor ?>"></p>
			<p class="sb"><span>*</span>Street Address 1: <input style="text-transform:capitalize;" type="text" size="40" name="Haddress1" required onkeypress="return filter(event,numbers+letters+dot+space)" value="<?php echo $Haddress1 ?>"></p>
			<p class="sb">Street Address 2: <input style="text-transform:capitalize;" type="text" size="40" name="Haddress2" onkeypress="return filter(event,numbers+letters+dot+space)" value="<?php echo $Haddress2 ?>"></p>
			<p class="sb"><span>*</span>City: <input style="text-transform:capitalize;" type="text" name="Hcity" required onkeypress="return filter(event,letters)" value="<?php echo $Hcity ?>"></p>
			<p class="sb"><span>*</span>State: <select name="Hstate" required><option></option><option value="CT" <?php if($Hstate=='CT'){echo 'selected';} ?>>Connecticut</option><option value="ME" <?php if($Hstate=='ME'){echo 'selected';} ?>>Maine</option><option value="MA" <?php if($Hstate=='MA'){echo 'selected';} ?>>Massachusetts</option><option value="NH" <?php if($Hstate=='NH'){echo 'selected';} ?>>New Hampshire</option><option value="RI" <?php if($Hstate=='RI'){echo 'selected';} ?>>Rhode Island</option><option value="VT" <?php if($Hstate=='VT'){echo 'selected';} ?>>Vermont</option></select></p>
			<p class="sb"><span>*</span>Zip: <input type="text" size="6" name="Hzip" maxlength="5" required onkeypress="return filter(event,numbers)" value="<?php echo $Hzip ?>"></p>
			<p class="sb"><span>*</span>Phone: (<input id="Hphone1" type="text" style="width:2em" name="Hphone1" maxlength="3" required onkeypress="return filter(event,numbers)" value="<?php echo $Hphone1 ?>">) <input id="Hphone2" type="text" style="width:2em" name="Hphone2" maxlength="3" required onkeypress="return filter(event,numbers)" value="<?php echo $Hphone2 ?>">-<input id="Hphone3" type="text" style="width:3em" name="Hphone3" maxlength="4" required onkeypress="return filter(event,numbers)" value="<?php echo $Hphone3 ?>"></p>
			<p>&nbsp;</p>
			<p class="sb"><span>*</span>Preferred Hospital: <input type="text" size="40" name="Hhospital" required value="<?php echo $Hhospital ?>"></p>
			<p class="sb"><input type="checkbox" name="Hallergies" value="true" onclick="showMe('HallergiesE', this)" <?php if($Hallergies==true){echo 'checked';$Hshow=true;} ?>> I have Allergies / medical conditions</p>
			<span id="HallergiesE" style="<?php if($Hshow==true){}else{echo 'display:none;';} ?>color:black;">
			  <p><span>*</span>Please explain:</p>
			  <textarea name="HallergiesE"><?php echo $HallergiesE ?></textarea>
			</span>
			<p style="margin-top:12px"><input type="submit" value="Update"></p>
		  </form>
		</div>
	  </div>
	</div>
  </body>
</html>