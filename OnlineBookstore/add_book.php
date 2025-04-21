<?php
require_once __DIR__ . '/config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $price = $_POST['price'] ?? 0;
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("INSERT INTO books (title, author, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $title, $author, $price);
    if ($stmt->execute()) {
        $msg = "Book added successfully!";
    } else {
        $msg = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
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
        <h1>Add Book</h1>
        <?php if(isset($msg)) echo "<p>$msg</p>"; ?>
        <form method="post">
            <label>Title:<input type="text" name="title" required></label><br>
            <label>Author:<input type="text" name="author" required></label><br>
            <label>Price:<input type="number" step="0.01" name="price" required></label><br>
            <button type="submit">Add Book</button>
        </form>
    </main>
</body>
</html>
