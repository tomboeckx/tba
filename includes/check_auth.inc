<?php
session_start(); 

if($_SESSION['myusername'] == ""){
  header("location:index.php");
}
?>
