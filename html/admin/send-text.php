<?php
session_start();
if (isset($_SESSION['admin_LAST_ACTIVITY']) && (time() - $_SESSION['admin_LAST_ACTIVITY'] > 1800)) {
    unset($_SESSION['admin_login']);
}
$_SESSION['admin_LAST_ACTIVITY'] = time();

if(isset($_SESSION['admin_login']) == false){
  header('Location: /admin/login.php');
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$groups = explode(",", $_REQUEST['groups']);
	$textmessage = $_REQUEST['textmessage'];
} else {
	die();
}

include("/nfs/c06/h04/mnt/157266/domains/register.team2342.org/data/database_pwd.php");
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$numbers = array();
function collect_numbers($result){
	while($row = $result->fetch_assoc()){
		if($row["mPhoneType"] == "Mobile"){
			array_push($numbers, $row["mPhone1"].$row["mPhone2"].$row["mPhone3"]);
		}
		elseif($row["sPhoneType"] == "Mobile"){
			array_push($numbers, $row["sPhone1"].$row["sPhone2"].$row["sPhone3"]);
		}
	}
}

foreach ($groups as $group){
	switch ($group){
		case "s":
			$sql = "SELECT * FROM Users WHERE type='student' AND approved='1' AND parentApproved='1'";
			collect_numbers($conn->query($sql));
			break;
		case "m":
			$sql = "SELECT * FROM Users WHERE type='mentor' AND approved='1'";
			collect_numbers($conn->query($sql));
			break;
		case "p":
			$parents = "ID='0'";
			$sql = "SELECT * FROM Users WHERE type='student' AND approved='1' AND parentApproved='1'";
			$result = $conn->query($sql);
			while($row = $result->fetch_assoc()){
				$parents .= " OR ID='".$row["parent1ID"]."'";
				if($row["parent2ID"] != '0') $parents .= " OR ID='".$row["parent2ID"]."'";
			}
			$sql = "SELECT * FROM Users WHERE ($parents)";
			collect_numbers($conn->query($sql));
			break;
	}
}


/*

$sql = "SELECT * FROM Users WHERE ID='60' OR ID='303'";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
	if($row["mPhoneType"] == "Mobile"){
		array_push($numbers, $row["mPhone1"].$row["mPhone2"].$row["mPhone3"]);
	}
	elseif($row["sPhoneType"] == "Mobile"){
		array_push($numbers, $row["sPhone1"].$row["sPhone2"].$row["sPhone3"]);
	}
}
*/
 
$data = array(
  'User'          => 'team2342',
  'Password'      => 'q7kAKRjzPTmy',
  'PhoneNumbers'  => $numbers,
  'Groups'        => array(),
  'Subject'       => '',
  'Message'       => $textmessage,
  'StampToSend'   => '1305582245',
  'MessageTypeID' => 1
  );
 
$curl = curl_init('https://app.eztexting.com/sending/messages?format=json');
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  // If you experience SSL issues, perhaps due to an outdated SSL cert
  // on your own server, try uncommenting the line below
  // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($curl);
curl_close($curl);
 
$json = json_decode($response);
$json = $json->Response;
 
if ( 'Failure' == $json->Status ) {
  $errors = array();
  if ( !empty($json->Errors) ) {
    $errors = $json->Errors;
  }
 
  echo 'Status: ' . $json->Status . "\n" .
  'Errors: ' . implode(', ' , $errors) . "\n";
} else {
  $phoneNumbers = array();
  if ( !empty($json->Entry->PhoneNumbers) ) {
    $phoneNumbers = $json->Entry->PhoneNumbers;
  }
 
  $localOptOuts = array();
  if ( !empty($json->Entry->LocalOptOuts) ) {
    $localOptOuts = $json->Entry->LocalOptOuts;
  }
 
  $globalOptOuts = array();
  if ( !empty($json->Entry->GlobalOptOuts) ) {
    $globalOptOuts = $json->Entry->GlobalOptOuts;
  }
 
  $groups = array();
  if ( !empty($json->Entry->Groups) ) {
    $groups = $json->Entry->Groups;
  }
 
  echo 'Status: ' . $json->Status . "\n" .
  'Message ID : ' . $json->Entry->ID . "\n" .
  'Subject: ' . $json->Entry->Subject . "\n" .
  'Message: ' . $json->Entry->Message . "\n" .
  'Message Type ID: ' . $json->Entry->MessageTypeID . "\n" .
  'Total Recipients: ' . $json->Entry->RecipientsCount . "\n" .
  'Credits Charged: ' . $json->Entry->Credits . "\n" .
  'Time To Send: ' . $json->Entry->StampToSend . "\n" .
  'Phone Numbers: ' . implode(', ' , $phoneNumbers) . "\n" .
  'Groups: ' . implode(', ' , $groups) . "\n" .
  'Locally Opted Out Numbers: ' . implode(', ' , $localOptOuts) . "\n" .
  'Globally Opted Out Numbers: ' . implode(', ' , $globalOptOuts) . "\n";
}

header("Location: /admin/");
 
?>