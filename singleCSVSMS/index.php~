<?php
session_start();
header("Content-Type: text/xml");
require_once "../includes/trunk_config.php";
$conn =@mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
	@mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
if($_GET['sessionID'] == "TEST"){
	if(!empty($_GET['phone']) && !empty($_GET['mesg']) && !empty($_GET['from'])){
	$phoneNumber = $_GET['phone'];
	$mesg = $_GET['mesg'];
	$fromName = $_GET['from'];
	
	$sql = "INSERT INTO sent (`id`, `org`, `toNum`, `fromNa`, `date`, `sent`) VALUES (NULL, 'TESTNAME', '$phoneNumber', '$fromName', NOW(), '1')";
	$result = @mysql_query($sql);
		if($result){ //this section represent clickAtel
		echo "<TrunkSMS>";
		echo "<SMSResult>";
		echo "<message>";
		echo "Succeeded";
		echo "</message>";
		echo "</SMSResult>";
		echo "</TrunkSMS>";
		}else{
		echo "<TrunkSMS>";
		echo "<SMSResult>";
		echo "<message>";
		echo "Failed";
		echo "</message>";
		echo "</SMSResult>";
		echo "</TrunkSMS>";		
		}
	
	}else{
	echo "<TrunkSMS>";
	echo "<SMSResult>";
	echo "<message>";
	echo "Failed No phone number speciefied or empty message or or empty Name";
	echo "</message>";
	echo "</SMSResult>";
	echo "</TrunkSMS>";
	}
	


}else{
echo "<TrunkSMS>";
echo "<SMSResult>";
echo "<message>";
echo "Failed";
echo "</message>";
echo "</SMSResult>";
echo "</TrunkSMS>";
}

?>
