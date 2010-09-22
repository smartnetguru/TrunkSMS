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
	$conn = @mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
	@mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
	
	if(isset($_GET['offset'], $_GET['limit'])){
	$off = (int) $_GET['offset'];
	$limit = (int) $_GET['limit'];
	$sql = "SELECT * FROM TRUNKphoneBook WHERE phoneNo = '$phoneNo' ORDER BY `name` ASC LIMIT $off , $limit";
	$result = @mysql_query($sql);
	$num = 0;
	echo "<div id = \"fbooktitle\"><table><tr><td><img src = \"./images/trunkons/library.png\"></td><td><h3>Phone Book</h3></td></tr></table></div>";
	$num = @mysql_num_rows($result);
	
	echo "<div id = \"fbookbody\">";
	
	echo "<table width = \"95%\">";
	if($num == 0){
	echo "PhoneBook Empty";
	}else{
	//prev and next here
	$n = $off;
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
		echo "<tr>";
    		echo "<td>" . ++$n . "</td><td><a href = \"\" style = \"text-decoration: none;\" onClick = \"editContactFormb('{$rows['id']}'); return false\"> {$rows['name']}</a></td><td><a href = \"\"  style = \"text-decoration: none;\" onClick = \"InsertNumber('{$rows['number']}'); return false;\" >{$rows['number']}</a><td>";
    		if($category != null){
    		echo "<a href = \"\" style = \"text-decoration: none;\" onClick = \"editCategory('$category', '{$rows['category']}'); return false\">{$category}</a></td></td>";
    		}
    		echo "</tr>";
    		} //WEND
    		
    		//prev and next here
    		if ($num == $limit) {
    			
    			if ($off < $limit) {
    				echo "<tr><td>Prev</td> <td></td> <td></td> <td><a href = \"\" style = \"text-decoration: none;\" onClick = \"getMoreContacts($off + $limit,$limit); return false;\">Next</a></td></tr>";
    			}else{
    				echo "<tr><td><a href = \"\" style = \"text-decoration: none;\" onClick = \"getMoreContacts($off - $limit,$limit); return false;\">Prev</a></td> <td></td> <td></td> <td><a href = \"\" style = \"text-decoration: none;\" onClick = \"getMoreContacts($off + $limit,$limit); return false;\">Next</a></td></tr>";
    			}
    			
    		
    		}else
    		if ($off >= $limit || $num == 0){
    		echo "<tr><td><a href = \"\"  style = \"text-decoration: none;\"  onClick = \"getMoreContacts($off - $limit,$limit); return false;\">Prev</a></td> <td></td> <td></td> <td>Next</td></tr>";	
    		}
    		   		
	}
			
	if ($num == 0 && $off >= $limit) {
		echo "<tr><td><a href = \"\" style = \"text-decoration: none;\" onClick = \"getMoreContacts($off - $limit,$limit); return false;\">Prev</a></td> <td></td> <td></td> <td>Next</td></tr>";
	}
	
    				
    	
    		
	
	echo "</table>";
	
	echo "</div>"; //end fbookbody
	}
	
}else{
	echo "Failed";
}
	
	
	?>
