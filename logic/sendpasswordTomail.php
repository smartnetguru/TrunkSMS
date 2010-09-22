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
require_once "../includes/trunk_config.php";

include "misc_function.php";

$conn =@mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
	@mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
if(isset($_POST['submit'],$_POST['phoneNo']) && strlen($_POST['phoneNo']) < 255){
  	$phoneNo = addslashes(trim($_POST['phoneNo']));
	$sql = "SELECT * FROM TRUNKregistration WHERE phoneNo = '$phoneNo' ";
	$result = @mysql_query($sql) or die("blah blah" . __LINE__);
	$num = 0;
	$num = @mysql_num_rows($result);
	if($num == 1){
		while($row = @mysql_fetch_array($result)){
		$email = $row['email'];
		$password = $row['password'];
		}
		//call a mail function that delivers the $password
		
				for($x=1;$x<=10;$x++){
				$generatedpasswd[] = rand(0,5);
				}
				$generatedpasswd = "TSMS" . implode("", $generatedpasswd);
				$debugGenpassword = $generatedpasswd; //just for debugginh in localhost
				$generatedpasswd = md5($generatedpasswd);
				$sql = "UPDATE TRUNKregistration SET `password` = '$generatedpasswd' WHERE `TRUNKregistration`.`phoneNo` = '$phoneNo' ";
				
				$result = mysql_query($sql) or die("An unknown Error Occured while recovering your password");
				
				if(!$result)die("We could not Recover your password");
				
		if(mailPassword($email, $generatedpasswd)){
		
		echo "<div id = \"success\">";
		echo "Your old password was destroyed and a new password has been sent to $email";
		echo "</div> <!-- end success -->";
		echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\">back</a></div>";
		}else{
		echo "<div class=\"ui-widget\">";
echo "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em; margin-top: 20px; \">";
				echo "<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>"; 
				echo "<strong>Alert:</strong> Your Password Was Recovered But we Could not Mail your Password. This is probably due to Technial problem. We apologize for inconviniences. Please Contact Us.</p>";
				echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\">back</a></div>";	
				echo "</div></div>";
			/*	
		echo "<div id = \"failure\">";
		echo "Your Password Was Recovered But we Could not Mail your Password. This is probably due to Technial problem. We apologize for inconviniences. Please Contact Us.";
		echo "</div> <!-- end failure -->";
		echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\">back</a></div>";	
		*/
		}
	}else{
	echo "<div class=\"ui-widget\">";
echo "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em; margin-top: 20px; \">";
				echo "<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>"; 
				echo "<strong>Alert:</strong> The username/phone Number does not exist.</p>";
				echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\">back</a></div>";
				echo "</div></div>";
	/*			
	echo "<div id = \"failure\">";
	echo "The username/phone Number does not exist";
	echo "</div> <!-- end failure -->";
	echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\">back</a></div>";
	*/
	}
}else{
echo "<div id = \"failure\">";
	echo "You are not authorize to view this page";
	echo "</div> <!-- end failure -->";
	echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\">back</a></div>";
}

?>
