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
	$conn =mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
	mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
$sql = "SELECT * FROM TRUNKphoneBook WHERE phoneNo = '$phoneNo' ORDER BY `name` ASC";
		$result = mysql_query($sql);
		$num = 0;	
		
		
		$num = @mysql_num_rows($result);
		echo "<table width = \"10\">";
		
			if($num == 0){
			echo "No Contacts";
			}else{
						while($rows = @mysql_fetch_array($result)){
						$sql = "SELECT * FROM TRUNKphoneBookCat WHERE id = '{$rows['category']}' ";
						$resource = @mysql_query($sql);
						$nums = 0;
						$nums = @mysql_num_rows($resource); 
						if($nums == 0){
						$category = null;
						}else{
						$row = @mysql_fetch_array($resource);
						$category = $row['category'];
						}
						@mysql_free_result($resource);
						echo "<tr  width = \"20%\">";
					    echo "<td><a href = \"\" onClick = \"editContactFormb('{$rows['id']}'); return false\"> {$rows['name']}</a></td><td><a href = \"\" onClick = \"InsertNumber('{$rows['number']}'); return false;\" >{$rows['number']}</a><td>";
					    	if($category != null){
					    	echo "<a href = \"\" onClick = \"editCategory('$category', '{$rows['category']}'); return false\">{$category}</a></td></td>";
					    	}
					    echo "</tr>";
					   
					   //
					    }
			}
			
			
		 echo "</table>";
}else{
echo "your session has expired";
}		 
?>
