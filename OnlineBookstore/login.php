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
    <meta name="description" content="A modern online bookstore to buy, sell, and manage books.">
    <link rel="icon" type="image/png" href="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/72x72/1f4da.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="assets/css/auth.css">
    <script src="assets/js/auth.js" defer></script>
    <script src="assets/js/main.js" defer></script>
</head>
<body class="fade-in">
    <nav>
        <a href="index.php"><i class="fas fa-house"></i> Home</a>
        <a href="add_book.php"><i class="fas fa-plus-circle"></i> Add Book</a>
        <a href="view_books.php"><i class="fas fa-book"></i> View Books</a>
        <a href="register.php"><i class="fas fa-user-plus"></i> Register</a>
        <a href="login.php" class="active"><i class="fas fa-sign-in-alt"></i> Login</a>
    </nav>
    <main>
        <div class="auth-container">
            <h1>Welcome Back</h1>
            <?php if(isset($msg)) echo "<div class='auth-message " . (strpos($msg, 'successful') !== false ? 'success' : 'error') . "'>$msg</div>"; ?>
            <form method="post" class="auth-form" id="loginForm">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                    <i class="fas fa-user icon"></i>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <i class="fas fa-lock icon"></i>
                </div>
                <button type="submit" class="auth-button">Login <i class="fas fa-arrow-right"></i></button>
            </form>
            <div class="auth-links">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
        </div>
    </main>
</body>
</html>
