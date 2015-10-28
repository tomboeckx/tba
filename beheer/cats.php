<?php include '../includes/check_auth.inc'; ?>
<?php include '../includes/cnn_open.inc'; ?>
<?php 

if (isset($_GET["catid"])) {
	$catid = mysqli_real_escape_string($cnn, $_GET["catid"]);
	$result = mysqli_query($cnn,"DELETE FROM categories WHERE id=$catid");
}

?>
<script src="../js/tba/cats.js" type="text/javascript" ></script>
<input type="hidden" id="PageTitle" name="PageTitle" value="Throwback Authentics - Categorie beheer">

<div id="dialog-confirm" title="Categorie verwijderen?">
  <p>Bent u zeker dat u deze categorie wil verwijderen ? Indien u een categorie verwijderd zullen automatisch ook alle producten in deze catagorie verwijderd worden.</p>
</div>
<div>
	<table cellspacing='0'>
		<thead>
			<tr>
				<td width="64">Foto</td>
				<td width="400">Categorie titel</td>
				<td width="300">Bewerk / Verwijder</td>
				<td width="50">Sortering</td>
			</tr>
		</thead>
		<tbody>
		<?php
			$result = mysqli_query($cnn,"SELECT * FROM categories ORDER BY sortorder ASC, name ASC");
			while($row = mysqli_fetch_array($result)) {
			?>
			<tr>
				<td class='tableCell'>
					<a href='javascript:navGotoCat("<?php echo $row['id']?>");'><img border="0" width='64' heigth='64' src='../fotos/categories/icon64/<?php echo $row['picture']?>' /></a>
				</td>
				<td class='tableCell' width='400'>
					<a href='javascript:navGotoCat("<?php echo $row['id']?>");'><span class='tableRow'><?php echo $row['name']?></span></a>
				</td>
				<td class='tableCell'>
					<a class="actionIcon" onclick='javascript:navEditCat("<?php echo $row['id']?>");'><img style='border:0px;' width='64' heigth='64' src='./images/edit_icon.jpg' /></a>
					<a class="actionIcon" onclick='confirmDelete("<?php echo $row['id']?>");'><img width='64' heigth='64' src='./images/delete_icon.jpg' /></a>
				</td>
				<td class='tableCell'>
					<?php echo $row['sortorder']?>
				</td>
			</tr>
			<?php
			}
			?>
		</tbody>
	</table>
	<br>
	<input type="button" onclick="javascript:navAddCat();" value="Categorie toevoegen">
</div>
<?php include '../includes/cnn_close.inc'; ?>
