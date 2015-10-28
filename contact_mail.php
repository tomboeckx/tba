<?php include 'includes/cnn_open.inc'; ?>
<?php 

$subj 	= mysqli_real_escape_string($cnn, $_POST["subject"]);
$vraag 	= mysqli_real_escape_string($cnn, $_POST["vraag"]);
$email 	= mysqli_real_escape_string($cnn, $_POST["email"]);
$name 	= mysqli_real_escape_string($cnn, $_POST["name"]);



//store mail in database
$sql = 	"INSERT INTO mails ".
	"(name, email, subject, question) ".
	"VALUES('$name','$email','$subj','$vraag')";

$retval = mysqli_query(  $cnn , $sql );
if(! $retval ) {
  die('Could not insert order: ' . mysql_error());
}



// multiple recipients
$to  = 'info@throwback-authentics.be';

// subject
$subject = 'Bericht:'.$subj ;

// message
$message = "Beste Steven,<br>";
$message .= "<br>";
$message .= "via het contactformulier ontving u een bericht:<br>";
$message .= "<br>";
$message .="Van: <b>$name ($email)</b><br>";
$message .= "<br>";
$message .="Onderwerp:<b>".$subj."</b><br>";
$message .= $vraag;

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From: Throwback-Authentics.be <info@throwback-authentics.be>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);


?>