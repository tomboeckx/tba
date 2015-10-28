<?php require 'includes/setup-plates.php'; ?>
<?php require 'includes/setup-medoo.php'; ?>
<?php require 'includes/header.php'; ?>
<?php require 'includes/footer.php'; ?>
<?php

$catid = 0;
$prodid = 0;


if (isset($_GET["prodid"])&&is_numeric($_GET["prodid"])) {
	$prodid = $_GET["prodid"];

	//get product 
	$product = $database->select("products", "*", ["id" => $prodid])[0];
	$product['images'] = array();
	$product['images'] = $database->select("productimages", "*", ["productid" => $prodid]);

	//get category 
	$catid = $product["category"];
	$productcat = $database->select("categories", "*", ["id" => $catid])[0];
}
else {
	$catseoname = isset($_GET['catseoname']) ? $_GET['catseoname'] : $path_info['call_parts'][0];
	$prodseoname = isset($_GET['prodseoname']) ? $_GET['prodseoname'] : $path_info['call_parts'][1];

	//get product 
	$product = $database->select("products", "*", ["seoname" => $prodseoname])[0];
	$prodid = $product["id"];

	$product['images'] = array();
	$product['images'] = $database->select("productimages", "*", ["productid" => $prodid]);

	//get category 
	$catid = $product["category"];
	$productcat = $database->select("categories", "*", ["id" => $catid])[0];
}

//get next prod ID
$nextprodid = $database->min("products","id", ["sortorder[>]" =>$product['sortorder'],"ORDER" => ['sortorder ASC', 'name ASC']]);
if($nextprodid == "") { //falback to first
	$nextprodid =  $database->get("products", "id", ["ORDER" => ['sortorder ASC', 'name ASC']]);
}
$nextprod = $database->select("products", "*", ["id" => $nextprodid])[0];
$nextprodname = $nextprod["name"];

//get prev prod id
$prevprod = $database->select("products", "*", ["sortorder[<]" =>$product['sortorder'],"ORDER" => ['sortorder DESC', 'name DESC'],"LIMIT"=> 1])[0];
$prevprodid = $prevprod["id"];
if($prevprodid == "") { //falback to last
	$prevprodid =  $database->get("products", "id", ["ORDER" => ['sortorder DESC', 'name DESC']]);
	$prevprod = $database->select("products", "*", ["id" => $prevprodid])[0];
}
$prevprodname = $prevprod["name"];


$data['nextprodid']	= $nextprodid;
$data['prevprodid']	= $prevprodid;
$data['nextprodname']= $nextprodname;
$data['prevprodname']= $prevprodname;
$data['product'] = $product;
$data['category'] = $productcat;
$data['categories'] = $categories;
$data['template'] 	= $text;


echo $templates->render('frontend::product', ['data' => $data]);
?>