<?php require 'lib/medoo.php'; ?>
<?php require 'credentials.inc'; ?>

<?php 
$database = new medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => $dbname,
	'server' => $dbhost,
	'username' => $dbuser,
	'password' => $dbpass,
	 
	// optional
	'port' => 3306,
	'charset' => 'utf8',
	// driver_option for connection, read more from http://www.php.net/manual/en/pdo.setattribute.php
	'option' => [
		PDO::ATTR_CASE => PDO::CASE_NATURAL
	]
]);
?>