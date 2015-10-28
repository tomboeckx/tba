<?php require 'includes/setup-medoo.php'; ?>
<?php require 'includes/setup-plates.php'; ?>
<?php require 'includes/header.php'; ?>
<?php require 'includes/footer.php'; ?>
<?php
if (isset($_GET["catid"])&&is_numeric($_GET["catid"])) {
	$catid = $_GET["catid"];
	$productcat = $database->select("categories", "*", ["id" => $catid])[0];
}
else {	
	$catseoname = isset($_GET['catseoname']) ? $_GET['catseoname'] : $path_info['call_parts'][0];
	//get category 
	$productcat = $database->select("categories", "*", ["seoname" => $catseoname])[0];
	$catid = $productcat["id"];
}

/*current category products*/
$products = $database->select("products", "*", ["AND"=>["category" => $catid,"disabled"=>0],"ORDER" => ['sortorder ASC', 'name ASC']]);
/*find first associated image for product display*/
foreach($products as $productkey => $product) {
	$image = $database->select("productimages", "*", ["productid"=>$product["id"]])[0]['image'];
	if (isset($image)) {
		$products[$productkey]['image'] = $image;
	}
}

//1  2  3  4  5  6
//55 42 43 45 51 54

//get next category ID
$nextcatid = $database->min("categories","id", ["sortorder[>]" =>$productcat['sortorder'],"ORDER" => ['sortorder ASC', 'name ASC']]);
//echo "nn:".$nextcatid;
if($nextcatid == "") { //falback to first
	$nextcatid =  $database->get("categories", "id", ["ORDER" => ['sortorder ASC', 'name ASC']]);
}
$nextcat = $database->select("categories", "*", ["id" => $nextcatid])[0];
$nextcatname = $nextcat["name"];

//get prev cat id
$prevcat = $database->select("categories", "*", ["sortorder[<]" =>$productcat['sortorder'],"ORDER" => ['sortorder DESC', 'name DESC'],"LIMIT"=> 1])[0];
$prevcatid = $prevcat["id"];
//echo "pp:".$prevcatid;
if($prevcatid == "") { //falback to last
	$prevcatid =  $database->get("categories", "id", ["ORDER" => ['sortorder DESC', 'name DESC']]);
	$prevcat = $database->select("categories", "*", ["id" => $prevcatid])[0];
	//print_r( $prevcatid);
}
$prevcatname = $prevcat["name"];


//echo "<pre>";
//print_r($test);
//echo "</pre>";

$data['nextcatid']	= $nextcatid;
$data['prevcatid']	= $prevcatid;
$data['nextcatname']= $nextcatname;
$data['prevcatname']= $prevcatname;
$data['category']	= $productcat;
$data['products']	= $products;
$data['template'] 	= $text;
$data['categories'] = $categories;
//echo "cur".$catid;
//echo "nex".$nextcatid;
//echo "prv".$prevcatid;
echo $templates->render('frontend::products', ['data' => $data]);
?>

