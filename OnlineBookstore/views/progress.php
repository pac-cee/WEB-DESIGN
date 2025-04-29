<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/../config/db.php';

$user_id = $_SESSION['user_id'];
$db = new Database();
$conn = $db->getConnection();
$sql = 'SELECT p.id, b.title, p.pages_read, p.last_read FROM progress p JOIN books b ON p.book_id = b.id WHERE p.user_id = ? ORDER BY p.last_read DESC';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$progress = [];
while ($row = $result->fetch_assoc()) {
    $progress[] = $row;
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Progress - OnlineBookstore</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <div class="dashboard">
        <nav class="main-nav">
            <a href="../index.php" class="nav-logo"><i class="fas fa-house"></i> Home</a>
            <div class="nav-links">
                <a href="book_catalog.php"><i class="fas fa-book-open"></i> Book Catalog</a>
                <a href="quiz.php"><i class="fas fa-question-circle"></i> Quizzes</a>
                <a href="quiz_results.php"><i class="fas fa-list-ol"></i> Quiz Results</a>
                <a href="orders.php"><i class="fas fa-shopping-cart"></i> My Orders</a>
                <a href="progress.php" class="active"><i class="fas fa-chart-line"></i> My Progress</a>
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
        <section class="dashboard-hero" style="margin-bottom: 2em;">
            <h2>My Reading Progress</h2>
        </section>
        <div class="dashboard-progress-card">
            <?php if (empty($progress)): ?>
                <p>No reading progress found.</p>
            <?php else: ?>
                <table class="dashboard-progress-table">
                    <thead>
                        <tr>
                            <th>Book</th>
                            <th>Pages Read</th>
                            <th>Last Read</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($progress as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['title']); ?></td>
                                <td><?php echo htmlspecialchars($item['pages_read']); ?></td>
                                <td><?php echo htmlspecialchars($item['last_read']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <p style="margin-top:2rem;"><a href="dashboard.php" class="dashboard-link">&larr; Back to Dashboard</a></p>
        </div>
    </div>
</body>
</html>
