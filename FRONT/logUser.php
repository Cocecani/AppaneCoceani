<?php 
session_start();
// This file is not used - requests go to /logUser.php
// Redirecting to root...
$_SESSION["email"]= $_REQUEST["email"];
$_SESSION["password"]=$_REQUEST["password"];
//echo $_REQUEST["email"];
//echo $_REQUEST["password"];
header('Location: ../loguser.php');
//?email='.$_REQUEST["email"].'&password='.$_REQUEST["password"]);
die();
?>

