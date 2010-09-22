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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>TrunkSMS Root's user management</title>

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
<div id = "header">Welcome Guest!</div>
<div id="topsection">
<div class="innertube">
<img src = "../../images/logo2.gif";
<img src = "../../images/yourworld.gif">
</div>

</div><!-- end of topsection -->
<div style = "font-size: 25px;">Sudoers Accounts</div>
<?php
//************************************************************************************************************
//  LiveGrid-Edit Example
//************************************************************************************************************
//  Matt Brown
//************************************************************************************************************
if (OpenGridForm("", "TRUNKroot")) {
  if ($oForm->action == "table") {
    DisplayTable();
  }
  else {
    DefineFields();
  }
} else {
  echo 'open failed';
}
CloseApp();

function DisplayTable() {
  DefineFields();
  //echo "<p><textarea id='shippers_debugmsgs' rows='5' cols='80' style='font-size:smaller;'></textarea>";
}

function DefineFields() {
  global $oForm,$oDB;

  $oForm->AddEntryFieldW("username", "Username", "B", "",50);
  $oForm->AddEntryFieldW("password", "Password", "B", "", 150);
  $oForm->ConfirmDeleteColumn();
  $oForm->SortAsc();
  //$oForm->AddEntryFieldW("Phone", "Phone Number", "B", "", 150);

  $oForm->DisplayPage();
}


?>
<?php  require ('../../includes/footer.php'); ?>
</body>
</html>
