<?php include '../includes/check_auth.inc'; ?>
<?php include '../includes/cnn_open.inc'; ?>
<?php 
	
	//infotext
	$result = mysqli_query($cnn,"SELECT value FROM settings WHERE variable='infotext'");
	$row = mysqli_fetch_array($result);
	$infotext = $row["value"];

	//page 1
	$result = mysqli_query($cnn,"SELECT value FROM settings WHERE variable='page1title'");
	$row = mysqli_fetch_array($result);
	$page1title = $row["value"];

	$result = mysqli_query($cnn,"SELECT value FROM settings WHERE variable='page1subheader'");
	$row = mysqli_fetch_array($result);
	$page1subheader = $row["value"];

	$result = mysqli_query($cnn,"SELECT value FROM settings WHERE variable='page1body'");
	$row = mysqli_fetch_array($result);
	$page1body = $row["value"];
	//page2
	$result = mysqli_query($cnn,"SELECT value FROM settings WHERE variable='page2title'");
	$row = mysqli_fetch_array($result);
	$page2title = $row["value"];

	$result = mysqli_query($cnn,"SELECT value FROM settings WHERE variable='page2subheader'");
	$row = mysqli_fetch_array($result);
	$page2subheader = $row["value"];

	$result = mysqli_query($cnn,"SELECT value FROM settings WHERE variable='page2body'");
	$row = mysqli_fetch_array($result);
	$page2body = $row["value"];

	//footer
	$result = mysqli_query($cnn,"SELECT value FROM settings WHERE variable='footertext'");
	$row = mysqli_fetch_array($result);
	$footertext = $row["value"];

	$result = mysqli_query($cnn,"SELECT value FROM settings WHERE variable='footerheader'");
	$row = mysqli_fetch_array($result);
	$footerheader = $row["value"];
	

	if(isset($_POST["save"]))
	{
	
		$infotext = $_POST['text_info'];
		$page1title = $_POST['text_page1title'];
		$page1subheader = $_POST['text_page1subheader'];
		$page1body = $_POST['text_page1body'];
		$page2title = $_POST['text_page2title'];
		$page2subheader = $_POST['text_page2subheader'];
		$page2body = $_POST['text_page2body'];
		$footertext = $_POST['text_footer'];
		$footerheader = $_POST['text_footerheader'];

		$infotext = !empty($infotext) ? $infotext : NULL;
		$page1title = !empty($page1title) ? $page1title : NULL;
		$page1subheader = !empty($page1subheader) ? $page1subheader : NULL;
		$page1body = !empty($page1body) ? $page1body : NULL;
		$page2title = !empty($page2title) ? $page2title : NULL;
		$page2subheader = !empty($page2subheader) ? $page2subheader : NULL;
		$page2body = !empty($page2body) ? $page2body : NULL;
		$footertext = !empty($footertext) ? $footertext : NULL;
		$footerheader = !empty($footerheader) ? $footerheader : NULL;

		$sql = 	"UPDATE settings ".
				"SET value='$infotext' ".
				"WHERE variable='infotext'";	   
		$retval = mysqli_query(  $cnn , $sql );
		
		$sql = 	"UPDATE settings ".
				"SET value='$page1title' ".
				"WHERE variable='page1title'";	   
		$retval = mysqli_query(  $cnn , $sql );
		$sql = 	"UPDATE settings ".
				"SET value='$page1subheader' ".
				"WHERE variable='page1subheader'";	   
		$retval = mysqli_query(  $cnn , $sql );
		$sql = 	"UPDATE settings ".
				"SET value='$page1body' ".
				"WHERE variable='page1body'";	   
		$retval = mysqli_query(  $cnn , $sql );

		$sql = 	"UPDATE settings ".
				"SET value='$page2title' ".
				"WHERE variable='page2title'";	   
		$retval = mysqli_query(  $cnn , $sql );
		$sql = 	"UPDATE settings ".
				"SET value='$page2subheader' ".
				"WHERE variable='page2subheader'";	   
		$retval = mysqli_query(  $cnn , $sql );
		$sql = 	"UPDATE settings ".
				"SET value='$page2body' ".
				"WHERE variable='page2body'";	   
		$retval = mysqli_query(  $cnn , $sql );
		
		$sql = 	"UPDATE settings ".
				"SET value='$footertext' ".
				"WHERE variable='footertext'";	   
		$retval = mysqli_query(  $cnn , $sql );

		$sql = 	"UPDATE settings ".
				"SET value='$footerheader' ".
				"WHERE variable='footerheader'";	   
		$retval = mysqli_query(  $cnn , $sql );

		echo '<h1>teksten opgeslagen!</h1>' ;
	}
	else
	{
	?>

	<!-- CKEditor -->
	<script src="../js/ckeditor/ckeditor.js" type="text/javascript"></script>
	

	<style>
		.leftCol {
			background-color:lightgrey;
		}

	</style>
	<script>
		$(function() {
			CKEDITOR.replace('text_info', {height: 700});
			CKEDITOR.replace('text_footer', {height: 200});
			CKEDITOR.replace('text_page1body', {height: 700});
			CKEDITOR.replace('text_page2body', {height: 700});
		});
		
		function CKupdate(){
			for ( instance in CKEDITOR.instances ) {
				CKEDITOR.instances[instance].updateElement();
				}
		}
		
		function navSaveText() {
			CKupdate();
			var formElement = document.getElementById("editForm");
			var str = $( "#editForm" ).serialize();
			$.ajax({
				type: "post",
				url: "./text.php",
				data: str+"&save=save",
				success: function(data){
					$("#bodycontent").html(data);
				}
			});
		};

		
	</script>

	
<input type="hidden" id="PageTitle" name="PageTitle" value="Throwback Authentics - Site teksten beheer"> 
<div class="beheerContent">
<form id="editForm" method="post" >
<table width="100%" border="0" cellspacing="1" cellpadding="2">
	<tr>
		<td class="leftCol" valign='top'>
			Hoofpagina informatie<br/>
			<textarea class="text_info" name="text_info" id="text_info"><?php echo $infotext; ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="leftCol">
			Titel voettekst<br/>
			<input style='width:300px;' name="text_footerheader" type="text" id="text_footerheader" value="<?php echo $footerheader; ?>">
		</td>
	</tr>
	<tr>
		<td class="leftCol">
			Voettekst<br/>
			<textarea class="text_footer" name="text_footer" id="text_footer"><?php echo $footertext; ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="leftCol">
			Informatiepagina titel<br/>
			<input style='width:300px;' name="text_page1title" type="text" id="text_page1title" value="<?php echo $page1title; ?>">
		</td>
	</tr>
	<tr>
		<td class="leftCol" width="15%" valign='top'>
			Informatiepagina subtitel<br/>
			<input style='width:300px;' name="text_page1subheader" type="text" id="text_page1subheader" value="<?php echo $page1subheader; ?>">
		</td>
	</tr>
	<tr>
		<td class="leftCol" width="15%" valign='top'>
			Informatiepagina tekst<br/>
			<textarea class="text_info" name="text_page1body" id="text_page1body"><?php echo $page1body; ?></textarea>
		</td>
	</tr>
	<tr>
		<td class="leftCol">
			Voorwaarden pagina titel<br/>
			<input style='width:300px;' name="text_page2title" type="text" id="text_page2title" value="<?php echo $page2title; ?>">
		</td>
	</tr>
	<tr>
		<td class="leftCol" width="15%" valign='top'>
			Voorwaarden pagina subtitel<br/>
			<input style='width:300px;' name="text_page2subheader" type="text" id="text_page2subheader" value="<?php echo $page2subheader; ?>">
		</td>
	</tr>
	<tr>
		<td class="leftCol" width="15%" valign='top'>
			Voorwaarden pagina tekst<br/>
			<textarea class="text_info" name="text_page2body" id="text_page2body"><?php echo $page2body; ?></textarea>
		</td>
	</tr>
	<tr>
		<td>
			<br/>
			<input class="buttonAdmin" name="save" type="button" onclick="navSaveText();" id="add" value="Opslaan">
			<br/>
		</td>
	</tr>
</table>
</form>
</div>
<br/>
<?php
}
?>
<?php include '../includes/cnn_close.inc'; ?>
