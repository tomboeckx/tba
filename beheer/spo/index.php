<?php
require_once 'credentials.php';
require_once 'SPOClient.php';

function getFolders($client) {
	$folders = $client->getFolders();
	foreach($folders as $folder) {
		if (strpos($folder->Name,'Fotos') !== false) {
			  echo '<a href="#" onclick="return navToSPOFolder(\''.str_replace(" ", "%20",$folder->Name).'\');">'.$folder->Name.'</a>';
			  echo '<br>';
		}
	}
}

function getFilesInFolder($client,$folder) {
	$files = $client->getFilesInFolder($folder);
		
	echo '<div id="divFileBrowser">';
	$count = 0;
	foreach($files as $f) {
		$count++;
		$url = str_replace(" ", "%20", $f->ServerRelativeUrl);	
		$fname = $f->Name;
		$thumbfname = preg_replace('"\.(jpg|JPG)$"', '_JPG.jpg', $f->Name);
		$thumburl = '/'.$folder.'/_t/'.$thumbfname;
		$thumburl = str_replace(" ", "%20",$thumburl);
		$previewurl = '/'.$folder.'/_w/'.$thumbfname;
		$previewurl = str_replace(" ", "%20",$previewurl);
		echo '<div class="divFile" id="picture'.$count.'">';
		echo '<p>'.$fname.'</p>';
		echo '<div class="divCheckbox">';
		echo '<input type="checkbox" id="check'.$count.'" name="check" value="'.$url.'">';
		echo '<label for="check'.$count.'"></label>';
		echo '</div>';
		echo '<div class="divThumb" onclick="SwitchCheckFile(\''.$count.'\')">';
		echo '<img onmouseover="ShowPreview(\''.$previewurl.'\','.$count.')"  src="spo/index.php?file='.$thumburl.'" />';
		echo '</div>';
		echo '<input type="hidden" id="image'.$count.'" value="'.$url.'">';
		echo '</div>';
	}
	echo '</div>';
	echo '<br>';
	echo '<p>[<a href="#" onclick="return navToSPORoot()">Terug</a>]</p>';

	
}

function returnImage($client,$url) {
	$fi = $client->getFile(str_replace(" ", "%20",$url));
	$filename = basename ( $url );
	
	// Set the content type header - in this case image/jpeg
	header('Content-Type: image/jpeg');
	header('Content-Disposition: attachment; filename='.$filename);

	// Output the image
	$image = imagecreatefromstring($fi);
	imagejpeg($image);

	// Free up memory
	imagedestroy($image);
}

function connectSPO($url,$username,$password)
{
    try {
        $client = new SPOClient($url);
        $client->signIn($username,$password);
		return $client;
    }
    catch (Exception $e) {
        echo 'Authentication failed: ',  $e->getMessage(), "\n";
    }
}

$spo = connectSPO($SPOUrl,$SPOUser,$SPOPass);

if (isset($_GET["folder"])) {
	$folder = str_replace(" ", "%20",$_GET["folder"]);
?>
<!DOCTYPE html>
<html>
<head>
	<link href="css/spo-filebrowser.css" rel="stylesheet" type="text/css">
	<script src="../js/tba/spo-filebrowser.js" type="text/javascript" ></script>
	<title>Pictures in folder <? echo $folder?></title>
</head>
<body>
	<h1>Pictures in folder <? echo $folder?></h1>
	<div id="divPreview" onmouseout="HidePreview();" style="z-index: 100;">
	</div>
	<div id="divFiles">
	<?
		getFilesInFolder($spo,$folder);
	?>
	</div>
</body>
</html>
<?
}
elseif (isset($_GET["file"])) {
	$url = $_GET["file"];
	returnImage($spo,$url);
}
else {
	getFolders($spo);
}
?>