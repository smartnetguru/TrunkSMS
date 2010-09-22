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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome to TrunkSMS.com A platform to send multiple SMS</title>
<script type = "text/javascript" src ="./presentation/ajaxReq.js"></script>
<script type = "text/javascript" src = "./presentation/flogic.js"></script>
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/profile.css">
<link type="text/css" href="./jquery/css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />
</head>
<body>
<?php
if(strlen($_SESSION['phoneNo']) > 0){
require_once "../includes/trunk_config.php";
$phoneNo = $_SESSION['phoneNo']; //session variable
$conn =@mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
@mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
  $allowedtypes = array ("text/plain","text/csv");
  
  if (isset($_FILES['contact_filename'], $_POST['category']) && $_POST['category'] != "No category"){
    //Then we need to confirm it is of a file type we want.
    if (in_array ($_FILES['contact_filename']['type'], $allowedtypes)){
      //Then we can perform the copy.
      if ($_FILES['contact_filename']['error'] == 0){
        //$thefile = $savefolder . "/" . $_FILES['myfile']['name'];
        if (!is_file($_FILES['contact_filename']['tmp_name'])){
        echo "<div class=\"ui-widget\">";
				echo "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;  margin-top: 20px; \">";
				echo "<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>"; 
				echo "<strong>Alert:</strong> There was an error uploading the file.</p>";
				echo "<div  class = \"back\"><a style = \"text-decoration: none;\" href = \"./\" onClick = \"getSMSForm(); return false;\">back</a></div>";	
				echo "</div></div>";
				/*
        echo "<div id = \"error\">";
	 echo "  There was an error uploading the file.";
	echo "</div> <!-- end error -->";*/
        }else {
        	$sql = "SELECT * FROM TRUNKphoneBookCat WHERE phoneNo = '$phoneNo' AND category = '{$_POST['category']}' ";
		$result = @mysql_query($sql);
		$num = 0;
		$num = @mysql_num_rows($result) or die(mysql_error());
	if($num == 1){
	$row = @mysql_fetch_array($result);
	$catID = $row['id'];
	@mysql_free_result($result);
	$n = 0; //success count i.e num of entries that was successfuly uploaded
	$m = 0; //fail count i.e num of entries that was unsuccessfuly uploaded
        	$handle = @fopen($_FILES['contact_filename']['tmp_name'], "r");
		if ($handle) {
		   if($_FILES['contact_filename']['type'] == "text/csv"){
		  	 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
   			 $name = ucwords(strtolower(addslashes(trim($data[0]))));
   			 $no = ucwords(strtolower(addslashes(trim($data[1]))));
   			 	if(strlen($name) > 0 && strlen($no) > 0){
				$sql = "INSERT INTO TRUNKphoneBook (`id`, `phoneNo`, `number`, `name`, `category`) VALUES (NULL, '$phoneNo', '$no', '$name', '$catID');";
				$result = @mysql_query($sql);
				$good = 1;
				}else{
				//$fail = 1; //should be false so that we include it in error count
				}
				//log errors and success message.
				if($result && $good == 1){
				//log success count
				++$n;
				unset($good);
				}else{
				//log errors count
				++$m;
				}
			
			unset($result);
			}//end while
		   
		  // die("this is a csv file handle this differently");
		   
		   }else{
    			while (!feof($handle)) {
        		$Contactsbuffer = fgets($handle, 4096);
        		//echo $buffer . "<br/>";
        		//$phoneBook  = 'daser, 0808232242343';
			$f = strpos($Contactsbuffer , ",");
			$name = ucwords(strtolower(addslashes(trim(substr($Contactsbuffer, "0", $f )))));
			$no = strstr($Contactsbuffer, ',');
			$no = str_replace(',', '',$no);
			$no = addslashes(trim($no));
		if(strlen($name) > 0 && strlen($no) > 0){
		$sql = "INSERT INTO TRUNKphoneBook (`id`, `phoneNo`, `number`, `name`, `category`) VALUES (NULL, '$phoneNo', '$no', '$name', '$catID');";
		$result = @mysql_query($sql);
		$good = 1;
		}else{
		//$fail = 1; //should be false so that we include it in error count
		}
			//log errors and success message.
				if($result && $good == 1){
				//log success count
				++$n;
				unset($good);
				}else{
				//log errors count
				++$m;
				}
			
			unset($result);
    			}//end while
    		  }//end checking for csv
  		@fclose($handle);
  		
  		echo "<div class=\"ui-widget\">";
				echo "<div class=\"ui-state-highlight ui-corner-all\" style=\"margin-top: 20px; padding: 0 .7em;\">"; 
				echo "<p><span class=\"ui-icon ui-icon-info\" style=\"float: left; margin-right: .3em;\"></span>";
				echo "  $n Contact(s) was Successfuly added To your Phone Book</p>";
				echo "</div></div>";
				/*
  		echo "<div id = \"success\">";
				echo "  $n Contact(s) was Successfuly added To your Phone Book";
				echo "</div> <!-- end success -->";	
				*/
				echo "<div class=\"ui-widget\">";
echo "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em; margin-top: 20px; \">";
				echo "<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>"; 
				echo "<strong>Alert:</strong> $m contact(s) failed to upload.</p>";	
				echo "</div></div>";
				/*
  		echo "<div id = \"error\">";
			echo "  $m contact(s) failed to upload.";
			echo "</div> <!-- end error -->";*/
		} 
	}else{
	echo "<div class=\"ui-widget\">";
echo "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em; margin-top: 20px; \">";
				echo "<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>"; 
				echo "<strong>Alert:</strong> The provided Category does not Exists.</p>";
				echo "</div></div>";
				/*
			echo "<div id = \"error\">";
			echo "  The provided Category does not Exists.";
			echo "</div> <!-- end error -->";	
			*/
			
			}
          //Signal the parent to load the image.
          ?>
           <?php
         }
       }else{
       echo "<div id = \"error\">";
			echo "		Ops an error occured";
			echo "</div> <!-- end error -->";
       }
     }else{
     echo "<div class=\"ui-widget\">";
echo "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em; margin-top: 20px; \">";
				echo "<p><span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\"></span>"; 
				echo "<strong>Alert:</strong> 		File type not supported. you just uploaded a file of type: ". $_FILES['contact_filename']['type'] . " instead of *.txt e.g contacts.txt.</p>";
				echo "</div></div>";
/*				
     echo "<div id = \"error\">";
	echo "		File type not supported. you just uploaded a file of type: ". $_FILES['contact_filename']['type'] . " instead of *.txt e.g contacts.txt";
			echo "</div> <!-- end error -->";*/
     }
   }else{
   echo "<div id = \"error\">";
	echo "		File Not Sent or Invalid Category";
			echo "</div> <!-- end error -->";
   }
  @mysql_close($conn);
   }else{
echo "<div id = \"error\">";
	echo "		Your session has expired. please login again";
	echo "</div> <!-- end error -->";
}
?>

</body>
</html>
