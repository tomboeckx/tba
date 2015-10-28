<?php include '../includes/check_auth.inc'; ?>
<?php include '../includes/cnn_open.inc'; ?>
<?php
$prodid = 0;
$catid = 0;
$row=null;
if (isset($_GET["catid"])) {
	$catid = mysqli_real_escape_string($cnn, $_GET["catid"]);
	$result = mysqli_query($cnn,"SELECT * FROM categories WHERE id=$catid");
	$row = mysqli_fetch_array($result);

}

//if product id is set, this implies delete
if (isset($_GET["prodid"])) {
	$prodid = mysqli_real_escape_string($cnn, $_GET["prodid"]);
	$result = mysqli_query($cnn,"DELETE FROM products WHERE id=$prodid");
}
?>
	
<script>
	function navAddProduct() {
		$.ajax({
			type: 'GET',
			url: "./edit_product.php?catid=<?php echo $catid; ?>",
			processData: false,
			contentType: false,
			success: function(data){
				$("#bodycontent").html(data);
				$("#pageTileHolder").html($("#PageTitle").val());
				
			}
		});
	};
	function navEditProduct(id) {
		$.ajax({
			type: 'GET',
			url: "./edit_product.php?prodid="+id,
			processData: false,
			contentType: false,
			success: function(data){
				$("#bodycontent").html(data);
				$("#pageTileHolder").html($("#PageTitle").val());
			}
		});
	};
	
	
	function navDeleteProduct(id) {
		$.ajax({
			type: 'GET',
			url: "./products.php?prodid="+id+"&catid=<?php echo $catid?>",
			processData: false,
			contentType: false,
			success: function(data){
				$("#bodycontent").html(data);
			}
		});
	};

	
	var prodid = 0;
	
	$(document).ready(function(){
		
		$( "#dialog-deleteprods" ).dialog({
		  resizable: false,
		  height:400,
		  width:600,
		  modal: true,
		  autoOpen : false,
		  buttons: {
			"Product verwijderen": function() {
			  $( this ).dialog( "close" );
			  
			  navDeleteProduct(prodid);
			},
			Annuleer: function() {
			  $( this ).dialog( "close" );
			}
		  }
		});
		
		
	});
	
	function confirmDelete(e, id) {
		if (!e)
		  e = window.event;

		//IE9 & Other Browsers
		if (e.stopPropagation) {
		  e.stopPropagation();
		}
		//IE8 and Lower
		else {
		  e.cancelBubble = true;
		}
	
		prodid = id;
		$("#dialog-deleteprods").dialog("open");
		return false;
	}
</script>


<div id="dialog-deleteprods" title="Product verwijderen?">
  <p>Bent u zeker dat u dit product wil verwijderen ?</p>
</div>

<input type="hidden" id="PageTitle" name="PageTitle" value="Throwback Authentics - Beheer producten in categorie <?php echo $row['name']?>">
<div class="beheerContent">
	<table style="width:90%" cellspacing="0">
		<thead>
		<tr>
			<td width=32><b>Wis</b></td>
			<td width=64></td>
			<td width=300>PRODUCT</td>
			<td width=100>Referentie</td>
			
			<td width=50>EUR</td>
			<td width=50>Sorting</td>
			<td width=50>Designer</td>
			<td width=50>Periode</td>
		</tr>
		</thead>
		<tbody>

		<?php
		$result = mysqli_query($cnn,"SELECT * FROM products WHERE category=$catid ORDER BY sortorder DESC, name ASC");

		while($row = mysqli_fetch_array($result)) {
			$prid = $row['id'];
			$resultphoto = mysqli_query($cnn,"SELECT * FROM productimages WHERE productid=$prid LIMIT 1");
			$rowimage = mysqli_fetch_array($resultphoto);
		
			if ($row['disabled'] == 1) {
				echo "<tr class='tableRow' style='cursor:pointer;background-color:lightgray;' onclick='navEditProduct(".$row['id'].");'>";
			}elseif ($row['reserved'] == 1) {
				echo "<tr class='tableRow' style='cursor:pointer;background-color:#ffaaaa;' onclick='navEditProduct(".$row['id'].");'>";
			}elseif ($row['frontpage'] == 1) {
				echo "<tr class='tableRow' style='cursor:pointer;background-color:yellow;' onclick='navEditProduct(".$row['id'].");'>";
			}
			else {
				echo "<tr class='tableRow' style='cursor:pointer;' onclick='navEditProduct(".$row['id'].");'>";
			}
			?>
			<td class='tableCell' width='50'>
				<a class='actionIcon' onclick='confirmDelete(event, <?php echo $row['id']?>);'><img width='64' heigth='64' src='./images/delete_icon.jpg' /></a>
			</td>
			<td class='tableCell' width='50'>
				<a class='iframe cboxElement' href='javascript:navEditProduct(<?php echo $row['id']?>);'><img border="0" height=64 width=64 src='/fotos/products/thumb/<?php echo $rowimage['image']?>' /></a> 
			</td>
			<td class='tableCell' width='550'>
				<a class='iframe cboxElement' href='javascript:navEditProduct(<?php echo $row['id']?>);'><?php echo $row['name']?></a>
			</td>
			<td class='tableCell' width='100'>
				<?php echo $row['reference'] ?>
			</td>
			<td class='tableCell' width='100'>
				<?php echo $row['price']; ?>
			</td>
			<td class='tableCell' width='50'>
				<?php echo $row['sortorder']; ?>
			</td>
			<td class='tableCell' width='150'>
				<?php echo $row['fabrikant']; ?>
			</td>
			<td class='tableCell' width='150'>
				<?php echo $row['periode']; ?>
			</td>
			</tr>
		<?php
		}
		?>
		</tbody>
	</table>
	<br>
	<br>
	<input type="button" onclick="javascript:navAddProduct();" value="Product toevoegen"> | <input type="button" onclick="javascript:navCats();" value="Naar categorieoverzicht">
</div>
<?php include '../includes/cnn_close.inc'; ?>
