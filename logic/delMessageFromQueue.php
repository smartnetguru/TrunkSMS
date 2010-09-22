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
	mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
	//$phoneNo make sure session exist
	if(isset($_REQUEST['mesid'], $phoneNo, $_REQUEST['tblname'] )){
	$id = (int) $_REQUEST['mesid']; 
	$table = stripslashes(trim($_REQUEST['tblname']));
	
	$sql = "DELETE FROM TRUNK$table WHERE id = $id";
	
	$result = @mysql_query($sql);
	
		if($result){
				echo "The queued message was <strong>Successfuly</strong> deleted.</p>";
				
		}else{
				echo "<strong>Alert:</strong> Error deleting Message.</p>";
		}	
	
	
	}else{

				echo "<strong>Alert:</strong> Oops! is either your session has espired";
	
	}
}else{
		echo "<strong>Alert:</strong> Your session has expired.";
}
	?>
