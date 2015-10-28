<?php
$dbhost = 'localhost';
$dbuser = 'throwbac_db';
$dbpass = 'eM3CtdLG,ua[';
if($_SERVER['HTTP_HOST'] == 'dev.throwback-authentics.be'): 
	$dbname = 'throwbac_store_dev';
else:
	$dbname = 'throwbac_store';
endif;
?>