<?php require 'includes/setup-medoo.php'; ?>
<?php require 'includes/setup-plates.php'; ?>
<?php require 'includes/header.php'; ?>
<?php require 'includes/footer.php'; ?>
<?php

$products = $database->select("products", "*", ["disabled"=>0,"ORDER" => ['sortorder ASC', 'name ASC']]);


$data['products']	= $products;
$data['template'] 	= $text;
$data['categories'] = $categories;

//print_r($text);
echo $templates->render('frontend::sitemap', ['data' => $data,'text' => $text]);
?>
