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

if(isset($_SESSION['root']) && $_SESSION['root'] == "admin"){
  header("location: main.php"); 	
}


$conn =mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
	mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
if(isset($_POST['sub'],$_POST['root'],$_POST['passwd']) && strlen($_POST['root']) < 255 && strlen($_POST['passwd'] < 255) ){
  	$username = addslashes(trim($_POST['root']));
  	$passwd = addslashes(trim($_POST['passwd']));
  	$passwd = md5($passwd);
  	
  $query = "SELECT * FROM TRUNKroot WHERE username = '$username' AND password = '$passwd' ";
  	
  $result = @mysql_query($query);
  $num = 0;
  $num = @mysql_num_rows($result);
  if($num == 1){
  $_SESSION['root'] = "admin";
  $rows = @mysql_fetch_array($result);
  $_SESSION['username'] = $rows['username'];
   
  header("location: main.php");
  }else{
  $msg = "<p> The Supplied Username or Password is Wrong</p>";
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
background: url(../images/header_back.jpg) left repeat-x;
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
<img src = "../images/logo2.gif";
<img src = "../images/yourworld.gif">
</div>

</div><!-- end of topsection -->

<center>
<?php echo $msg ?>
<h1>Root's Login</h1>
<form method = "post" action = "<?php echo $_SERVER['PHP_SELF'] ?>">
<table>
<tr>
<td>Username</td>
<td><input type = "text" name = "root"></td>
</tr>

<tr>
<td>Password</td>
<td><input type = "password" name = "passwd"></td>
</tr>

<tr>
<td></td>
<td><input type = "submit" name = "sub" value = "login"></td>
</tr>

</table>
</form>
</center>
<br/>
<div id="footer"><?php include("../includes/footer.php") ?></div>
</body>
</html>
