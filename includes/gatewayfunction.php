<?php
/* Have you got Christ?
 * TrunkSMS GPL project www.trunksms.com.
 * 
 * @author  Daser Solomon Sunday songofsongs2k5@gmail.com,  daser@trunksms.com
 * @version 0.1
 * @License GPL
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
require_once "../includes/trunk_config.php";
$trunksmsphoneno = TRUNKSMS_PHONE_NO;
$trunksmspassword = md5(TRUNKSMS_PASSWORD); //your password is encrypted before sending to trunksms u can also leave it without encryption if you dont care but encryption must be done with md5 algorithm
$url = "http://www.trunksms.com/API/GET/index.php?";
//$url = "http://www.trunksms.com/API/XML/index.php?"; //alternative choice

function CRONsendToTrunkSMS($smsname,$phone,$smsMessage){
global $trunksmsphoneno, $trunksmspassword,$url;
$x = 0; //false



$phone = parsePhoneNum($phone); //the input number as to undergo purification
//$_SESSION['message'] = rawurlencode(htmlentities($smsMessage));

$query = "phoneno=" . urlencode($trunksmsphoneno) . "&passwd=" . urlencode($trunksmspassword) . "&message=" . urlencode($smsMessage) . "&sendtonum=" . urlencode($phone) . "&smsname=" . urlencode($smsname); 
//url encode the query

$url= $url.$query;


$response = @file_get_contents($url);


list($version, $status_code, $msg) = explode(' ', $http_response_header[0], 3);

//$result = file_get_content();
       switch( $status_code ) {
       case 200:
       // Success now decipher the $response
       		if(is_sucessful($response)){
		$x = 1; //return true
		}
       break;
       case 503:
       $_SESSION['CRONmessage'] .= "Sorry our gateway is down. Try again later";
       break;
       case 403:
       $_SESSION['CRONmessage'] .= "Access to our gateway is Forbidden. Please contact us";
       break;
       default:
       $_SESSION['CRONmessage'] .= "Sorry we could not contact our gateway. Try Later";
       }
	
return $x;
}//end sendToTrunkSMS


function sendToTrunkSMS($smsname,$phone,$smsMessage){
global $trunksmsphoneno, $trunksmspassword,$url;
$x = 0; //false

$phone = parsePhoneNum($phone); //the input number as to undergo purification
//$_SESSION['message'] = rawurlencode(htmlentities($smsMessage));

$query = "phoneno=" . urlencode($trunksmsphoneno) . "&passwd=" . urlencode($trunksmspassword) . "&message=" . urlencode($smsMessage) . "&sendtonum=" . urlencode($phone) . "&smsname=" . urlencode($smsname); 
//url encode the query

$url= $url.$query;

//$_SESSION['message'] .= $url; //uncoment this to debug

$response = @file_get_contents($url);

//$_SESSION['message'] .= $response; //uncoment this to debug

list($version, $status_code, $msg) = explode(' ', $http_response_header[0], 3);

//$result = file_get_content();
       switch( $status_code ) {
       case 200:
       // Success now decipher the $response
       		if(is_sucessful($response)){
		$x = 1; //return true
		}
       break;
       case 503:
       $_SESSION['message'] .= "Sorry our gateway is down. Try again later";
       break;
       case 403:
       $_SESSION['message'] .= "Access to our gateway is Forbidden. Please contact us";
       break;
       default:
       $_SESSION['message'] .= "Sorry we could not contact our gateway. Try Later";
       }
	
return $x;
}//end sendToTrunkSMS

function is_sucessful($trunksms){


$d = substr($trunksms, 0, 2);

if($d == "OK"){
return TRUE;
}else{
return FALSE;
}


}

function parsePhoneNum($raw){
//mines

$num = strlen($raw);

if($num == 11){
return $raw;
}else
if($num == 14){
//string substr(string str, int start[, int length]) 3.0 
$refined = "0" .substr($raw, 4, 11);
return $refined;
}else
if($num == 15){
$refined = substr($raw, 4, 11);
return $refined;
}else{
$_SESSION['message'] .= "<p>This number $raw is invalid</p>";
return $raw;
}

}


?>
