<?php
require_once './backend/config/database.php';

// Get the new releases data
try {
    $stmt = $conn->prepare("
        SELECT * FROM books 
        ORDER BY publication_date DESC 
        LIMIT 10
    ");
    $stmt->execute();
    $newReleases = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $error = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Releases - BookHaven</title>
    <link rel="stylesheet" href="./assets/css/main.css">
</head>
<body>
    <?php include './frontend/components/header.php'; ?>

    <main class="container">
        <h1 class="page-title">New Releases</h1>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-error">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php else: ?>
            <div class="books-grid">
                <?php foreach ($newReleases as $book): ?>
                    <div class="book-card">
                        <img src="<?php echo htmlspecialchars($book['cover_image']); ?>" 
                             alt="<?php echo htmlspecialchars($book['title']); ?>" 
                             class="book-cover">
                        <div class="book-info">
                            <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                            <p class="author"><?php echo htmlspecialchars($book['author']); ?></p>
                            <p class="price">$<?php echo number_format($book['price'], 2); ?></p>
                            <a href="./book.php?id=<?php echo $book['id']; ?>" 
                               class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <?php include './frontend/components/footer.php'; ?>
    
    <script src="./assets/js/main.js"></script>
</body>
</html>