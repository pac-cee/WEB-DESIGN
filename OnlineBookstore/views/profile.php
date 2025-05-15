<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/User.php';

$user_id = $_SESSION['user_id'];
$db = new Database();
$conn = $db->getConnection();

// Get user details
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Get user statistics
$stats = [
    'total_books' => 0,
    'total_quizzes' => 0,
    'total_orders' => 0
];

// Get total books read
$sql = "SELECT COUNT(*) as total FROM progress WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stats['total_books'] = $result->fetch_assoc()['total'];

// Get total quizzes taken
$sql = "SELECT COUNT(*) as total FROM quiz_results WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stats['total_quizzes'] = $result->fetch_assoc()['total'];

// Get total orders
$sql = "SELECT COUNT(*) as total FROM orders WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$stats['total_orders'] = $result->fetch_assoc()['total'];

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<he>
    <title>My Profile - OnlineBookstore</title>
    <?php
    $pageStyles = ['dashboard_custom', 'profile'];
    require_once __DIR__ . '/includes/header.php';
    ?>
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
    <link rel="stylesheet" href="assets/css/book_catalog.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <script src="assets/js/main.js" defer></script>
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
                <a href="progress.php"><i class="fas fa-chart-line"></i> My Progress</a>
            </div>
            <div class="nav-actions">
                <button id="theme-btn" title="Toggle theme"><span id="theme-icon">🌙</span></button>
                <div class="profile-dropdown">
                    <button id="profileBtn" class="active"><i class="fas fa-user-circle"></i> <?php echo htmlspecialchars($user['username']); ?></button>
                    <div class="profile-menu" id="profileMenu">
                        <a href="#" class="active">Profile</a>
                        <form action="logout.php" method="POST"><button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button></form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="profile-container">
            <section class="profile-header">
                <div class="profile-avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h1><?php echo htmlspecialchars($user['username']); ?>'s Profile</h1>
                <p class="member-since">Member since: <?php echo date('F j, Y', strtotime($user['created_at'])); ?></p>
            </section>

            <section class="profile-stats">
                <div class="stat-card">
                    <i class="fas fa-book"></i>
                    <div class="stat-value"><?php echo $stats['total_books']; ?></div>
                    <div class="stat-label">Books Read</div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-question-circle"></i>
                    <div class="stat-value"><?php echo $stats['total_quizzes']; ?></div>
                    <div class="stat-label">Quizzes Taken</div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-shopping-cart"></i>
                    <div class="stat-value"><?php echo $stats['total_orders']; ?></div>
                    <div class="stat-label">Total Orders</div>
                </div>
            </section>

            <section class="profile-details">
                <div class="profile-section">
                    <h2>Account Settings</h2>
                    <form id="profileUpdateForm" class="profile-form">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" id="new_password" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm New Password</label>
                            <input type="password" id="confirm_password" name="confirm_password">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <script src="../assets/js/dashboard_custom.js"></script>
    <script src="../assets/js/profile.js"></script>
</body>
</html>
