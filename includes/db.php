<?php

$servername = "192.168.8.103";
$username = "quintaf";
$password = "Qu!nta";
$dbname = "appane_coceani";

<<<<<<< HEAD
/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appane_coceani";
*/
=======

/*$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appane_coceani";*/

>>>>>>> 790c9410aa3c748a0562b6cd4c3bb6193804679a

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
error_log("Connected successfully");
?>