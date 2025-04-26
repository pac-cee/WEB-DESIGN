<?php
require_once __DIR__ . '/config/db.php';
// Add more includes as needed
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
</head>
<body>
    <nav>
        <a href="index.php" class="active"><i class="fas fa-house"></i> Home</a>
        <a href="add_book.php"><i class="fas fa-plus-circle"></i> Add Book</a>
        <a href="view_books.php"><i class="fas fa-book-open"></i> View Books</a>
        <a href="register.php"><i class="fas fa-user-plus"></i> Register</a>
        <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
    </nav>
    <main>
        <section class="hero">
            <div class="hero-text">
                <h1>Welcome to the Online Bookstore</h1>
                <p style="font-size:1.2em;">Your one-stop shop for discovering, buying, and selling books online. Whether you're a passionate reader, a student, or a book collector, our platform connects you with thousands of titles and a vibrant community.</p>
                <ul style="margin:1em 0 1.5em 1em; padding:0; list-style:none;">
                    <li style="margin-bottom:0.7em;"><i class="fas fa-check-circle" style="color:var(--primary);"></i> Browse a vast collection of books across genres</li>
                    <li style="margin-bottom:0.7em;"><i class="fas fa-check-circle" style="color:var(--primary);"></i> Add and manage your own books for sale</li>
                    <li style="margin-bottom:0.7em;"><i class="fas fa-check-circle" style="color:var(--primary);"></i> Simple registration and secure login</li>
                    <li><i class="fas fa-check-circle" style="color:var(--primary);"></i> Fast, user-friendly, and mobile-ready</li>
                </ul>
                <a href="register.php" style="background:var(--primary);color:#fff;padding:0.8em 2em;border-radius:8px;font-weight:600;text-decoration:none;box-shadow:0 2px 8px #6c63ff22;transition:background 0.3s;">Get Started <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="hero-img">
                <img src="https://cdn.pixabay.com/photo/2017/01/31/13/14/book-2022464_1280.png" alt="Bookstore Illustration" style="border-radius:12px;box-shadow:0 4px 24px #6c63ff22;">
            </div>
        </section>
        <section>
            <h2 style="color:var(--primary);font-size:1.4em;margin-bottom:0.7em;">Why Choose Us?</h2>
            <div class="features">
                <div class="feature-card">
                    <i class="fas fa-book-reader"></i>
                    <h3>Huge Selection</h3>
                    <p>Find books from bestsellers to rare finds, all in one place.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-user-shield"></i>
                    <h3>Secure & Private</h3>
                    <p>Your data is protected and your transactions are safe.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-mobile-alt"></i>
                    <h3>Mobile Friendly</h3>
                    <p>Enjoy a seamless experience on any device, anytime.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-headset"></i>
                    <h3>Support</h3>
                    <p>Get help fast with our friendly customer support team.</p>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
