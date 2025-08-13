<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tools_project';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to delete all users and reset the auto-increment
function deleteAllUsersAndResetID() {
    global $conn;
    
    // Delete all records from the users table
    $deleteQuery = "DELETE FROM users";
    $conn->query($deleteQuery);
    
    // Reset the auto-increment to 1
    $resetQuery = "ALTER TABLE users AUTO_INCREMENT = 1";
    $conn->query($resetQuery);

    echo "All users deleted, and auto-increment reset to 1.";
}

// Call the function to delete all users and reset the ID
deleteAllUsersAndResetID();
?>
