<?php include '../includes/check_auth.inc'; ?>
<?php include '../includes/cnn_open.inc'; ?>

<input type="hidden" id="PageTitle" name="PageTitle" value="Throwback Authentics - Order historiek"> 
<div>
	<H1>Orders</H1>
	<br>
	<table id="tblOrders" cellspacing='1' border='1'>
		<thead>
			<tr>
				<td>Datum bestelling</td>
				<td>Naam klant</td>
				<td>Mail</td>
				<td>Telefoon</td>
				<td>Product ref.</td>
				<td>Product</td>
			</tr>
		</thead>
		<tbody>
		<?php
			$result = mysqli_query($cnn,"SELECT o.orderdate as orderdate,o.name as name, o.email as email, o.phone as phone , p.reference as reference, p.name as productname FROM orders AS o INNER JOIN products AS p ON o.product_id = p.id ORDER BY orderdate desc LIMIT 100");
			while($row = mysqli_fetch_array($result)) {
		?>
			<tr>
				<td width=''><?php echo $row['orderdate'];?></td>
				<td width=''><?php echo $row['name'];?></td>
				<td width=''><?php echo $row['email'];?></td>
				<td width=''><?php echo $row['phone'];?></td>
				<td width=''><?php echo $row['reference'];?></td>
				<td width=''><?php echo $row['productname'];?></td>
			</tr>
		<?php
			}
		?>
		</tbody>
	</table>
	<br>
</div>
<?php include '../includes/cnn_close.inc'; ?>
