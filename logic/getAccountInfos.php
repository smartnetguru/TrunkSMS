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
include "misc_function.php";
$phoneNo = $_SESSION['phoneNo'];

$conn =mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");

$sql = "SELECT * FROM TRUNKregistration WHERE phoneNo = '$phoneNo' ";

$result = mysql_query($sql);
$num = 0;
$num = mysql_num_rows($result);

if($num == 0){
print "Please sign out and sign in in again";
}else{

$row = mysql_fetch_array($result);
$_SESSION['balance'] = $row['SMSunits'];
}

?>
<div id = "acct_title" style = "margin-left: 30px;"><table><tr><td><img src = "./images/trunkons/graphic-design.png"></td><td><h2>Account Info</h2></td></tr></table></div>
    <div id = "acctInfo">
    <table width = "100%">
    <tr>
    <td>Account No:</td><td><?php echo $_SESSION['acctNo'];?></td>
    </tr>
    <tr>
    <td>Balance:</td><td><?php echo $_SESSION['balance']; ?> Units</td>
    </tr>
     <tr>
    <td>Country:</td><td><?php echo $_SESSION['country']; ?></td>
    </tr>
    <tr>
    <td>Country Code:</td><td><?php echo $_SESSION['countryCode'];?></td>
    </tr>
    </table>    
    </div><!-- end acctInfo-->
    
    <?php
    }else{
    session_destroy();
    echo "Not Allowed";
    }
    ?>
