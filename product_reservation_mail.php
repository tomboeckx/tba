<?php include 'includes/cnn_open.inc'; ?>
<?php 

//get form data
$phone 	= mysqli_real_escape_string($cnn, $_POST["phone"]);
$vraag 	= mysqli_real_escape_string($cnn, $_POST["vraag"]);
$email 	= mysqli_real_escape_string($cnn, $_POST["email"]);
$name 	= mysqli_real_escape_string($cnn, $_POST["name"]);

//fetch product info
if (isset($_POST["prodid"])) {
	$prodid = mysqli_real_escape_string($cnn, $_POST["prodid"]);
	$result = mysqli_query($cnn,"SELECT * FROM products WHERE id=$prodid");
	
	$prodrow = mysqli_fetch_array($result);
	$catid = $prodrow["category"];
	
	$resultpictures = mysqli_query($cnn,"SELECT * FROM productimages WHERE productid=$prodid");

	$resultcat = mysqli_query( $cnn, "SELECT * FROM categories WHERE id = $catid"); 
	$rowcat = mysqli_fetch_array($resultcat);		

	$prodname = $prodrow['name'];
	$prodreference = $prodrow['reference'];
	$prodprice = $prodrow['price'];
	$prodcat = $rowcat['name'];
	

	//Fixme: store order to database

	//set product reserved flag
	$sql = 	"UPDATE products ".
			"SET reserved=1 ".
			"WHERE id=$prodid";	   
	$retval = mysqli_query(  $cnn , $sql );
	if(! $retval ) {
	  die('Could not update product: ' . mysql_error());
	}
	//store order in database
	$sql = 	"INSERT INTO orders ".
		"(product_id,payment_method,email,name,phone) ".
		"VALUES($prodid,1,'$email','$name','$phone')";

	$retval = mysqli_query(  $cnn , $sql );
	if(! $retval ) {
	  die('Could not insert order: ' . mysql_error());
	}

	//notify the store owner

	$to  = 'reservaties@throwback-authentics.be'; // note the comma

	// subject
	$subject = 'Reservatie product "'.$prodname.'"' ;

	// message
	$message = '
	<html>
	<head>
	  <title>'.$subject.'</title>
	</head>
	<body>
	  <h1>Bestelling product</h1>
	  <p> Beste Steven,<br> het volgende product werd gereserveerd via de website</p>
	  <p>Categorie: '.$prodcat.'</p>
	  <p>Productnaam: '.$prodname.'</p>
	  <p>Product# / ref.: <b>'.$prodreference.'</b></p>
	  <p>Prijs: '.$prodprice.'</p>
	  <br/>
	  <p>Naam klant: '.$name.'</p>
	  <p>Tel. klant: '.$phone.'</p>
	  <p>Mail klant: '.$email.'</p>
		
	  <p>Bijkomende informatie:'.$vraag.'</p>
	</body>
	</html>
	';

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Throwback-Authentics.be <reservaties@throwback-authentics.be>' . "\r\n";

	// Mail it
	mail($to, $subject, $message, $headers);

	//notify the customer

	// recipients
	$to  = $email; // note the comma

	// subject
	$subject = 'Reservatiebevestiging "'.$prodname.'"' ;

	// message
	$message = '
	<html>
	<head>
	  <title>'.$subject.'</title>
	</head>
	<body>
		<h1>Bestelling product</h1>
		<p> Beste '.$name.',<br> het volgende product werd voor u gereserveerd:</p>
		<p><b>'.$prodname.'</b></p>
		<p>Product # / ref.:<b>'.$prodreference.'</b></p>
		<p>Categorie: '.$prodcat.'</p>
		<p>Prijs: '.$prodprice.' EUR</p>
		<br/>
		<p>U kan het product afhalen in ons filliaal te Zolder op volgend adress:</p>
		<p><b>Throwback Authentics</b><br/>
		<p>Toekomststraat 7A<br/>
		3550 Heusden-Zolder<br/>
		(+32) 486 622 058<br/></p>
		<p>Voor bijkomende informatie kan u mailen naar <a href="mailto:info@throwback-authentics.be">info@throwback-authentics.be</a> of deze mail beantwoorden.</p>
	</body>
	</html>
	';

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Throwback-Authentics.be <reservaties@throwback-authentics.be>' . "\r\n";

	// Mail it
	mail($to, $subject, $message, $headers);
}
?>
<?php include 'includes/cnn_close.inc'; ?>