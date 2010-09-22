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
if (!isset ($_SESSION)) session_start();
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header("Expires: ".gmdate("D, d M Y H:i:s",time()+(-1*60))." GMT");
header("Content-type: text/xml");
echo "<?xml version='1.0' encoding='UTF-8'?".">\n";

require "applib.php";
require "./plugins/php/ricoXmlResponse.php";

$id=isset($_GET["id"]) ? $_GET["id"] : "";
$offset=isset($_GET["offset"]) ? $_GET["offset"] : "0";
$size=isset($_GET["page_size"]) ? $_GET["page_size"] : "";
$total=isset($_GET["get_total"]) ? strtolower($_GET["get_total"]) : "false";
$distinct=isset($_GET["distinct"]) ? $_GET["distinct"] : "";

echo "\n<ajax-response><response type='object' id='".$id."_updater'>";
if (empty($id)) {
  ErrorResponse("No ID provided!");
} elseif ($distinct=="" && !is_numeric($offset)) {
  ErrorResponse("Invalid offset!");
} elseif ($distinct=="" && !is_numeric($size)) {
  ErrorResponse("Invalid size!");
} elseif ($distinct!="" && !is_numeric($distinct)) {
  ErrorResponse("Invalid distinct parameter!");
} elseif (!isset($_SESSION[$id])) {
  ErrorResponse("Your connection with the server was idle for too long and timed out. Please refresh this page and try again.");
} elseif (!OpenDB()) {
  ErrorResponse(htmlspecialchars($oDB->LastErrorMsg));
} else {
  $filters=isset($_SESSION[$id . ".filters"]) ? $_SESSION[$id . ".filters"] : array();
  $oDB->DisplayErrors=false;
  $oDB->ErrMsgFmt="MULTILINE";
  $oXmlResp= new ricoXmlResponse();
  $oXmlResp->sendDebugMsgs=true;
  $oXmlResp->convertCharSet=true;  // MySQL sample database is encoded with ISO-8859-1
  if ($distinct=="") {
    $oXmlResp->Query2xml($_SESSION[$id], intval($offset), intval($size), $total!="false", $filters);
  } else {
    $oXmlResp->Query2xmlDistinct($_SESSION[$id], intval($distinct), -1, $filters);
  }
  if (!empty($oDB->LastErrorMsg)) {
    echo "\n<error>";
    echo "\n".htmlspecialchars($oDB->LastErrorMsg);
    echo "\n</error>";
  }
  $oXmlResp=NULL;
  CloseApp();
}
echo "\n</response></ajax-response>";


function ErrorResponse($msg) {
  echo "\n<rows update_ui='false' /><error>" . $msg . "</error>";
}

?>
