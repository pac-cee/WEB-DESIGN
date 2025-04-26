<?php
require_once __DIR__ . '/config/db.php';
// Add more includes as needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Modern Event Registration Portal">
    <link rel="icon" type="image/png" href="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/72x72/1f4c5.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>body{background:#f4f4f4;}</style>
</head>
<body>
    <nav>
        <a href="index.php"><i class="fas fa-house"></i> Home</a>
        <a href="create_event.php"><i class="fas fa-plus-circle"></i> Create Event</a>
        <a href="view_events.php"><i class="fas fa-calendar-alt"></i> View Events</a>
        <a href="register.php"><i class="fas fa-user-edit"></i> Register</a>
    </nav>
    <main>
        <h1>Welcome to the Event Registration Portal</h1>
        <p>Create and register for events. Add your own images and content!</p>
    </main>
</body>
</html>
