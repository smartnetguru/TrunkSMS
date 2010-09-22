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
	
if(isset($phoneNo, $_GET['category'])){
	$category = addslashes(trim($_GET['category']));
	$sql = "SELECT * FROM TRUNKphoneBookCat WHERE phoneNo ='$phoneNo' AND category = '$category' ";
	$result = @mysql_query($sql); //get the category id to enable us fetch how may contact in the cat in phonebook table
	$num = 0;
	$num = @mysql_num_rows($result);
	if($num == 0){
		if($category == "All"){
		$sql = "SELECT * FROM TRUNKphoneBook WHERE phoneNo ='$phoneNo' ";
		$result = mysql_query($sql);
		$num = 0;
		$num = mysql_num_rows($result);
		echo "$num Contact(s)";	
		}else{
		print "Invalid category";
		}
	}else{
	$row = @mysql_fetch_array($result);
	$catID = $row['id'];
	@mysql_free_result($result);
		if($category == "All"){
		$sql = "SELECT * FROM TRUNKphoneBook WHERE phoneNo ='$phoneNo' ";
		}else{
		$sql = "SELECT * FROM TRUNKphoneBook WHERE category = '$catID' AND phoneNo ='$phoneNo' ";
		}
	$result = @mysql_query($sql);
	$num = 0;
	$num = @mysql_num_rows($result);
	echo "$num Contact(s)";		
	}
	@mysql_close($conn);
}

}else{
echo "Please Sign In";
}
?>
