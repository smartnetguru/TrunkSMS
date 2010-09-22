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
if(strlen($_SESSION['phoneNo']) > 0){
require_once "../includes/trunk_config.php";
$phoneNo = $_SESSION['phoneNo']; //session variable
	$conn =@mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
	@mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
	//$phoneNo make sure session exist
	if(isset($_REQUEST['categoryID'], $phoneNo )){
	$id = (int) $_REQUEST['categoryID']; 
	$sql = "DELETE FROM TRUNKphoneBook WHERE `category` = $id";
	$result = @mysql_query($sql);
		if($result){
		echo "<div class=\"ui-widget\">";
				echo "<div class=\"ui-state-highlight ui-corner-all\" style=\"margin-top: 20px; padding: 0 .7em;\">"; 
				echo "<p><span class=\"ui-icon ui-icon-info\" style=\"float: left; margin-right: .3em;\"></span>";
				echo @mysql_affected_rows() . " PhoneBook Entrie(s) were Successfuly deleted.</p>";
				echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\" onClick = \"getphoneBook(); return false;\">Refresh PhoneBook</a> | <a style = \"text-decoration: none;\" href = \"./\" onClick = \"getSMSForm(); return false;\">back</a></div>";
				echo "</div></div>";
				/*
				echo "<div id = \"success\">";
				echo @mysql_affected_rows() . " PhoneBook Entrie(s) were Successfuly deleted";
				echo "</div> <!-- end success -->";
				echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\" onClick = \"getphoneBook(); return false;\">Refresh PhoneBook</a> | <a style = \"text-decoration: none;\" href = \"./\" onClick = \"getSMSForm(); return false;\">back</a></div>";	*/
		}else{
		echo "<div class=\"ui-widget\">";
echo "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;  margin-top: 20px; \">";
				echo "<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>"; 
				echo "<strong>Alert:</strong> Oops! Error deleting Contacts from Specified category.</p>";
				echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\"   onClick = \"getSMSForm(); return false;\">back</a></div>";
echo "</div></div>";
/*
		echo "<div id = \"failure\">";
		echo "Oops! Error deleting Contacts from Specified category";
		echo "</div> <!-- end failure -->";
		echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\"   onClick = \"getSMSForm(); return false;\">back</a></div>";	
		*/
		}	
	
	
	}else{
	echo "<div class=\"ui-widget\">";
echo "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;  margin-top: 20px; \">";
				echo "<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>"; 
				echo "<strong>Alert:</strong> Oops! is either your session has espired or you did not click the delete link.</p>";
				echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\">back</a></div>";		
echo "</div></div>";
/*
	echo "<div id = \"failure\">";
	echo "Oops! is either your session has espired or you did not click the delete link";
	echo "</div> <!-- end failure -->";
	echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\">back</a></div>";	
*/	
	}
}else{
echo "<div class=\"ui-widget\">";
echo "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;  margin-top: 20px; \">";
				echo "<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>"; 
				echo "<strong>Alert:</strong> Your session has expired. click <a href = \"./\">here</a></p>";
				echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\">back</a></div>";	
echo "</div></div>";
/*
echo "<div id = \"failure\">";
	echo "Another user with the username {$_SESSION['name']} is in already. click <a href = \"./\">here</a> ";
	echo "</div> <!-- end failure -->";
	echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\">back</a></div>";
	*/
}
	?>
