<?php require 'includes/setup-medoo.php'; ?>
<?php require 'includes/setup-plates.php'; ?>
<?php require 'includes/header.php'; ?>
<?php require 'includes/footer.php'; ?>
<?php


/*info text*/
$infoText = $database->select("settings", ["value"], ["variable" => 'infotext'])[0]['value'];

/*front page products*/
$products = $database->select("products", "*", ["frontpage" => 1]);
foreach($products as $productkey => $product) {
	$image = $database->select("productimages", "*", ["productid"=>$product["id"]])[0]['image'];
	if (isset($image)) {
		$products[$productkey]['image'] = $image;
	}
	//get category 
	$catid = $product["category"];

	$productcat = $database->select("categories", "*", ["id" => $catid])[0];
	$products[$productkey]['catseoname'] = $productcat['seoname'];
}


$data['products']	= $products;
$data['infoText']	= $infoText;
$data['template'] 	= $text;
$data['categories'] = $categories;

echo $templates->render('frontend::home', ['data' => $data]);
?>

