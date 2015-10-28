<?php require 'includes/setup-plates.php'; ?>
<?php require 'includes/setup-medoo.php'; ?>
<?php require 'includes/header.php'; ?>
<?php require 'includes/footer.php'; ?>
<?php

//page 2 texts
$page2title = $database->select("settings", ["value"], ["variable" => 'page2title'])[0]['value'];
$page2body = $database->select("settings", ["value"], ["variable" => 'page2body'])[0]['value'];

$data['page2title']	= $page2title;
$data['page2body']	= $page2body;
$data['template'] 	= $text;
$data['categories'] = $categories;

echo $templates->render('frontend::conditions', ['data' => $data]);
?>