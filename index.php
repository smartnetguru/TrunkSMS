<?php
session_start();

if(strlen($_SESSION['phoneNo']) > 0){
//profile page
//require ('../xajax.inc.php');
include ("./main/index.php");
}else{
session_destroy();
//homepage
include "./home/index.php";
}

?>
