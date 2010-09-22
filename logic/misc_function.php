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
require_once "../includes/gatewayfunction.php";
require_once "../includes/trunk_config.php";
$site_address = WEBSITE_ADDRESS;
$noReplyEmail = NO_REPLY_EMAIL;

$headers = 'From:' .  $noReplyEmail . "\r\n";


function  getActivationForm($phoneNo = null, $password = null){
echo "<div><table><tr><td><img src = \"./images/trunkons/milestone.png\"></td><td><h3>Account Activation</h3></td></tr></table></div>";
echo "<div class = \"login\">";
echo "<form name = \"activate\" onSubmit = \"submitActivateForm(); return false;\" action = \"\" method = \"post\">";
echo "<table>";
echo "<tr>";
echo "<td><label>*Phone No:</label></td><td><input  class = \"textboxex\" type = \"text\" name=\"phoneNo\" value =\"$phoneNo\" class = \"login_txtformat\" autocomplete=\"off\"/></td></tr>";
echo "<tr>";
echo "<td><label>*Password:</label></td><td><input  class = \"textboxex\" type = \"password\" name=\"password\" value =\"$password\" class = \"login_txtformat\"/></td></tr>";
echo "<tr>";
echo "<td><label>*Phone Code:</label></td><td><input class = \"textboxex\" type = \"text\" name=\"phoneCode\" class = \"login_txtformat\"/></td></tr>";
echo "<tr><td>*Email Code</td><td><input  class = \"textboxex\" type = \"text\" name=\"EmailCode\" class = \"login_txtformat\"/></td></tr>";
echo "<tr><td></td><td><input type = \"submit\" name=\"submitAct\" value = \"Activate Account\" class = \"login_txtformat\"/></td></tr>";
echo "</table>";
echo "</form></div>";
}


function sendMail($email, $emailCode, $name){

global $headers,$site_address;

$trunk_mesg = "Hi, $name \n\n\tYou have one more step to finalize your registration. \nAn activation code has been sent to your phone and here is your Email code: $emailCode. \n\n\tNote that you need both code to activate your account. copy both codes and go to $site_address to activate your account\n\n\t $site_address";
$x = mail($email, $site_address . " Confirmation Code", $trunk_mesg, $headers);

if($x){
return 1;
}else{
return 0;
}


}

function emailAccountNo($email, $accountNo, $name){

global $headers,$site_address;

$trunk_mesg = "Congratulations, $name \n\n\tThank You for registering with $site_address. \n Here is your account number: $accountNo which could be used to transfer SMS units among Users.\n\n\t $site_address";


$x = mail($email, $site_address . " - Congratulations!!!", $trunk_mesg, $headers);

if($x){
return 1;
}else{
return 0;
}


}


function mailPassword($email, $password){

global $headers,$site_address;

$trunk_mesg = "Hi Dear,\n\n\tThis is your Lost password: $password \n Should You have any trouble Loging in, Please Contact us. We here to serve you.\n\n\t $site_address";


$x = mail($email, $site_address ." Password Recovery!!!", $trunk_mesg, $headers);

if($x){
return 1;
}else{
return 0;
}


}

function sendSMS($countryCode,$phoneNo, $phoneCode){
global $site_address;

$trunk_msg = "Your Activation Phone code is: " . $phoneCode;

$x = sendToTrunkSMS($site_address,$phoneNo,$trunk_msg);

if($x){
return 1;
}else{
return 0;
}

}

function parseTime($epoch){
return strftime("%c \n", $epoch);
}
?>
