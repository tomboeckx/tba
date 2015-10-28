<?php include 'shared.php'; ?>
<?php
############ Configuration ##############
$thumb_square_size 		= 64; //Thumbnails will be cropped to 200x200 pixels
$max_image_size 		= 100; //Maximum image size (height and width)
$icon_prefix			= "icon64"; //Normal thumb Prefix
$image_prefix			= "icon100"; //Normal thumb Prefix
$destination_folder		= '/home/throwbackauth/public_html/fotos/categories/'; //upload directory ends with / (slash)
$relative_folder		= '../fotos/categories/'; //upload directory ends with / (slash)
$jpeg_quality 			= 90; //jpeg quality
##########################################

//continue only if $_POST is set and it is a Ajax request
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

	// check $_FILES['ImageFile'] not empty
	if(!isset($_FILES['image_file']) || !is_uploaded_file($_FILES['image_file']['tmp_name'])){
			die('Image file is Missing!'); // output error when above checks fail.
	}
	
	//uploaded file info we need to proceed
	$image_name = $_FILES['image_file']['name']; //file name
	$image_size = $_FILES['image_file']['size']; //file size
	$image_temp = $_FILES['image_file']['tmp_name']; //file temp

	$image_size_info 	= getimagesize($image_temp); //get image size
	
	if($image_size_info){
		$image_width 		= $image_size_info[0]; //image width
		$image_height 		= $image_size_info[1]; //image height
		$image_type 		= $image_size_info['mime']; //image type
	}else{
		die("Make sure image file is valid!");
	}

	//switch statement below checks allowed image type 
	//as well as creates new image from given file 
	switch($image_type){
		case 'image/png':
			$image_res =  imagecreatefrompng($image_temp); break;
		case 'image/gif':
			$image_res =  imagecreatefromgif($image_temp); break;			
		case 'image/jpeg': case 'image/pjpeg':
			$image_res = imagecreatefromjpeg($image_temp); break;
		default:
			$image_res = false;
	}

	if($image_res){
		
		$image_info = pathinfo($image_name);
		$image_extension = strtolower($image_info["extension"]); //image extension
		$image_name_only = strtolower($image_info["filename"]);//file name only, no extension
		
		//create a random name for new image (Eg: fileName_293749.jpg) ;
		$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
		
		//folder path to save resized images and thumbnails
		$icon_save_folder 	= $destination_folder . $icon_prefix .'/'. $new_file_name; 
		$image_save_folder 	= $destination_folder . $image_prefix .'/'. $new_file_name;
		
		//call normal_resize_image() function to proportionally resize image
		if(crop_image_square($image_res, $image_save_folder, $image_type, $max_image_size, $image_width, $image_height, $jpeg_quality))
		{
			//call crop_image_square() function to create square thumbnails
			if(!crop_image_square($image_res, $icon_save_folder, $image_type, $thumb_square_size, $image_width, $image_height, $jpeg_quality))
			{
				die('Error Creating thumbnail');
			}
			
			/* output image to user's browser*/
			echo '<img src="'.$relative_folder . $image_prefix .'/'. $new_file_name.'" alt="Thumbnail">';
			echo '<input type="hidden" id="hiddenNewFilename" value="'.$new_file_name.'">';
		}
		
		imagedestroy($image_res);
	}
}
?>