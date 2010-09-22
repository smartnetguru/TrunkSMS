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
?>
<div><table><tr><td><img src = "./images/trunkons/plus.png"></td><td><h2>Add Contact</h2></td></tr></table></div>
<div class = "login">
<form name = "addContact" action = "post" method = "./" onSubmit = "submitContacts(); return false;">
<table>
<tr>
<td>Name:</td><td><input type = "text" name = "contactName" class = "textboxex"></td>
</tr>
<tr>
<td>Phone Number:</td><td><input type = "text" name = "phoneNo" class = "textboxex"></td>
</tr>
<tr>
<td>Category</td><td><select name = "category">
<?php
require_once "../includes/trunk_config.php";
$conn =@mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
	@mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
	$phoneNo = $_SESSION['phoneNo'];
	$sql = "SELECT * FROM TRUNKphoneBookCat WHERE phoneNo = '$phoneNo' ";
	$result = @mysql_query($sql);
	$num = 0;
	$num = @mysql_num_rows($result);
	if($num == 0){
	echo "<option>No category</option>";
	}else{
		while($rows = @mysql_fetch_array($result)){
		echo "<option>{$rows['category']}</option>";		
		}//endwhile	
	}

?>
</select>
<a href = "" onClick = "getaddCatForm(); return false;" >Add</a>
</td>
</tr>

<tr>
<td></td><td><input type = "submit" name = "addContact" value = "Add"></td>
</tr>
</table>
</form>
</div>
<!--<div id = "categoryForm">this is where category form comes- -->
<div  class = "back"><a style = "text-decoration: none;" href = "./" onClick = "getSMSForm(); return false;">back</a></div>
<?php
}else{
echo "<div id = \"failure\">";
	echo "Your session has expired. click <a href = \"./\">here</a> ";
	echo "</div> <!-- end failure -->";
	echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\" onClick = \"getSMSForm(); return false;\">back</a></div>";
}
?>
