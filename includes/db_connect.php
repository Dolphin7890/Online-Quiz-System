<?php
// Database Configuration
$host = 'localhost';
$user = 'root';      // Default XAMPP/WAMP username
$pass = '';          // Default XAMPP/WAMP password (empty)
$db   = 'quiz_db';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
