<?php
$servername = "localhost";
$username = "root";  // Adjust the username if it's different
$password = "";  // Adjust the password if it's different
$dbname = "food_app";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
