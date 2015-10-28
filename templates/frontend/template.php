<!DOCTYPE html>
<html>
	<head>
		<title><?=$this->e($title)?></title>
		<meta name="description" content="<?=$this->e($description)?>">
		<meta name="robots" content="index,follow">
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<?php include 'includes/scripts.inc'; ?>
	</head>
	
	<body class="home">
		<?php $this->insert('frontend::includes/header') ?>
		<?php $this->insert('frontend::includes/menu', ['categories' => $data['categories'], 'text' => $data['template']]) ?>
		<!-- MAIN -->
		<?=$this->section('content')?>
		<!-- ENDS MAIN -->
		
		<?php $this->insert('frontend::includes/footer', ['categories' => $data['categories'], 'text' => $data['template']]) ?>
		<?php $this->insert('frontend::includes/bottom') ?>
	</body>
</html>
