<?php require 'includes/setup-medoo.php'; ?>
<?php require 'includes/setup-plates.php'; ?>
<?php require 'includes/header.php'; ?>
<?php require 'includes/footer.php'; ?>
<?php

//page 1 texts
$page1title = $database->select("settings", ["value"], ["variable" => 'page1title'])[0]['value'];
$page1body = $database->select("settings", ["value"], ["variable" => 'page1body'])[0]['value'];



$data['page1title']	= $page1title;
$data['page1body']	= $page1body;
$data['template'] 	= $text;
$data['categories'] = $categories;

echo $templates->render('frontend::info', ['data' => $data]);
?>

