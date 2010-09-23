<!--
/*
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
-->
<?php
require_once "./includes/trunk_config.php";
$sitename = WEBSITE_ADDRESS;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" media="all" type="text/css" href="./css/menu_style.css" />
<title>Send Bulk SMS From Internet to Mobile Phone</title>
<META name="description" content = "Send Bulk SMS From Internet to Mobile Phones">
<META name="keywords" content = "Bulk SMS, Free SMS, SMS, Mobile Technology">
	<link type="text/css" href="./jquery/css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />
	
	<script type = "text/javascript" src ="./presentation/jqueryaddition.js"></script>

	<script type = "text/javascript" src ="./presentation/ajaxReq.js"></script>
	<script type = "text/javascript" src = "./presentation/flogic.js"></script>	<link rel="stylesheet" type="text/css" href="./css/common.css">
	<link rel="stylesheet" type="text/css" href="./css/profile.css">	
	
	<script type="text/javascript" src="./jquery/development-bundle/jquery-1.4.2.js"></script>
	<script type="text/javascript" src="./jquery/development-bundle/ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="./jquery/development-bundle/ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="./jquery/development-bundle/ui/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="./jquery/development-bundle/ui/jquery.ui.button.js"></script>
	<script type="text/javascript" src="./jquery/development-bundle/ui/jquery.ui.position.js"></script>
	<script type="text/javascript" src="./jquery/development-bundle/ui/jquery.ui.dialog.js"></script>
	<script type="text/javascript" src="./jquery/development-bundle/ui/jquery.ui.progressbar.js"></script>
	
	
<SCRIPT LANGUAGE="JavaScript">
function validateDate(){return true}function ValidateTime(d){var b="";var a=/^(\d{1,2}):(\d{2})(:(\d{2}))?(\s?(AM|am|PM|pm))?$/;var c=d.match(a);if(c==null){b="Time is not in a valid format.";return b}hour=c[1];minute=c[2];second=c[4];ampm=c[6];if(second==""){second=null}if(ampm==""){ampm=null}if(hour<0){b="Hour must be between 1 and 12.";return b}if(hour<=12&&ampm==null){b="You must specify AM or PM.";return b}if(minute<0||minute>59){b="Minute must be between 0 and 59.";return b}if(second!=null&&(second<0||second>59)){b="Second must be between 0 and 59.";return b}return b}function TimesNotification(){var b;if(document.form1.date.value=="TODAY"){b="TODAY"}else{if(validateDate()){b=document.form1.displaydatex.value}else{return}}var a=ValidateTime(document.form1.time.value);if(a==""){document.getElementById("dialog-message").style.visibility="";document.getElementById("upperMesg").innerHTML="Your SMS will be sent ";document.getElementById("lowerMesg").innerHTML=b+" at "+document.form1.time.value;$("#dialog").dialog("destroy");$("#dialog-message").dialog({modal:true,buttons:{Ok:function(){$(this).dialog("close")}}})}else{errordialog(a)}};
</script>

<style type="text/css">

body{
font-family: Trebuchet MS, Tahoma, Verdana, Arial, sans-serif;
margin:0;
background: #f6f6f6;
padding:0;
}

/* .ui-progressbar-value { background-image: url(jquery/development-bundle/demos/images/pbar-ani.gif); } */

#formin{
margin-top: 0px;
background: url(./images/bgc2.gif) left top repeat-x;
border-bottom:1px solid #c3d9ff;	border-left:1px solid #d0e1ce;	
border-right:1px solid #c3d9ff;	
width: auto;
padding:30px 30px;
/*margin-right: 10px;*/
}


b{font-size: 110%;}

#topsection{
height: 50px; /*Height of top section*/
background: url(./images/header_back.jpg) left repeat-x;
font-size: 30px;
}

#topsection h1{
margin: 0;
padding-top: 15px;
}

#contentwrapper{
float: left;
width: 100%;
}

#contentcolumn{
margin: 0 30% 0 30%; /*Margins for content column. Should be "0 RightColumnWidth 0 LeftColumnWidth*/
}

#leftcolumn{
float: left;
width: 30%; /*Width of left column*/
margin-left: -100%;
}

#rightcolumn{
float: left;
width: 30%; /*Width of right column*/
margin-left: -30%; /*Set left marginto -(RightColumnWidth)*/
}


.innertube{
margin: 10px; /*Margins for inner DIV inside each column (to provide padding)*/
margin-top: 0;
}

#nav_bar{

}

#searchbar{
margin-top: 15px;
margin-bottom: 15px;
text-align: center;
padding:0 1em 0px 0;
white-space:nowrap;

}
</style>

</head>

<body onLoad = "getAccountInfo();">



<div id = "header"><?php include "./includes/top_header.php" ?></div>
<div id = "pre_main_body">

<div id="maincontainer">

<div id="topsection">
<div class="innertube">
<?php
include("./includes/logo.php");
?>
<img src = "./images/yourworld.gif">

</div>

</div><!-- end of topsection -->


<div id="contentwrapper">
<div id="contentcolumn">
<div class="innertube">

<div id="middle_panel">

<div id = "server_status">


<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
Works on all browser except in I.E where you will have to tell me if it works fine</p>
			</div>

		</div>
 
</div><!-- end serverstatus -->

<div id = "server_status2">

</div><!-- end server_status2-->


    </div><!-- end middle panel-->


</div><!-- end of innertube -->

</div><!-- end of contentcolum -->

</div><!-- end og contentwrapper -->

<div id="leftcolumn">
<div class="innertube"><div id="left_panel">
    <div class = "sublist" style = "margin-left: 15px;"><table><tr><td><img src = "./images/trunkons/email.png"></td><td><h5><a href= "" onClick = "getSMSForm(); return false;">Send SMS</a></h5></td></tr></table></div><!-- end send sms-->
     <div class = "sublist" style = "margin-left: 15px;"><table><tr><td><img src = "./images/trunkons/refresh.png"></td><td><h5><a href= "" onClick = "getAccountInfo(); return false;">Refresh Account Info</a></h5></td></tr></table></div><!-- end accountinfo. onclick display in the div acctInformation-->

<div id = "transferingcred" style = "margin-left: 15px;"><table><tr><td><img src = "./images/trunkons/billing.png"></td><td><h5><a href= "" onClick = "getTransferSMSForm(); return false;">Transfer Credits</a></h5></td></tr></table></div> <!-- end upload contact from friendTool-->   

<div id = "uploadCSV" style = "margin-left: 15px;"><table><tr><td><img src = "./images/trunkons/upload.png"></td><td><h5><a href= "" onClick = "getCSV_form(); return false;" title = "Upload the phonebook file exported by a third party Software">Upload Contacts CSV</a></h5></td></tr></table></div><!-- end uploadCSV-->

<div id = "quee" style = "margin-left: 15px;"><table><tr><td><img src = "./images/trunkons/administrative-docs.png"></td><td><h5><a href= "" onClick = "getquee(); return false;" title = "Click me to see the SMS you scheduled and what happened to it">Queued Messages</a></h5></td></tr></table></div><!-- end quee-->

<div id = "log" style = "margin-left: 15px;"><table><tr><td><img src = "./images/trunkons/administrative-docs.png"></td><td><h5><a href= "" onClick = "window.open('logic/SMSlog.php', 'dict_win', 'width=650, height=400, resizable=yes,scrollbars=yes');; return false;" title = "Click me to see what happened to the SMS you sent">SMS Log</a></h5></td></tr></table></div><!-- end quee-->

    <div id = "phoneBooks">
    </div><!-- end phoneBooks-->
    
    <div id = "hidendialogs" style= "visibility: hidden;">
<div id="dialog-message" title="<?php echo $sitename ?>" style= "visibility: hidden;">
	<p>
		<span class="ui-icon ui-icon-circle-check" style="float:left; margin:0 7px 50px 0;"></span>
	</p>
	
	<div id = "upperMesg"></div>
	
		<p>
		<div id = "lowerMesg"></div>
		</p>
</div>

<div id = "progress" title = "<?php echo $sitename ?>" style = "visibility: hidden;">
<div id = "progress_upperMesg"></div>

<div id="progressbar"></div>

</div><!-- end progress -->

<div id="dialog" title="<?php echo $sitename ?>">

		</div><!-- end dialog -->
			


</div><!--end hidden dialogs-->


    
    </div><!-- end left_panel-->
</div><!-- end of innertube -->

</div><!-- end of leftcolum -->

<div id="rightcolumn">
<div class="innertube">

<div id="right_panel">

    <div id = "acctInformation"></div><!-- end acctInformation-->

    <div id = "buy" style = "margin-left: 30px;"><table><tr><td><img src = "./images/trunkons/bank.png"></td><td><h5><a href= "" onClick = "getPaymentType(); return false;">Buy/Recharge SMS</a></h5></td></tr></table></div><!-- end buy-->
    
            <div id = "addcontact" style = "margin-left: 30px;"><table><tr><td><img src = "./images/trunkons/plus.png"></td><td><h5><a href= "" onClick = "getContactForm(); return false;">Add Contacts</a></h5></td></tr></table></div><!-- end addcontact-->
    <div id = "downloads" style = "margin-left: 30px;"><table><tr><td><img src = "./images/trunkons/lightbulb.png"></td><td><h5><a href= "" onClick = "updateProgressbar('Sending in Progress', 80,0);return false;" title = "coming soon">Downloads</a></h5></td></tr></table></div><!-- end buy-->
    <div id = "phb" style = "margin-left: 30px;"><table><tr><td><img src = "./images/trunkons/address.png"></td><td><h5><a href= "" onClick = "getphoneBook(); return false;" title = "Click me to see your phone book">My PhoneBook</a></h5></td></tr></table></div><!-- end phoneBook-->
    
    
    
    </div> <!-- end right panel-->
    
</div><!-- end of innertube -->
</div><!-- end of rightcolum -->
</div><!-- end of maincontainer -->


<div id="footer"><?php include("./includes/footer.php") ?></div> <!-- *DONT* REMOVE THE COPYLEFT NOTICE -->
</body>
</html>
