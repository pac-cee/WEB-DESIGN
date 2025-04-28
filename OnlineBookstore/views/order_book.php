<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_id'])) {
    $user_id = $_SESSION['user_id'];
    $book_id = intval($_POST['book_id']);
    $db = new Database();
    $conn = $db->getConnection();
    // Check if already ordered
    $stmt = $conn->prepare('SELECT id FROM orders WHERE user_id = ? AND book_id = ?');
    $stmt->bind_param('ii', $user_id, $book_id);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $message = 'You have already ordered this book.';
    } else {
        $stmt = $conn->prepare('INSERT INTO orders (user_id, book_id, status) VALUES (?, ?, ?)');
        $status = 'pending';
        $stmt->bind_param('iis', $user_id, $book_id, $status);
        if ($stmt->execute()) {
            $message = 'Book ordered successfully!';
        } else {
            $message = 'Failed to order book. Please try again.';
        }
    }
    $stmt->close();
    $conn->close();
} else {
    $message = 'Invalid request.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Book - OnlineBookstore</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        .order-result { max-width: 400px; margin: 3rem auto; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 12px rgba(42,82,152,0.08); text-align: center; }
    </style>
</head>
<body>
    <div class="order-result">
        <h2>Order Book</h2>
        <p><?php echo $message; ?></p>
        <a href="book_catalog.php">&larr; Back to Catalog</a>
    </div>
</body>
</html>
