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

if(isset($_SESSION['root']) && $_SESSION['root'] == "admin"){
}else{
header("location: ../");
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>TrunkSMS Root Panel</title>

<style type="text/css">
input, select { font-weight:normal;font-size:8pt;}

body{
font-family: Trebuchet MS, Tahoma, Verdana, Arial, sans-serif;
margin:0;
background: #f6f6f6;
padding:0;
}

#topsection{
height: 50px;
background: url(../../images/header_back.jpg) left repeat-x;
font-size: 30px;
}

#topsection h1{
margin: 0;
padding-top: 15px;
}

#header{
font-size:12px;
padding-right: 10px;
border-right: none;
border-top: none;
border-left: none;	
text-align: right;
margin-bottom: 3px;
margin-top: 3px;
}

#footer{
clear: left;
margin-top: 5px;
text-align: center;
font-size: 11px;
color: #9d9f13;
text-align: center;
}

</style>
</head>


<body>
<div id = "header">Welcome <?php echo $_SESSION['username'] ?>!</div>
<div id="topsection">
<div class="innertube">
<img src = "../../images/logo2.gif";
<img src = "../../images/yourworld.gif">
</div>

</div><!-- end of topsection -->
<?php
if(1){
require_once "../../includes/trunk_config.php";
//$phoneNo = $_SESSION['phoneNo']; //session variable
$conn =@mysql_connect(HOST,USER,PASS) or die("Skywalkers Nig: Cannot Connect To the Database Server");
@mysql_select_db(DB,$conn) or die ("Skywalkers Nig: Cannot Select Database Please Try Again later");
  $allowedtypes = array ("text/plain","text/csv");
  
  if (isset($_FILES['scratchcard_filename']) ){
    //Then we need to confirm it is of a file type we want.
    if (in_array ($_FILES['scratchcard_filename']['type'], $allowedtypes)){
      //Then we can perform the copy.
      if ($_FILES['scratchcard_filename']['error'] == 0){
        //$thefile = $savefolder . "/" . $_FILES['myfile']['name'];
        if (!is_file($_FILES['scratchcard_filename']['tmp_name'])){
        echo "<div id = \"errorup\">";
	 echo "  There was an error uploading the file.";
	echo "</div> <!-- end error -->";
        }else {
        
	if(1){
	$n = 0; //success count i.e num of entries that was successfuly uploaded
	$m = 0; //fail count i.e num of entries that was unsuccessfuly uploaded
        	$handle = @fopen($_FILES['scratchcard_filename']['tmp_name'], "r");
		if ($handle) {
		   if($_FILES['scratchcard_filename']['type'] == "text/csv"){
		  	 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
   			 $pin = ucwords(strtolower(addslashes(trim($data[0]))));
   			 $serial = ucwords(strtolower(addslashes(trim($data[1]))));
   			 $units = ucwords(strtolower(addslashes(trim($data[2]))));
   			 	if(strlen($pin) > 0 && strlen($serial) > 0 && strlen($units) > 0){
				$sql = "INSERT INTO TRUNKrecharging (`serialNo`, `pincode`, `used`, `phone`, `units`, `date`) VALUES ('$serial', '$pin', '0', NULL, '$units', NOW() );";
				//die($sql);
				$result = mysql_query($sql);
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
		   
		   echo "<div id = \"errorup\">";
			echo "File extension not surported.";
			echo "</div> <!-- end error -->";
    			
    			
    		  }//end checking for csv
  		@fclose($handle);
  		echo "<div id = \"success\">";
				echo "  $n number of Scratcha was Successfuly added To Recharging table";
				echo "</div> <!-- end success -->";	
  		echo "<div id = \"errorup\">";
			echo "  $m number of scratch card(s) failed to upload.";
			echo "</div> <!-- end error -->";
		} 
		
	}//endif 1
	
          //Signal the parent to load the image.
          ?>
           <?php
         }
       }else{
       echo "<div id = \"errorup\">";
			echo "		Ops an error occured";
			echo "</div> <!-- end error -->";
       }
     }else{
     echo "<div id = \"errorup\">";
	echo "		File type not supported. you just uploaded a file of type: ". $_FILES['scratchcard_filename']['type'] . " instead of *.txt e.g .txt";
			echo "</div> <!-- end error -->";
     }
   }else{
   echo "<div id = \"errorup\" style = \"text-align: center;\">";
	echo "		File Not Sent or Invalid Entry";
			echo "</div> <!-- end error -->";
   }
  @mysql_close($conn);
   }else{
echo "<div id = \"errorup\">";
	echo "		Your session has expired. please login again";
	echo "</div> <!-- end error -->";
}
?>
<div id="footer"><?php include("../../includes/footer.php") ?></div>
</body>
</html>
