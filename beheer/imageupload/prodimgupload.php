<?php include '../../includes/cnn_open.inc'; ?>
<?php include 'shared.php'; ?>
<?php
############ Configuration ##############
$icon_square_size 		= 64; //Thumbnails will be cropped 
$thumb_square_size 		= 150; //Thumbnails will be cropped 
$offer_image_size		= 282; //Maximum image size (height and width)
$product_image_size		= 438; //Maximum image size (height and width)
$large_image_size		= 700; //Maximum image size (height and width)
$icon_prefix			= "icon/"; //small square thumb for backend
$thumb_prefix			= "thumb/"; //square thumb for backend
$offer_prefix			= "offer/"; //products pages 
$product_prefix			= "product/"; //products pages 
$large_prefix			= "large/"; //Large product details pictures
$original_prefix		= "original/"; //Original uploaded file
if($_SERVER['HTTP_HOST'] == 'dev.throwback-authentics.be'): 
	$destination_folder		= '/home/throwbackauth/public_html/_dev/fotos/products/'; //upload directory ends with / (slash)
else:
	$destination_folder		= '/home/throwbackauth/public_html/fotos/products/'; //upload directory ends with / (slash)
endif;

$jpeg_quality 			= 90; //jpeg quality
##########################################

//continue only if $_POST is set and it is a Ajax request
if(isset($_POST) && isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

	$prodid = $_POST['prod_id'];
	
	//if product is not saved yet,
	if($prodid == 0) {
		
		//do a manual hard save of the product first so we can get a product ID
		$prod_name = mysqli_real_escape_string($cnn, $_POST['prod_name']);
		$prod_description = mysqli_real_escape_string($cnn, $_POST['prod_description']);
		$prod_price = mysqli_real_escape_string($cnn, $_POST['prod_price']);
		$prod_reduction = mysqli_real_escape_string($cnn, $_POST['prod_reduction']);
		$prod_frontpage = mysqli_real_escape_string($cnn, $_POST['prod_frontpage']);
		$prod_onsale = mysqli_real_escape_string($cnn, $_POST['prod_onsale']);
		$prod_category = mysqli_real_escape_string($cnn, $_POST['prod_category']);
		$prod_periode = mysqli_real_escape_string($cnn, $_POST['prod_periode']);
		$prod_fabrikant = mysqli_real_escape_string($cnn, $_POST['prod_fabrikant']);

		$prod_name = !empty($prod_name) ? $prod_name : NULL;
		$prod_description = !empty($prod_description) ? $prod_description : NULL;
		$prod_price = !empty($prod_price) ? $prod_price : "NULL";
		$prod_reduction = !empty($prod_reduction) ? $prod_reduction : "NULL";
		$prod_frontpage = $prod_frontpage == 'on' ? 1 : 0;
		$prod_onsale = $prod_onsale == 'on' ? 1 : 0;
		$prod_periode = !empty($prod_periode) ? $prod_periode : NULL;
		$prod_fabrikant = !empty($prod_fabrikant) ? $prod_fabrikant : NULL;
		
		$sql =  "INSERT INTO products ".
				"(name,description,price,reduction,frontpage,onsale,category,periode,fabrikant) ".
				"VALUES('$prod_name','$prod_description',$prod_price,$prod_reduction,$prod_frontpage,$prod_onsale,$prod_category,'$prod_periode','$prod_fabrikant')";
		$retval = mysqli_query(  $cnn , $sql );
		if(! $retval )
		{
		  die('Could not enter data: ' . mysql_error());
		}
	
		//after save get last product ID , this will be the last added record
		$lastidquery= "select id from products ORDER BY id DESC limit 1";
		$lastidresult = mysqli_query( $cnn, $lastidquery) or die(mysql_error());
		while($lastrow = mysqli_fetch_array($lastidresult))
		{
			$prodid  = $lastrow['id'];
		}
	}

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
		//Get file extension and name to construct new file name 
		$image_info = pathinfo($image_name);
		$image_extension = strtolower($image_info["extension"]); //image extension
		$image_name_only = strtolower($image_info["filename"]);//file name only, no extension
		
		//create a random name for new image (Eg: fileName_293749.jpg) ;
		$new_file_name = $image_name_only. '_' .  rand(0, 9999999999) . '.' . $image_extension;
		
		//folder path to save resized images and thumbnails
		$icon_save_folder 		= $destination_folder . $icon_prefix . $new_file_name; 
		$thumb_save_folder 		= $destination_folder . $thumb_prefix . $new_file_name; 
		$offer_save_folder		= $destination_folder . $offer_prefix . $new_file_name;
		$product_save_folder	= $destination_folder . $product_prefix . $new_file_name;
		$large_save_folder 		= $destination_folder . $large_prefix . $new_file_name; 
		$originale_save_folder 	= $destination_folder . $original_prefix . $new_file_name; 

		//first store original image
		if(save_image($image_res, $originale_save_folder, $image_type, $jpeg_quality))
		{
			//category product image
			if(!normal_resize_image($image_res, $product_save_folder, $image_type, $product_image_size, $image_width, $image_height, $jpeg_quality))
			{
				die('Error Creating product image');
			}
			// front page offer image
			if(!normal_resize_image($image_res, $offer_save_folder, $image_type, $offer_image_size, $image_width, $image_height, $jpeg_quality))
			{
				die('Error Creating product image');
			}

			//large product details image
			if(!normal_resize_image($image_res, $large_save_folder, $image_type, $large_image_size, $image_width, $image_height, $jpeg_quality))
			{
				die('Error Creating large product image');
			}

			//call crop_image_square() function to create square thumbnails
			if(!crop_image_square($image_res, $icon_save_folder, $image_type, $icon_square_size, $image_width, $image_height, $jpeg_quality))
			{
				die('Error Creating icon');
			}
			//call crop_image_square() function to create square thumbnails
			if(!crop_image_square($image_res, $thumb_save_folder, $image_type, $thumb_square_size, $image_width, $image_height, $jpeg_quality))
			{
				die('Error Creating thumbnail');
			}
			
			$sql = "INSERT INTO productimages (productid,image) VALUES($prodid,'$new_file_name')";
			$retval = mysqli_query(  $cnn , $sql );
			if(! $retval )
			{
			  die('Could not enter data: ' . mysql_error());
			}
		}
		imagedestroy($image_res); //freeup memory
	}
	//output picture table to browser
	output_imagetable($cnn,$prodid);
	mysqli_close($cnn);
}
?>