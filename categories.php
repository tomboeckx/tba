<?php require 'includes/setup-plates.php'; ?>
<?php require 'includes/setup-medoo.php'; ?>
<?php require 'includes/header.php'; ?>
<?php require 'includes/footer.php'; ?>
<?php

$data['template'] 	= $text;
$data['categories'] = $categories;

echo $templates->render('frontend::categories', ['data' => $data]);
?>
