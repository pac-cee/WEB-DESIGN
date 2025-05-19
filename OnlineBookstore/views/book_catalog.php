<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/../config/db.php';

$db = new Database();
$conn = $db->getConnection();
$sql = 'SELECT b.*, a.audio_file FROM books b LEFT JOIN audio_books a ON b.id = a.book_id';
$result = $conn->query($sql);
$books = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
    <link rel="stylesheet" href="/assets/css/book_catalog.css">
    <link rel="stylesheet" href="/assets/css/dashboard_custom.css">
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <script src="/assets/js/main.js" defer></script>
</head>
</head>
<body>
    <div class="dashboard">
        <nav class="main-nav">
            <a href="../index.php" class="nav-logo"><i class="fas fa-house"></i> Home</a>
            <div class="nav-links">
                <a href="book_catalog.php" class="active"><i class="fas fa-book-open"></i> Book Catalog</a>
                <a href="quiz.php"><i class="fas fa-question-circle"></i> Quizzes</a>
                <a href="quiz_results.php"><i class="fas fa-list-ol"></i> Quiz Results</a>
                <a href="orders.php"><i class="fas fa-shopping-cart"></i> My Orders</a>
                <a href="progress.php"><i class="fas fa-chart-line"></i> My Progress</a>
            </div>
            <div class="nav-actions">
                <button id="theme-btn" title="Toggle theme"><span id="theme-icon">🌙</span></button>
                <div class="profile-dropdown">
                    <button id="profileBtn"><i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></button>
                    <div class="profile-menu" id="profileMenu">
                        <a href="#">Profile</a>
                        <form action="logout.php" method="POST"><button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button></form>
                    </div>
                </div>
            </div>
        </nav>
        <section class="dashboard-hero">
            <h2>Book Catalog</h2>
        </section>
        <?php if (empty($books)): ?>
            <div class="dashboard-book-list"><p>No books found.</p></div>
        <?php else: ?>
            <div class="dashboard-book-list">
                <?php foreach ($books as $book): ?>
                    <div class="dashboard-book-card">
                        <div class="book-card-img">
                            <?php if (!empty($book['cover_image'])): ?>
                                <img src="../assets/images/<?php echo htmlspecialchars($book['cover_image']); ?>" alt="Book Cover">
                            <?php else: ?>
                                <img src="../assets/images/default_cover.png" alt="Book Cover">
                            <?php endif; ?>
                        </div>
                        <div class="book-card-content">
                            <h3 class="book-title"><?php echo htmlspecialchars($book['title']); ?></h3>
                            <p class="book-author">by <?php echo htmlspecialchars($book['author']); ?></p>
                            <div class="book-price">$<?php echo htmlspecialchars($book['price']); ?></div>
                            <p class="book-desc"><?php echo nl2br(htmlspecialchars($book['description'])); ?></p>
                            <div class="actions">
    <form method="POST" action="order_book.php">
        <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
        <button type="submit" class="quick-btn">Buy/Order</button>
    </form>
    <?php if (!empty($book['read_file'])): ?>
        <a href="../books/<?php echo htmlspecialchars($book['read_file']); ?>" class="btn-secondary" target="_blank">Read Online</a>
    <?php endif; ?>
    <?php if (!empty($book['audio_file'])): ?>
        <a href="../audio/<?php echo htmlspecialchars($book['audio_file']); ?>" class="btn-secondary" target="_blank">Listen</a>
    <?php endif; ?>
</div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <p><a href="dashboard.php" class="dashboard-link">&larr; Back to Dashboard</a></p>
    </div>
</body>
</html>
