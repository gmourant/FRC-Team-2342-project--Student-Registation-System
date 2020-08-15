<?php
include("/nfs/c06/h04/mnt/157266/domains/register.team2342.org/data/database_pwd.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function percent($number){
    $number = $number * 100;
	$number = round($number,2,PHP_ROUND_HALF_DOWN);
	return $number . '%';
}

$sql = "SELECT * FROM Users WHERE type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$s = (string)$result->num_rows;
$sql = "SELECT * FROM Users WHERE type='student' AND approved='1' AND parentApproved='1' AND gender='Female'";
$result = $conn->query($sql);
$sgf = (string)$result->num_rows;
$sgfP = percent($sgf/$s);
$sql = "SELECT * FROM Users WHERE type='student' AND approved='1' AND parentApproved='1' AND gender='Male'";
$result = $conn->query($sql);
$sgm = (string)$result->num_rows;
$sgmP = percent($sgm/$s);
$sql = "SELECT * FROM Users WHERE ethnicity='African American/Black' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$seaa = (string)$result->num_rows;
$seaaP = percent($seaa/$s);
$sql = "SELECT * FROM Users WHERE ethnicity='American Indian/Alaskan Native' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$seai = (string)$result->num_rows;
$seaiP = percent($seai/$s);
$sql = "SELECT * FROM Users WHERE ethnicity='Asian/Pacific Islander' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$seas = (string)$result->num_rows;
$seasP = percent($seas/$s);
$sql = "SELECT * FROM Users WHERE ethnicity='Caucasian/White' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$secw = (string)$result->num_rows;
$secwP = percent($secw/$s);
$sql = "SELECT * FROM Users WHERE ethnicity='Latino/Latina/Hispanic' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$sell = (string)$result->num_rows;
$sellP = percent($sell/$s);
$sql = "SELECT * FROM Users WHERE ethnicity='Other' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$seo = (string)$result->num_rows;
$seoP = percent($seo/$s);
$sql = "SELECT * FROM Users WHERE school='Academy for Science and Design' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$ssasd = (string)$result->num_rows;
$ssasdP = percent($ssasd/$s);
$sql = "SELECT * FROM Users WHERE school='Alvirne High School' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$ssahs = (string)$result->num_rows;
$ssahsP = percent($ssahs/$s);
$sql = "SELECT * FROM Users WHERE school='Campbell High School' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$sscbhs = (string)$result->num_rows;
$sscbhsP = percent($sscbhs/$s);
$sql = "SELECT * FROM Users WHERE school='Chelmsford High School' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$sscfhs = (string)$result->num_rows;
$sscfhsP = percent($sscfhs/$s);
$sql = "SELECT * FROM Users WHERE school='Concord Christian Academy' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$sscca = (string)$result->num_rows;
$ssccaP = percent($sscca/$s);
$sql = "SELECT * FROM Users WHERE school='Groton Dunstable Regional High School' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$ssgdr = (string)$result->num_rows;
$ssgdrP = percent($ssgdr/$s);
$sql = "SELECT * FROM Users WHERE school='Hollis Brookline High School' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$sshbh = (string)$result->num_rows;
$sshbhP = percent($sshbh/$s);
$sql = "SELECT * FROM Users WHERE school='Home School' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$sshs = (string)$result->num_rows;
$sshsP = percent($sshs/$s);
$sql = "SELECT * FROM Users WHERE school='Lowell High School' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$sslhs = (string)$result->num_rows;
$sslhsP = percent($sslhs/$s);
$sql = "SELECT * FROM Users WHERE school='Merrimack High School' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$ssmhs = (string)$result->num_rows;
$ssmhsP = percent($ssmhs/$s);
$sql = "SELECT * FROM Users WHERE school='Milford High School' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$ssmihs = (string)$result->num_rows;
$ssmihsP = percent($ssmihs/$s);
$sql = "SELECT * FROM Users WHERE school='Nashua High School North' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$ssnhsn = (string)$result->num_rows;
$ssnhsnP = percent($ssnhsn/$s);
$sql = "SELECT * FROM Users WHERE school='Nashua High School South' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$ssnhss = (string)$result->num_rows;
$ssnhssP = percent($ssnhss/$s);
$sql = "SELECT * FROM Users WHERE school='Next Charter School' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$ssncs = (string)$result->num_rows;
$ssncsP = percent($ssncs/$s);
$sql = "SELECT * FROM Users WHERE school='Souhegan High School' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$ssshs = (string)$result->num_rows;
$ssshsP = percent($ssshs/$s);
$sql = "SELECT * FROM Users WHERE school='Westford Academy' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$sswa = (string)$result->num_rows;
$sswaP = percent($sswa/$s);
$sso = $s - ($ssasd + $ssahs + $sscbhs + $sscfhs + $sscca + $ssgdr + $sshbh + $sshs + $sslhs + $ssmhs + $ssmihs + $ssnhsn + $ssnhss + $ssncs + $ssshs + $sswa);
$ssoP = percent($sso/$s);
date_default_timezone_set('America/New_York');
$year = date("Y",strtotime("+5 months"));
$twelfth = $year;
$eleven = $year + 1;
$tenth = $year + 2;
$ninth = $year + 3;
$eighth = $year + 4;
$sql = "SELECT * FROM Users WHERE YOG='$twelfth' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$twelfthN = (string)$result->num_rows;
$twelfthP = percent($twelfthN/$s);
$sql = "SELECT * FROM Users WHERE YOG='$eleven' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$elevenN = (string)$result->num_rows;
$elevenP = percent($elevenN/$s);
$sql = "SELECT * FROM Users WHERE YOG='$tenth' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$tenthN = (string)$result->num_rows;
$tenthP = percent($tenthN/$s);
$sql = "SELECT * FROM Users WHERE YOG='$ninth' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$ninthN = (string)$result->num_rows;
$ninthP = percent($ninthN/$s);
$sql = "SELECT * FROM Users WHERE YOG='$eighth' AND type='student' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$eighthN = (string)$result->num_rows;
$eighthP = percent($eighthN/$s);

$sql = "SELECT * FROM Users WHERE type='mentor' AND approved='1'";
$result = $conn->query($sql);
$m = (string)$result->num_rows;
$sql = "SELECT * FROM Users WHERE type='mentor' AND approved='1' AND gender='Female'";
$result = $conn->query($sql);
$mgf = (string)$result->num_rows;
$mgfP = percent($mgf/$m);
$sql = "SELECT * FROM Users WHERE type='mentor' AND approved='1' AND gender='Male'";
$result = $conn->query($sql);
$mgm = (string)$result->num_rows;
$mgmP = percent($mgm/$m);
$sql = "SELECT * FROM Users WHERE ethnicity='African American/Black' AND type='mentor' AND approved='1'";
$result = $conn->query($sql);
$meaa = (string)$result->num_rows;
$meaaP = percent($meaa/$m);
$sql = "SELECT * FROM Users WHERE ethnicity='American Indian/Alaskan Native' AND type='mentor' AND approved='1'";
$result = $conn->query($sql);
$meai = (string)$result->num_rows;
$meaiP = percent($meai/$m);
$sql = "SELECT * FROM Users WHERE ethnicity='Asian/Pacific Islander' AND type='mentor' AND approved='1'";
$result = $conn->query($sql);
$meas = (string)$result->num_rows;
$measP = percent($meas/$m);
$sql = "SELECT * FROM Users WHERE ethnicity='Caucasian/White' AND type='mentor' AND approved='1'";
$result = $conn->query($sql);
$mecw = (string)$result->num_rows;
$mecwP = percent($mecw/$m);
$sql = "SELECT * FROM Users WHERE ethnicity='Latino/Latina/Hispanic' AND type='mentor' AND approved='1'";
$result = $conn->query($sql);
$mell = (string)$result->num_rows;
$mellP = percent($mell/$m);
$sql = "SELECT * FROM Users WHERE ethnicity='Other' AND type='mentor' AND approved='1'";
$result = $conn->query($sql);
$meo = (string)$result->num_rows;
$meoP = percent($meo/$m);

$sql = "SELECT * FROM Users WHERE tshirt='S' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$ts = (string)$result->num_rows;
$sql = "SELECT * FROM Users WHERE tshirt='M' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$tm = (string)$result->num_rows;
$sql = "SELECT * FROM Users WHERE tshirt='L' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$tl = (string)$result->num_rows;
$sql = "SELECT * FROM Users WHERE tshirt='XL' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$txl = (string)$result->num_rows;
$sql = "SELECT * FROM Users WHERE tshirt='XXL' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$txxl = (string)$result->num_rows;
$sql = "SELECT * FROM Users WHERE tshirt='XXXL' AND approved='1' AND parentApproved='1'";
$result = $conn->query($sql);
$txxxl = (string)$result->num_rows;
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
		  <a id="login" href="javascript:history.go(-1)">Back</a>
		  <h2 class="sb">Team Statistics and Demographics</h2>
		  <table cellpadding="0" cellspacing="0" width="100%"><tr>
		    <td width="50%" style="vertical-align:top">
			  <h3 class="sb">Students (<?php echo $s ?>)</h3>
			  <b>Gender:</b>
			  <p>&nbsp;&nbsp;<?php echo $sgfP ?> Female (<?php echo $sgf ?>)</p>
			  <p class="sb">&nbsp;&nbsp;<?php echo $sgmP ?> Male (<?php echo $sgm ?>)</p>
			  <b>Ethnicity:</b>
			  <p>&nbsp;&nbsp;<?php echo $seaaP ?> African American/Black (<?php echo $seaa ?>)</p>
			  <p>&nbsp;&nbsp;<?php echo $seaiP ?> American Indian/Alaskan Native (<?php echo $seai ?>)</p>
			  <p>&nbsp;&nbsp;<?php echo $seasP ?> Asian/Pacific Islander (<?php echo $seas ?>)</p>
			  <p>&nbsp;&nbsp;<?php echo $secwP ?> Caucasian/White (<?php echo $secw ?>)</p>
			  <p>&nbsp;&nbsp;<?php echo $sellP ?> Latino/Latina/Hispanic (<?php echo $sell ?>)</p>
			  <p class="sb">&nbsp;&nbsp;<?php echo $seoP ?> Other (<?php echo $seo ?>)</p>
			  <b>School:</b>
			  <?php if($ssasd > 0): ?><p>&nbsp;&nbsp;<?php echo $ssasdP ?> Academy for Science and Design (<?php echo $ssasd ?>)</p><?php endif ?>
			  <?php if($ssahs > 0): ?><p>&nbsp;&nbsp;<?php echo $ssahsP ?> Alvirne High School (<?php echo $ssahs ?>)</p><?php endif ?>
			  <?php if($sscbhs > 0): ?><p>&nbsp;&nbsp;<?php echo $sscbhsP ?> Campbell High School (<?php echo $sscbhs ?>)</p><?php endif ?>
			  <?php if($sscfhs > 0): ?><p>&nbsp;&nbsp;<?php echo $sscfhsP ?> Chelmsford High School (<?php echo $sscfhs ?>)</p><?php endif ?>
			  <?php if($sscca > 0): ?><p>&nbsp;&nbsp;<?php echo $ssccaP ?> Concord Christian Academy (<?php echo $sscca ?>)</p><?php endif ?>
			  <?php if($ssgdr > 0): ?><p>&nbsp;&nbsp;<?php echo $ssgdrP ?> Groton Dunstable Regional High School (<?php echo $ssgdr ?>)</p><?php endif ?>
			  <?php if($sshbh > 0): ?><p>&nbsp;&nbsp;<?php echo $sshbhP ?> Hollis Brookline High School (<?php echo $sshbh ?>)</p><?php endif ?>
			  <?php if($sshs > 0): ?><p>&nbsp;&nbsp;<?php echo $sshsP ?> Home School (<?php echo $sshs ?>)</p><?php endif ?>
			  <?php if($sslhs > 0): ?><p>&nbsp;&nbsp;<?php echo $sslhsP ?> Lowell High School (<?php echo $sslhs ?>)</p><?php endif ?>
			  <?php if($ssmhs > 0): ?><p>&nbsp;&nbsp;<?php echo $ssmhsP ?> Merrimack High School (<?php echo $ssmhs ?>)</p><?php endif ?>
			  <?php if($ssmihs > 0): ?><p>&nbsp;&nbsp;<?php echo $ssmihsP ?> Milford High School (<?php echo $ssmihs ?>)</p><?php endif ?>
			  <?php if($ssnhsn > 0): ?><p>&nbsp;&nbsp;<?php echo $ssnhsnP ?> Nashua High School North (<?php echo $ssnhsn ?>)</p><?php endif ?>
			  <?php if($ssnhss > 0): ?><p>&nbsp;&nbsp;<?php echo $ssnhssP ?> Nashua High School South (<?php echo $ssnhss ?>)</p><?php endif ?>
			  <?php if($ssncs > 0): ?><p>&nbsp;&nbsp;<?php echo $ssncsP ?> Next Charter School (<?php echo $ssncs ?>)</p><?php endif ?>
			  <?php if($ssshs > 0): ?><p>&nbsp;&nbsp;<?php echo $ssshsP ?> Souhegan High School (<?php echo $ssshs ?>)</p><?php endif ?>
			  <?php if($sswa > 0): ?><p>&nbsp;&nbsp;<?php echo $sswaP ?> Westford Academy (<?php echo $sswa ?>)</p><?php endif ?>
			  <p class="sb">&nbsp;&nbsp;<?php echo $ssoP ?> Other (<?php echo $sso ?>)</p>
			  <b>Year of Graduation:</b>
			  <p>&nbsp;&nbsp;<?php echo $twelfthP ?> (<?php echo $twelfthN ?>) Seniors - <?php echo $twelfth ?></p>
			  <p>&nbsp;&nbsp;<?php echo $elevenP ?> (<?php echo $elevenN ?>) Juniors - <?php echo $eleven ?></p>
			  <p>&nbsp;&nbsp;<?php echo $tenthP ?> (<?php echo $tenthN ?>) Sophomores - <?php echo $tenth ?></p>
			  <p>&nbsp;&nbsp;<?php echo $ninthP ?> (<?php echo $ninthN ?>) Freshmen - <?php echo $ninth ?></p>
			  <p class="sb">&nbsp;&nbsp;<?php echo $eighthP ?> (<?php echo $eighthN ?>) Eighth Graders - <?php echo $eighth ?></p>
		    </td>
		    <td width="50%" style="vertical-align:top">
			  <h3 class="sb">Mentors (<?php echo $m ?>)</h3>
			  <b>Gender:</b>
			  <p>&nbsp;&nbsp;<?php echo $mgfP ?> Female (<?php echo $mgf ?>)</p>
			  <p class="sb">&nbsp;&nbsp;<?php echo $mgmP ?> Male (<?php echo $mgm ?>)</p>
			  <b>Ethnicity:</b>
			  <p>&nbsp;&nbsp;<?php echo $meaaP ?> African American/Black (<?php echo $meaa ?>)</p>
			  <p>&nbsp;&nbsp;<?php echo $meaiP ?> American Indian/Alaskan Native (<?php echo $meai ?>)</p>
			  <p>&nbsp;&nbsp;<?php echo $measP ?> Asian/Pacific Islander (<?php echo $meas ?>)</p>
			  <p>&nbsp;&nbsp;<?php echo $mecwP ?> Caucasian/White (<?php echo $mecw ?>)</p>
			  <p>&nbsp;&nbsp;<?php echo $mellP ?> Latino/Latina/Hispanic (<?php echo $mell ?>)</p>
			  <p class="sb">&nbsp;&nbsp;<?php echo $meoP ?> Other (<?php echo $meo ?>)</p>
		    </td>
		  </tr></table>
		  <h3 class="center sb">Everyone</h3>
		  <b>T-Shirt Sizes:</b>
		  <p>&nbsp;&nbsp;<?php echo $ts ?> Small</p>
		  <p>&nbsp;&nbsp;<?php echo $tm ?> Medium</p>
		  <p>&nbsp;&nbsp;<?php echo $tl ?> Large</p>
		  <p>&nbsp;&nbsp;<?php echo $txl ?> Extra Large</p>
		  <p>&nbsp;&nbsp;<?php echo $txxl ?> Extra Extra Large</p>
		  <p>&nbsp;&nbsp;<?php echo $txxxl ?> Extra Extra Extra Large</p>
		</div>
	  </div>
	</div>
  </body>
</html>