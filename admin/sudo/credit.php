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
if (!isset ($_SESSION)) session_start();

if(isset($_SESSION['root']) && $_SESSION['root'] == "admin"){
  	
}else{
header("location: ../");
}


if(isset($_GET['cus_email'],$_GET['searchemail'])){

$email = trim(stripslashes($_GET['cus_email']));

require_once "../../includes/trunk_config.php";
$conn =mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
$sql = "SELECT * FROM TRUNKregistration WHERE email = '$email' OR phoneNo = '$email' ";
$result = mysql_query($sql);
$num = 0;
$num = mysql_num_rows($result);
if($num == 0){
$msg = "This User does not Exist";
}else{
$got = 1;
$row = mysql_fetch_array($result);
$phoneno = $row['phoneNo'];
$name = $row['org'];
$units = $row['SMSunits'];
}

}else
if(isset($_POST['phoneNo'],$_POST['update'])){

	if($_SESSION['submited'] == trim($_POST['phoneNo'])){

	$msg = "You have already credited this account";
	}else{	
	$phoneNo = trim($_POST['phoneNo']);
	
	$boughtUnits = (int) $_POST['boughtUnits'];
	if($boughtUnits == 0){
	$msg = "Invalid Entry for Unit Bough Field";
	}else{
	
	require_once "../../includes/trunk_config.php";
	$conn =mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
	mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
	$sql = "SELECT * FROM TRUNKregistration WHERE phoneNo = '$phoneNo' ";
	$result = mysql_query($sql);
	$num = 0;
	$num = mysql_num_rows($result);
	$row = mysql_fetch_array($result);
	
	$units = $row['SMSunits'];
	$curname = $row['org'];
	
	$newUnits = $units + $boughtUnits;
	//die($newUnits . $phoneNo);
	$sql = "UPDATE TRUNKregistration SET `SMSunits` = '$newUnits' WHERE `phoneNo` = '$phoneNo' ";
	//$result = 1;
	$result = mysql_query($sql);
		
	if($result){
	
		if(isset($_POST['delivery'])){
		//notifying user of the transaction
		require "../../includes/gatewayfunction.php";
		$smsMessage = "Hello, Your account has been credited as follows:Old: $units \n New:$newUnits. Thanks for using TrunkSMS.com";
			if(sendToSMSLive("TrunkSMS",$phoneNo,$smsMessage)){
			$msg = "SMS notification has been sent to $curname";
			}else{
			$msg = $_SESSION['message'];
			unset($_SESSION['message']);
			}
		}
		
		$msg .= "<p>Successfuly Updated from $units to $newUnits</p>";
		$_SESSION['submited'] = $phoneNo;
		
	}
	
	}//boughtfield

	}

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>TrunkSMS Root Panel</title>

<style type="text/css">
input, select { font-weight:normal;font-size:8pt;}

body{
font-family: Trebuchet MS, Tahoma, Verdana, Arial, sans-serif;
margin:0;
background: #f6f6f6;
padding:0;
}

#topsection{
height: 50px;
background: url(../../images/header_back.jpg) left repeat-x;
font-size: 30px;
}

#topsection h1{
margin: 0;
padding-top: 15px;
}

#header{
font-size:12px;
padding-right: 10px;
border-right: none;
border-top: none;
border-left: none;	
text-align: right;
margin-bottom: 3px;
margin-top: 3px;
}

#footer{
clear: left;
margin-top: 5px;
text-align: center;
font-size: 11px;
color: #9d9f13;
text-align: center;
}

</style>
</head>


<body>
<div id = "header">Welcome <?php echo $_SESSION['username'] ?>!</div>
<div id="topsection">
<div class="innertube">
<img src = "../../images/logo2.gif";
<img src = "../../images/yourworld.gif">
</div>

</div><!-- end of topsection -->

<div style = "margin-top: 12px;"><font size = "3"><center><?php echo $msg ?></center></font></div>

<div style = "margin-top: 20px;margin-bottom: 50px;">
<center>
<h1>Credit Customer Account</h1>
<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = "GET">
<table cellspacing = "10">
<tr>
<td>Phone No/Email Address:</td>
<td><input type = "text" name = "cus_email"/></td>
</tr>
<tr>
<td></td>
<td><input type = "submit" name = "searchemail" value = "Show"/></td>
</tr>

</table>
</form>
</center>
</div>

<?php
if($got == 1){
?>
<div style = "margin-top: 20px;margin-bottom: 50px;">
<center>
<form action = "<?php echo $_SERVER['PHP_SELF'] ?>" method = "POST">
<table cellspacing = "10">
<tr>
<td>Phone No:</td>
<td><input type = "text" name = "phone" value = "<?php echo $phoneno ?>" disabled = "disabled"/></td>
</tr>
<tr>
<td>Name:</td>
<td><input type = "text" name = "name" value = "<?php echo $name ?>" disabled = "disabled" /></td>
</tr>

<tr>
<td>Present Unit:</td>
<td><input type = "text" name = "punits" value = "<?php echo $units ?>"  size = "5" disabled = "disabled" /></td>
</tr>

<tr>
<td>Units bought:</td>
<td><input type = "text" name = "boughtUnits" size = "5"/></td>
</tr>

<tr>
<td></td>
<td><input type="checkbox" name="delivery" value="yes" checked = "checked"/>Notify by SMS</td>
</tr>

<tr>
<td><input type = "hidden" name = "phoneNo" value = "<?php echo $phoneno ?>"/></td>
<td><input type = "submit" name = "update" value = "Update"/></td>
</tr>


</table>
</form>
</center>
</div>
<?php

}else{
}
?>
<div id="footer"><?php include("../../includes/footer.php") ?></div>
</body>
</html>

