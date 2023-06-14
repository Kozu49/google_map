<?php
$servername = "google_map-mysql-1";
$username = "myuser";
$password = "mypassword";
$database = "mydatabase";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Perform database operations here

// Close the connection
$conn->close();
?>
