<?php
session_start(); 

if($_SESSION['myusername'] != ""){
  header("location:main.php");
}
?>
<html>
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=10">
		<link rel="stylesheet" href="css/flat.css" />
		<title>Throwback Authentics - Administrator login</title>
	</head>
	<body>
		<!-- top bar-->
		<div id="menuWrapper">
			<div id="menu">
			<h1>Throwback Authentics - Administrator login</h1>
			</div>
		</div>
		<!-- end top bar-->
		<!-- content -->
		<div id="content"> 

			<!-- actual content -->
			<div id="bodycontent" style="width:90%;color: black;">
			<form name="form1" id="editForm" method="post" action="checklogin.php">
				<table width="400px" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" style="margin-top:50px;padding-left:200px;">
				  <tr>
					<td width="100">Username</td>
					<td width="6">:</td>
					<td width="300"><input class="logininput" name="myusername" type="text" id="myusername" autofocus></td>
				  </tr>
				  <tr>
					<td>Password</td>
					<td>:</td>
					<td><input class="logininput" name="mypassword" type="password" id="mypassword"></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><input type="submit" name="Submit" value="Login"></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><p style="font-size:x-small;">Developed by <a href="http://www.b-dev.net">b-dev.net</a>.<br>Click <a href="http://www.b-dev.net/contact">here</a> for support.</p></td>
				  </tr>
				</table>
			</form>

			</div>
			<!-- actual content -->

		</div>
		<!-- end content wrapper-->
	</body>
</html>