<?php include '../includes/check_auth.inc'; ?>
<?php include '../includes/cnn_open.inc'; ?>
<?php
$catid = 0;
$prodid = 0;
$row=null;

if (isset($_GET["catid"])) {
	$catid = mysqli_real_escape_string($cnn, $_GET["catid"]);
}

if (isset($_GET["imgid"])) { //imgid set means delete product image
	$imgid = mysqli_real_escape_string($cnn, $_GET["imgid"]);
	$result = mysqli_query($cnn,"DELETE FROM productimages WHERE id=$imgid");	
}

if (isset($_GET["prodid"])) {
	$prodid = mysqli_real_escape_string($cnn, $_GET["prodid"]);
	$result = mysqli_query($cnn,"SELECT * FROM products WHERE id=$prodid");
	$row = mysqli_fetch_array($result);
	if($prodid != 0) {
		$catid = $row["category"];
	}
	
}
if(isset($_GET['save'])) //save product
{
	$prod_id = mysqli_real_escape_string($cnn, $_GET['prod_id']);
	$prod_name = mysqli_real_escape_string($cnn, $_GET['prod_name']);
	$prod_description = mysqli_real_escape_string($cnn, $_GET['prod_description']);
	$prod_price = mysqli_real_escape_string($cnn, $_GET['prod_price']);
	$prod_reduction = mysqli_real_escape_string($cnn, $_GET['prod_reduction']);
	$prod_frontpage = mysqli_real_escape_string($cnn, $_GET['prod_frontpage']);
	$prod_onsale = mysqli_real_escape_string($cnn, $_GET['prod_onsale']);
	$prod_category = mysqli_real_escape_string($cnn, $_GET['prod_category']);
	$prod_periode = mysqli_real_escape_string($cnn, $_GET['prod_periode']);
	$prod_fabrikant = mysqli_real_escape_string($cnn, $_GET['prod_fabrikant']);
	$prod_reference = mysqli_real_escape_string($cnn, $_GET['prod_reference']);
	$prod_reserved = mysqli_real_escape_string($cnn, $_GET['prod_reserved']);
	$prod_disabled = mysqli_real_escape_string($cnn, $_GET['prod_disabled']);
	$prod_sortorder = mysqli_real_escape_string($cnn, $_GET['prod_sortorder']);

	$prod_name = !empty($prod_name) ? $prod_name : NULL;
	$prod_description = !empty($prod_description) ? $prod_description : NULL;
	$prod_price = !empty($prod_price) ? $prod_price : "NULL";
	$prod_reduction = !empty($prod_reduction) ? $prod_reduction : "NULL";
	$prod_frontpage = $prod_frontpage == 'on' ? 1 : 0;
	$prod_onsale = $prod_onsale == 'on' ? 1 : 0;
	$prod_periode = !empty($prod_periode) ? $prod_periode : NULL;
	$prod_fabrikant = !empty($prod_fabrikant) ? $prod_fabrikant : NULL;
	$prod_reference = !empty($prod_reference) ? $prod_reference : NULL;
	$prod_reserved = $prod_reserved == 'on' ? 1 : 0;
	$prod_disabled = $prod_disabled == 'on' ? 1 : 0;
	$prod_sortorder = !empty($prod_sortorder) ? $prod_sortorder : 0;
	
	if($prod_id == 0)
	{
		$sql = 	"INSERT INTO products ".
				"(name,description,price,reduction,frontpage,onsale,category,periode,fabrikant,reference,reserved,disabled,sortorder) ".
				"VALUES('$prod_name','$prod_description',$prod_price,$prod_reduction,$prod_frontpage,$prod_onsale,$prod_category,".
				"'$prod_periode','$prod_fabrikant','$prod_reference',$prod_reserved,$prod_disabled,$prod_sortorder)";
	}
	else
	{	   
		$sql = 	"UPDATE products ".
				"SET name='$prod_name',description='$prod_description',price=$prod_price, ".
				"reduction=$prod_reduction,frontpage=$prod_frontpage,onsale=$prod_onsale, category=$prod_category, periode='$prod_periode', fabrikant='$prod_fabrikant', reference='$prod_reference', reserved=$prod_reserved, disabled=$prod_disabled, sortorder=$prod_sortorder ".
				"WHERE id=$prodid";	   
	}	   
	$retval = mysqli_query(  $cnn , $sql );
	if(! $retval ) {
	  die('Could not enter data: ' . mysql_error());
	}
	else {
		header( 'Location: products.php?catid='.$catid ) ;
	}
}
else
{
?>
<link href="css/imageupload.css" rel="stylesheet" type="text/css">

<script src="../js/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../js/tba/imageupload.js" type="text/javascript" ></script>
<script src="../js/tba/edit_product.js" type="text/javascript" ></script>
<?php 
	if($prodid == 0)	{
	echo '<input type="hidden" id="PageTitle" name="PageTitle" value="Throwback Authentics - Product toevoegen">';
	}
	else {
	echo '<input type="hidden" id="PageTitle" name="PageTitle" value="Throwback Authentics - Product bewerken">';
	}
?>
	
	
<div id="dialog-confirmpicture" title="Foto verwijderen?">
  <p id="deleteFotoHolder"></p>
  <p>Bent u zeker dat u deze foto wil verwijderen ?</p>
</div>

<div id="dialog-uploadFromSPO" title="Foto opladen van SharePoint">
	<div id="content-uploadFromSPO" />
</div>



<form id="editForm" method="post" onsubmit="navSaveProduct();">
<table width="90%" border="0" cellspacing="1" cellpadding="2">
	<tr>
		<td width="15%">Productcategorie</td>
		<td>
		<?php
			$resultcat = mysqli_query( $cnn, "SELECT * FROM categories"); 
			 echo "<select name='prod_category'>"; 
			 while($rowcat = mysqli_fetch_array($resultcat)) 
			 { 
				if ($rowcat['id'] == $catid) {
				echo "<option value = '".$rowcat['id']."' selected>".$rowcat['name']."</option>"; 
				}
				else
				{
				echo "<option value = '".$rowcat['id']."'>".$rowcat['name']."</option>"; 
				}
			 }
			 echo "</select>"; 
		
		?>
		</td>
	</tr>
	<tr>
		<td width="15%">Naam product</td>
		<td>
			<input name="prod_name" type="text" id="prod_name" value="<?php echo $row['name']?>">
		</td>
	</tr>
	<tr>
		<td width="15%">Product# / referentie</td>
		<td>
			<input name="prod_reference" type="text" id="prod_reference" value="<?php echo $row['reference']?>">
		</td>
	</tr>
	<tr>
		<td width="15%" valign="top">Productomschrijving</td>
		<td><textarea class="" name="prod_description" id="prod_description"><?php echo $row['description']?></textarea></td>
	</tr>
	<tr>
		<td width="15%">Prijs (EUR)</td>
		<td><input name="prod_price" type="number" id="prod_price" value="<?php echo $row['price']?>"></td>
	</tr>
	<tr>
		<td width="15%">Frontpagina ?</td>
		<?php 
		if ($row['frontpage'] == 1) {
		?>
		<td><input name="prod_frontpage" type="checkbox" id="prod_frontpage" checked></td>
		<?php
		}
		else
		{
		?>
		<td><input name="prod_frontpage" type="checkbox" id="prod_frontpage"></td>
		<?php
		}
		?>
	</tr>
	<tr>
		<td width="15%">Gereserveerd ?</td>
		<?php 
		if ($row['reserved'] == 1) {
		?>
		<td><input name="prod_reserved" type="checkbox" id="prod_reserved" checked></td>
		<?php
		}
		else
		{
		?>
		<td><input name="prod_reserved" type="checkbox" id="prod_reserved"></td>
		<?php
		}
		?>
	</tr>
	<tr>
		<td width="15%">Uitgeschakeld ?</td>
		<?php 
		if ($row['disabled'] == 1) {
		?>
		<td><input name="prod_disabled" type="checkbox" id="prod_disabled" checked></td>
		<?php
		}
		else
		{
		?>
		<td><input name="prod_disabled" type="checkbox" id="prod_disabled"></td>
		<?php
		}
		?>
	</tr>
	<tr>
		<td width="15%">Sorteervolgorde</td>
		<td>
			<input name="prod_sortorder" type="text" id="prod_sortorder" value="<?php echo $row['sortorder']?>">
		</td>
	</tr>
	<tr>
		<td width="15%">Periode</td>
		<td>
			<input name="prod_periode" type="text" id="prod_periode" value="<?php echo $row['periode']?>">
		</td>
	</tr>
	<tr>
		<td width="15%">Designer</td>
		<td>
			<input name="prod_fabrikant" type="text" id="prod_fabrikant" value="<?php echo $row['fabrikant']?>">
		</td>
	</tr>
	<tr>
		<td width="15%" valign="top">Foto(s)</td>
		<td>
			<div id="savedpics">
			<input name="prod_id" type="hidden" id="prod_id" value="<?php echo $prodid?>">
			<?php
			if($prodid != 0)
			{
				echo "<table>";
				echo "<tr>";
				$resultpictures = mysqli_query($cnn,"SELECT * FROM productimages WHERE productid=$prodid");
				while($rowpic = mysqli_fetch_array($resultpictures)) 
				{ 
					echo "<td id='foto".$rowpic['id']."'>";
					echo "<img src='/fotos/products/thumb/".$rowpic['image']."' />"; 
					echo "</td>";
				}
				echo "</tr>";
				echo "<tr>";
				$resultpictures = mysqli_query($cnn,"SELECT * FROM productimages WHERE productid=$prodid");
				while($rowpic = mysqli_fetch_array($resultpictures)) 
				{ 
					echo "<td style='text-align:center;'>";
					echo "<a onclick='confirmDelete(".$rowpic['id'].");'><img width='48' heigth='48' src='./images/delete_icon.jpg' /></a>";
					echo "</td>";
				}
				echo "</tr>";
				echo "</table>";
			}
			?>
			</div>
		</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<table width="100%">
				<tr>
					<td>
						<input type="file" id="imageInput" name="image_file" onchange="handleFiles(this.files)">
						<button id="fileSelect">Foto opladen</button> &nbsp; <input type="button" onclick="openSPODialog();" value="Foto(s) opladen van SharePoint" style="width:400px";>
						<br>
						<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
					</td>
				</tr>
				<tr>
					<td>
						<div id="progressbox" style="display:none;"><div id="progressbar"></div><div id="statustxt">0%</div></div>
					</td>
				</tr>
			</table>
			<input name="prod_picture" type="hidden" id="prod_picture" value="<?php echo $row['picture']?>">
		</td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td></td>
		<td><hr></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td ></td>
		<td>
			<input name="save" type="button" onclick="navSaveProduct(<?php echo $catid;?>);" id="add" value="Opslaan">
		</td>
	</tr>
</table>
</form>

<?php
}
?>
<?php include '../includes/cnn_close.inc'; ?>
