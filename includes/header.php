<?php

$page1title = $database->select("settings", ["value"], ["variable" => 'page1title'])[0]['value'];
$page1subheader = $database->select("settings", ["value"], ["variable" => 'page1subheader'])[0]['value'];

$page2title = $database->select("settings", ["value"], ["variable" => 'page2title'])[0]['value'];
$page2subheader = $database->select("settings", ["value"], ["variable" => 'page2subheader'])[0]['value'];

$text['page1title'] 	= $page1title;
$text['page1subheader'] = $page1subheader;
$text['page2title'] 	= $page2title;
$text['page2subheader'] = $page2subheader;
?>