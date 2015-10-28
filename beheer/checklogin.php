<?php
session_start();
$host="localhost"; // Host name
$username="throwbac_db"; // Mysql username
$password="eM3CtdLG,ua["; // Mysql password
$db_name="throwbac_store"; // Database name
$tbl_name="members"; // Table name

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

// Define $myusername and $mypassword
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);

if($count==1){
	$_SESSION['myusername']=$myusername;
	$_SESSION['mypassword']=$mypassword;
	header("location:main.php");
exit;
}
else {
	echo "<h1>Wrong Username or Password</h1><br /><a href='index.php'>Try again</a>";
}

?>


