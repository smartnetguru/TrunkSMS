<html>
<head>
<title>Generated MD5 password</title>
</head>

<body>
<?php
if(isset($_REQUEST['submit'],$_REQUEST['passwd']) && !empty($_REQUEST['passwd'])){

$passwd = md5($_REQUEST['passwd']);
echo "here is your Encrypted Password: " . $passwd;

}else{
echo "Enter your password to generate an encrypted version<br/>";
}
?>
<form method = "post">
<input type = "password" name = "passwd">

<input type = "submit" name = "submit">

</form>


</body>

</html>
