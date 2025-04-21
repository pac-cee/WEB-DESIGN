<?php
require_once __DIR__ . '/config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {
        $msg = "Registration successful!";
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
    <title>Register</title>
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
        <h1>Register</h1>
        <?php if(isset($msg)) echo "<p>$msg</p>"; ?>
        <form method="post">
            <label>Username:<input type="text" name="username" required></label><br>
            <label>Password:<input type="password" name="password" required></label><br>
            <button type="submit">Register</button>
        </form>
    </main>
</body>
</html>
