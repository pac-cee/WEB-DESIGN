<?php
// Include your database connection
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input values
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hash the password before storing it
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert query for the users table
    $sql = "INSERT INTO users (username, email, password_hash) VALUES ('$username', '$email', '$password_hash')";
    
    if (mysqli_query($conn, $sql)) {
        echo "New user added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    
    // Close the connection
    mysqli_close($conn);
}
?>
