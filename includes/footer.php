<?php

$categories = $database->select("categories", "*", ["ORDER" => ['sortorder ASC', 'name ASC']]);
$footerText = $database->select("settings", ["value"], ["variable" => 'footertext'])[0]['value'];
$footerTitle = $database->select("settings", ["value"], ["variable" => 'footerheader'])[0]['value'];

$text['footerText'] 	= $footerText;
$text['footerTitle'] 	= $footerTitle;
?>