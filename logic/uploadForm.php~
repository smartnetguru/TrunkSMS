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
$phoneNo = $_SESSION['phoneNo'];
echo "<table><tr><td><img src = \"./images/trunkons/product-design.png\"></td><td><h3>Upload Contacts From File</h3></td></tr></table>";
echo "File content Format: Jones, 08077746115 per line.<br/>";
echo "File Type: Text/CSV, Text/Plain e.g *.csv, *.txt.";
echo "<div class = \"loginExt\"";

print "<form name=\"form2\" method=\"post\" action=\"./logic/process_upload.php\"
enctype=\"multipart/form-data\" target=\"uploadframe\" onsubmit=\"uploadimg(this); return false\">";
			print "<table align = \"center\">";
			print "<tr>";
			print "<td>Contact Upload:</td><td><input name=\"contact_filename\" type=\"file\" id=\"upload\"></td>";
			echo "</tr>";
			echo "<tr>";
echo "<td>Category</td><td><select name = \"category\">";
require_once "../includes/trunk_config.php";
$conn =@mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
	@mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
	$phoneNo = $_SESSION['phoneNo'];
	$sql = "SELECT * FROM TRUNKphoneBookCat WHERE phoneNo = '$phoneNo' ";
	$result = mysql_query($sql);
	$num = 0;
	$num = @mysql_num_rows($result);
	if($num == 0){
	echo "<option>No category</option>";
	}else{
		while($rows = @mysql_fetch_array($result)){
		echo "<option>{$rows['category']}</option>";		
		}//endwhile	
	}

echo "</select>";
echo "<a href = \"\" onClick = \"getaddCatForm(); return false;\" >Add</a>";
echo "</td></tr>";
echo "<tr><td></td>";
echo "<td><input type = \"submit\" name = \"phoneBookUpload\" value=\"upload\"></td></tr>";

print "</table></form></div>";	
echo "<iframe id=\"uploadframe\" name=\"uploadframe\" src=\"./logic/ContentForUploadFrame.php\" class=\"noshow\"></iframe>";		
}else{
echo "<div id = \"failure\">";
	echo "Another user with the username {$_SESSION['name']} is in already. click <a href = \"./\">here</a> ";
	echo "</div> <!-- end failure -->";
	echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\" onClick = \"getSMSForm(); return false;\">back</a></div>";
}
?>
