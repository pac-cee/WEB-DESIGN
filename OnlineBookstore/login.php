<?php
require_once __DIR__ . '/config/db.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $msg = "Login successful!";
    } else {
        $msg = "Invalid credentials.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <h1>Login</h1>
        <?php if(isset($msg)) echo "<p>$msg</p>"; ?>
        <form method="post">
            <label>Username:<input type="text" name="username" required></label><br>
            <label>Password:<input type="password" name="password" required></label><br>
            <button type="submit">Login</button>
        </form>
    </main>
</body>
</html>
