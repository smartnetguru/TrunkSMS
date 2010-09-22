<?php
/* Have you got Christ?
 * TrunkSMS GPL project www.trunksms.com.
 * 
 * @author  Daser Solomon Sunday songofsongs2k5@gmail.com,  daser@trunksms.com
 * @version 0.1
 * @License
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Library General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor Boston, MA 02110-1301,  USA
 */
session_start();
require_once "../includes/trunk_config.php";
require_once "../includes/gatewayfunction.php";
require_once "../includes/sheduling.php";

$conn =@mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
	@mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
if(strlen($_SESSION['phoneNo']) > 0){
	if(!empty($_REQUEST['phone']) && !empty($_REQUEST['smsmessage']) && !empty($_REQUEST['smsname'])){
	$phoneNumber = $_REQUEST['phone'];
	$mesg = $_REQUEST['smsmessage'];
	$smsname = $_REQUEST['smsname'];
	
	
				if( ($_REQUEST['date'] != "TODAY") || ($_REQUEST['time'] != "NOW") ){
				
				
				$date = $_REQUEST['date'];
				$time = $_REQUEST['time'];	
				
				if($date == "TODAY"){
				$date = date('m/d/y');	
				}
				
				$times = epoch_sheduling($time,$date); //get the number of seconds that will elapse before sending message- wrt to the birth of unix
				
				
				$dateArray = getdate();
				$dates = "{$dateArray['weekday']} {$dateArray['month']} {$dateArray['mday']}, {$dateArray['year']} By {$dateArray['hours']}:{$dateArray['minutes']}:{$dateArray['seconds']}";
				
				$_SESSION['message'] = "$dates<hr/>";
				
				if(sheduleSMS($_SESSION['phoneNo'], $mesg, $smsname, $phoneNumber,$times) ){
				
				
				
				$_SESSION['message'] .= "<p>Dear User, Your SMS Will be sent to " . $phoneNumber . " ". $date . " at " . $time . "<br/></p>";
				}else{
				
				$_SESSION['message'] .= "<p>Dear User, The Sheduling features of TrunkSMS will be coming up soon. Thanks<br/></p>";
				}
				echo $_SESSION['message'];
				exit();
	
				}
				
	
	$sql = "SELECT * FROM TRUNKregistration WHERE phoneNo = {$_SESSION['phoneNo']}";
	$result = @mysql_query($sql);
	$row = @mysql_fetch_array($result);
	$units = $row['SMSunits'];
	$dateArray = getdate();
	$date = "{$dateArray['weekday']} {$dateArray['month']} {$dateArray['mday']}, {$dateArray['year']} By {$dateArray['hours']}:{$dateArray['minutes']}:{$dateArray['seconds']}";
	$_SESSION['message'] = "$date<hr/>";
		if($units > 1 || $units == 1){
		sendSMS($phoneNumber,$smsname,$mesg);
		}else{
		$_SESSION['message'] .= "<p>Insuficient SMS credit! Please Recharge your Account. Your Balance is $units</p><br/>";	
		}
	
	}else{
	$_SESSION['message'] .= "<p>There are empty field</p><br/>";	
	}
	


}else{
$_SESSION['message'] .= "<p>You have not Logged In</p><br/>";
}


function sendSMS($phone,$smsname,$smsMessage){ //a recursive function that sends more that one pages to one user
global $conn, $units;


$message = substr($smsMessage, 0, 160);//send 1 message

		
	$result = sendToTrunkSMS($smsname,$phone,$smsMessage); //returns bool
	
		if($result){ //this section represents clickAtel
		$units = $units - 1;
$sql = "UPDATE TRUNKregistration SET `SMSunits` = '$units' WHERE `TRUNKregistration`.`phoneNo` = '{$_SESSION['phoneNo']}' ";
if(!mysql_query($sql)){
$_SESSION['message'] .= "<p>Unable to process your account information Please contact Us</p><br/>";
}else{
$_SESSION['balance'] = $_SESSION['balance'] - 1;
}
		++$_SESSION['no'];
		$_SESSION['message'] .= "<p>Sending SMS to " . urldecode($phone) . " " . "Was a Success" . "</p>"; //session based log
		$sentStatus = 1;
		}else{
		//log error message. Cannot connect to www.trunksms.com
		$_SESSION['message'] .= "<p>Sending SMS to " . $phone . " Failed </p><br/>";	
		$sentStatus = 0;
		}
		
				
		////////////////////////////////////////////////////////////////////////
		$status_msg = htmlentities($_SESSION['message']);

		$sql = "INSERT INTO TRUNKsent (`id`, `org`, `phoneNo`, `toNum`, `mesg`, `fromNa`, `units`, `statusMsg`, `date`, `sent`) VALUES (NULL, '{$_SESSION['name']}', '{$_SESSION['phoneNo']}', '$phone', '$smsMessage', '$smsname', '$units', '$status_msg', NOW(), '$sentStatus')";
	
		$result = @mysql_query($sql);
		/////////////////////////////////////////////////////////////////
			
		$nextMesg = trim(str_replace($message, "", $smsMessage));
		$count = strlen($nextMesg);
		if($count > 0 && $units > 0){
		sendSMS($phone,$smsname,$nextMesg); //a recursive call	
		}
		
		unset($result,$units,$count,$smsMessage,$message);
}//endFunc

echo $_SESSION['message'];
?>
