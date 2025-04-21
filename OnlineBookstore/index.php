<?php
require_once __DIR__ . '/config/db.php';
// Add more includes as needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="add_book.php">Add Book</a>
        <a href="view_books.php">View Books</a>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
    </nav>
    <main>
        <h1>Welcome to the Online Bookstore</h1>
        <p>Buy, sell, and manage books. Add your own images and content!</p>
    </main>
</body>
</html>
