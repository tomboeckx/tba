<?php
#####  This function will generate the ajax output for the product image upload ##### 
function output_imagetable($cnn,$prodid) {
	echo "<table>";
	echo "<tr>";
	$resultpictures = mysqli_query($cnn,"SELECT * FROM productimages WHERE productid=$prodid"); //get all pictures for current product
	while($rowpic = mysqli_fetch_array($resultpictures)) 
	{ 
		echo "<td>";
		echo "<img src='/fotos/products/thumb/".$rowpic['image']."' />"; 
		echo "</td>";
	}
	echo "</tr>";
	echo "<tr>";
	$resultpictures = mysqli_query($cnn,"SELECT * FROM productimages WHERE productid=$prodid");
	while($rowpic = mysqli_fetch_array($resultpictures)) 
	{ 
		echo "<td style='text-align:center;'>";
		echo "<a onclick='confirmDelete(".$rowpic['id'].");'><img width='48' heigth='48' src='./images/delete_icon.jpg' /></a>";
		echo "</td>";
	}
	echo "</tr>";
	echo "</table>";
	echo '<input type="hidden" name="prod_id" id="prod_id" value="'.$prodid.'">';
}

#####  This function will proportionally resize image ##### 
function normal_resize_image($source, $destination, $image_type, $max_size, $image_width, $image_height, $quality){
	
	if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize
	
	//do not resize if image is smaller than max size
	if($image_width <= $max_size && $image_height <= $max_size){
		if(save_image($source, $destination, $image_type, $quality)){
			return true;
		}
	}
	
	//Construct a proportional size of new image
	$image_scale	= min($max_size/$image_width, $max_size/$image_height);
	$new_width		= ceil($image_scale * $image_width);
	$new_height		= ceil($image_scale * $image_height);
	
	
	/*
	//debug info
	$file = 'debug.txt';
	$current = file_get_contents($file);
	$current .= 'maxsize:'.$max_size."\n";
	$current .= 'width:'.$image_width.' height:'.$image_height."\n";
	$current .= 'new_width:'.$new_width.' new_height:'.$new_height."\n";
	file_put_contents($file, $current);
	*/

	
	$new_canvas		= imagecreatetruecolor( $new_width, $new_height ); //Create a new true color image
	
	//Copy and resize part of an image with resampling
	if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
		save_image($new_canvas, $destination, $image_type, $quality); //save resized image
	}

	return true;
}

##### This function corps image to create exact square, no matter what its original size! ######
function crop_image_square($source, $destination, $image_type, $square_size, $image_width, $image_height, $quality){
	if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize
	
	if( $image_width > $image_height )
	{
		$y_offset = 0;
		$x_offset = ($image_width - $image_height) / 2;
		$s_size 	= $image_width - ($x_offset * 2);
	}else{
		$x_offset = 0;
		$y_offset = ($image_height - $image_width) / 2;
		$s_size = $image_height - ($y_offset * 2);
	}
	$new_canvas	= imagecreatetruecolor( $square_size, $square_size); //Create a new true color image
	
	//Copy and resize part of an image with resampling
	if(imagecopyresampled($new_canvas, $source, 0, 0, $x_offset, $y_offset, $square_size, $square_size, $s_size, $s_size)){
		save_image($new_canvas, $destination, $image_type, $quality);
	}

	return true;
}

##### Saves image resource to file ##### 
function save_image($source, $destination, $image_type, $quality){
	switch(strtolower($image_type)){//determine mime type
		case 'image/png': 
			imagepng($source, $destination); return true; //save png file
			break;
		case 'image/gif': 
			imagegif($source, $destination); return true; //save gif file
			break;          
		case 'image/jpeg': case 'image/pjpeg': 
			imagejpeg($source, $destination, $quality); return true; //save jpeg file
			break;
		default: return false;
	}
}