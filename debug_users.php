<?php
include 'includes/db_connect.php';

$sql = "SELECT id, name, email, password, role FROM users";
$result = $conn->query($sql);

echo "<h2>User Debug List</h2>";
echo "<table border='1'><tr><th>ID</th><th>Email</th><th>Role</th><th>Password Hash (First 20 chars)</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        echo "<td>" . substr($row['password'], 0, 20) . "...</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No users found</td></tr>";
}
echo "</table>";

// Test hardcoded verify
$test_pass = 'admin123';
// Generate a new hash for display
$new_hash = password_hash($test_pass, PASSWORD_DEFAULT);
echo "<h3>Test:</h3>";
echo "Hash for 'admin123' generated right now: " . $new_hash . "<br>";
?>