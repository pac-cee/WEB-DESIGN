<?php
/**
 * FRONTEND INTEGRATION
 * - HTML/PHP mixed mode
 * - Form handling
 * - Session management
 */

session_start();
require __DIR__ . '/../database/mysql_connection.php';

// Form handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    // Process form data
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Frontend</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="username" required>
        <button type="submit">Submit</button>
    </form>
    
    <?php if(isset($username)): ?>
        <p>Welcome, <?= $username ?>!</p>
    <?php endif; ?>
</body>
</html>