<?php require 'lib/Plates/Engine.php'; ?>
<?php 
$templates = new League\Plates\Engine('./templates');
$templates->addFolder('frontend', './templates/frontend');
?>