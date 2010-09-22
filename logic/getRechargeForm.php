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
<div><table><tr><td><img src = "./images/trunkons/payment-card.png"></td><td><h2>Recharge </h2></td></tr></table></div>
<div class = "login">
<form name = "Recharge" action = "post" method = "./" onSubmit = "RechargeSMS(); return false;">
<table>
<tr>
<td>Pin Code:</td><td><input type = "text" name = "pin" class = "textboxex"></td>
</tr>
<tr>
<td>Serial No:</td><td><input type = "text" name = "serial" class = "textboxex"></td>
</tr>
<tr>
<td></td><td><input type = "submit" name = "recharge" value = "Recharge"></td>
</tr>
</table>
</form>
</div>
<!--<div id = "categoryForm">this is where category form comes- -->
<div  class = "back"><a style = "text-decoration: none;" href = "./" onClick = "getSMSForm(); return false;">back</a></div>
<?php
}else{
echo "<div id = \"failure\">";
	echo "Request Failed! click <a href = \"./\">here</a> ";
	echo "</div> <!-- end failure -->";
	echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\" onClick = \"getPaymentType(); return false;\">back</a></div>";
}
?>
