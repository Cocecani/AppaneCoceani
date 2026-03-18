<?php

// Primary connection settings
$servername = "192.168.8.103";
$username = "quintaf";
$password = "Qu!nta";
$dbname = "appane_coceani";

// Create primary connection
$conn = new mysqli($servername, $username, $password, $dbname);

// If primary fails, fallback to localhost
if ($conn->connect_error) {
    error_log("Primary connection failed: " . $conn->connect_error . " — trying localhost...");

    $conn = new mysqli("localhost", "root", "", $dbname);

    if ($conn->connect_error) {
        die("Both connections failed: " . $conn->connect_error);
    }

    error_log("Connected via localhost fallback");
} else {
    error_log("Connected successfully to primary");
}
?>
