<?php require 'includes/setup-plates.php'; ?>
<?php require 'includes/setup-medoo.php'; ?>
<?php require 'includes/header.php'; ?>
<?php require 'includes/footer.php'; ?>
<?php

$prodid = 0;

if (isset($_GET["prodid"])&&is_numeric($_GET["prodid"])) {
	$prodid = $_GET["prodid"];

	//get product 
	$product = $database->select("products", "*", ["id" => $prodid])[0];
	$product['image'] = $database->select("productimages", "*", ["productid" => $prodid])[0];
}

$data['product']	= $product;
$data['template'] 	= $text;
$data['categories'] = $categories;

echo $templates->render('frontend::product_reservation', ['data' => $data]);
?>
