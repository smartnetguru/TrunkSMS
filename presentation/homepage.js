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
<!--
var cleared = false;
function authenticateUser(form){
var phone = form.username.value;
var password = form.password.value;
var submit = form.submit.value;
authenticate(phone,password, submit);
}

function submitForgot(){
if(cleared && document.forgot.mynumber.value.length != 0){
	if(confirm("Send my password to my mail")){
	var phoneNo = document.forgot.mynumber.value;
	var submit = document.forgot.mailPass.value;
	sendPasswordToMail(phoneNo, submit);
	}
}else{
alert("Please Enter your Phone Number");
}
}

function getAcctAcctForm(){
getActivationForm();
}
function submitActivateForm(){
if(confirm("This will Acctivate The Account")){
var submitAct = document.activate.submitAct.value;
var phoneCode = document.activate.phoneCode.value;
var EmailCode = document.activate.EmailCode.value;
var phoneNo = document.activate.phoneNo.value;
var password = document.activate.password.value;
sendActivationFormData(submitAct, phoneCode, EmailCode, phoneNo, password);
}else{
alert("Acctivation cancelled");
}

}

function submitForm(){


if(document.form1.phone.value.length == 11){

	if(document.form1.password.value == document.form1.password2.value){
	if(confirm("This will submit the registration data")){
	var submit = document.form1.submitReg.value;
	var oname = document.form1.oname.value;
	var phone = document.form1.phone.value;
	var address = document.form1.address.value;
	var email = document.form1.email.value;
	var password = document.form1.password.value;
	var password2 = document.form1.password2.value;
	var country = document.form1.country.value;
	var how = document.form1.how.value;
	ajaxSendRegData(submit, oname, phone, address, email, password, password2, country, how);
	}else{
	alert("Cancelled");
	}
	
	}else{
	alert("Password Does not match");
	}
}else{
alert("Invalid phone Number. Must be Eleven (11) digit in length");
}

}


function clearBox(txt){
if(!cleared){
txt.value = ""
cleared = true;
}

}//end clearBox
-->
