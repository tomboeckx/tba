<?php include '../includes/cnn_open.inc'; ?>
<?php
$catid = 0;
$row=null;

if (isset($_GET["catid"])) {
	$catid = mysqli_real_escape_string($cnn, $_GET["catid"]);
	$result = mysqli_query($cnn,"SELECT * FROM categories WHERE id=$catid");
	$row = mysqli_fetch_array($result);
}



if(isset($_GET['cat_name']))
{
 	$cat_name = mysqli_real_escape_string($cnn, $_GET['cat_name']);
	$cat_subheader = mysqli_real_escape_string($cnn, $_GET['cat_subheader']);
	$cat_description = mysqli_real_escape_string($cnn, $_GET['cat_description']);
	$cat_picture = mysqli_real_escape_string($cnn, $_GET['cat_picture']);
	$cat_sold = mysqli_real_escape_string($cnn, $_GET['cat_sold']);
	$cat_sortorder = mysqli_real_escape_string($cnn, $_GET['cat_sortorder']);
	
	$cat_name = !empty($cat_name) ? $cat_name : NULL;
	$cat_subheader = !empty($cat_subheader) ? $cat_subheader : NULL;
	$cat_description = !empty($cat_description) ? $cat_description : NULL;
	$cat_picture = !empty($cat_picture) ? $cat_picture : NULL;
	$cat_sortorder = !empty($cat_sortorder) ? $cat_sortorder : 0;
	
	$cat_sold = $cat_sold == 'on' ? 1 : 0;

	if($catid == 0)
	{
		$sql = "INSERT INTO categories ".
			   "(name,subheader, description, picture, sold, sortorder)".
			   "VALUES('$cat_name','$cat_subheader','$cat_description','$cat_picture',$cat_sold, $cat_sortorder)";
	}
	else
	{	   
		$sql = 	"UPDATE categories ".
				"SET name='$cat_name',subheader='$cat_subheader',description='$cat_description',picture='$cat_picture', sold=$cat_sold, sortorder=$cat_sortorder ".
				"WHERE id=$catid";	   
	}	   
	$retval = mysqli_query(  $cnn , $sql );
	if(! $retval )
	{
	  die('Could not enter data: ' . mysql_error());
	}
	mysqli_close($cnn);
	header( 'Location: cats.php' ) ;

}
else
{
 
 ?>
<link href="css/imageupload.css" rel="stylesheet" type="text/css">

<script src="../js/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../js/tba/imageupload.js" type="text/javascript" ></script>
<script src="../js/tba/edit_cat.js" type="text/javascript" ></script>

<?php 
	if($catid == 0)	{
	echo '<input type="hidden" id="PageTitle" name="PageTitle" value="Throwback Authentics - Categorie toevoegen">';
	}
	else {
	echo '<input type="hidden" id="PageTitle" name="PageTitle" value="Throwback Authentics - Categorie bewerken">';
	}
?>

<div style='background-color:#eee;'>
<form id="editForm" method="post" onsubmit="navSaveCat();">
<table width="100%" border="0" cellspacing="1" cellpadding="2" >
	<tr>
		<td width="66%" valign="top">
			<b>Naam categorie</b><br/>
			<input style='width:300px;' name="cat_name" type="text" id="cat_name" value="<?php echo $row['name']?>"><br/>
			<b>Subtitel</b><br/>
			<input style='width:300px;' name="cat_subheader" type="text" id="cat_subheader" value="<?php echo $row['subheader']?>">
		</td>
		<td align='right'>
			<div id="output">
				<img src="../fotos/categories/icon100/<?php echo $row['picture']?>" alt="Nog niet ingesteld">
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><b>Beschrijving<b><br><textarea class="" name="cat_description" id="cat_description"><?php echo $row['description']?></textarea></td>
	</tr>
	<tr>
		<td colspan="2">Categorie "Verkochte producten" ?<br/>
		<?php 
		if ($row['sold'] == 1) {
		?>
		<input name="cat_sold" type="checkbox" id="cat_sold" checked>
		<?php
		}
		else
		{
		?>
		<input name="cat_sold" type="checkbox" id="cat_sold">
		<?php
		}
		?>
		</td>
	</tr>
	<tr>
		<td colspan="2"><b>Sorteervolgorde<b><br><input style='width:300px;' name="cat_sortorder" type="text" id="cat_sortorder" value="<?php echo $row['sortorder']?>"></td>
	</tr>
	<tr>
		<td>
		</td>
	</tr>
	<tr>
		<td>
			<br>
			<b>Foto opladen</b><br/>
			<input type="file" id="imageInput" name="image_file" onchange="handleFiles(this.files)">
			<button id="fileSelect">Foto opladen</button>
			<br>
			<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
			<input name="cat_picture" type="hidden" id="cat_picture" value="<?php echo $row['picture']?>">
		</td>
	</tr>
	<tr>
		<td>
			<div id="progressbox" style="display:none;">
				<div id="progressbar"></div>
				<div id="statustxt">0%</div>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<hr>
		</td>
	</tr>
	<tr>
		<td>
			<input name="save" type="button" id="add" value="Opslaan" onclick="navSaveCat(<?php echo $catid;?>);">
		</td>
	</tr>
</table>
</form>

</div>
<?php
}
?>
<?php include '../includes/cnn_close.inc'; ?>

