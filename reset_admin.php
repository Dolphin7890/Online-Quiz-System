<?php
include 'includes/db_connect.php';

$email = 'admin@example.com';
$new_password = 'admin123';
// $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); 
// BYPASS: Storing plain text for debugging
$hashed_password = $new_password;

$sql = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";

if ($conn->query($sql) === TRUE) {
    echo "<h1>Admin Password Reset to PLAIN TEXT Successfully!</h1>";
    echo "<p>Email: <b>admin@example.com</b></p>";
    echo "<p>Password: <b>admin123</b></p>";
    echo "<p><a href='login.php'>Go to Login</a></p>";
} else {
    echo "Error updating record: " . $conn->error;
}
?>