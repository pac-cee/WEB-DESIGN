<?php
require_once __DIR__ . '/../controllers/auth.php';
require_role(ROLE_ORGANIZER);
require_once __DIR__ . '/../config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events - Eventify</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <main style="max-width:900px;margin:2em auto;background:#fff;border-radius:18px;box-shadow:0 6px 32px #4f8cff22;padding:2em;">
        <h1 style="text-align:center;color:var(--primary)">Manage My Events</h1>
        <div id="myEvents">
            <!-- Event management table/list will go here -->
            <p style="text-align:center;color:#888;">Event management features coming soon.</p>
        </div>
    </main>
</body>
</html>
