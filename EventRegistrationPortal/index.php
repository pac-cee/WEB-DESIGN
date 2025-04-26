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
    <title>Eventify - Event Management</title>
</head>
<body>
    <main style="max-width:500px;margin:4em auto;background:#fff;border-radius:18px;box-shadow:0 6px 32px #4f8cff22;padding:2em;text-align:center;">
        <h1 style="color:var(--primary);">Welcome to Eventify</h1>
        <p style="font-size:1.1em;">A modern event management platform for admins, organizers, and attendees.<br>Manage, discover, and register for events with ease.</p>
        <div style="margin:2em 0;display:flex;justify-content:center;gap:2em;">
            <a href="views/login.php" style="background:var(--primary);color:#fff;padding:0.8em 2em;border-radius:8px;font-weight:600;text-decoration:none;box-shadow:0 2px 8px #4f8cff22;transition:background 0.3s;">Login <i class="fas fa-sign-in-alt"></i></a>
            <a href="views/register.php" style="background:var(--accent);color:var(--secondary);padding:0.8em 2em;border-radius:8px;font-weight:600;text-decoration:none;box-shadow:0 2px 8px #eebbc322;transition:background 0.3s;">Register <i class="fas fa-user-plus"></i></a>
        </div>
    </main>
</body>
</html>
