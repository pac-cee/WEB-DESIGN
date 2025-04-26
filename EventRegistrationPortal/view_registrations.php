<?php
require_once __DIR__ . '/config/db.php';
$db = new Database();
$conn = $db->getConnection();
$result = $conn->query("SELECT r.id, e.title as event_title, r.name, r.email FROM registrations r JOIN events e ON r.event_id = e.id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View all registrations - Professional Portal">
    <link rel="icon" type="image/png" href="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/72x72/1f4c5.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php"><i class="fas fa-house"></i> Home</a>
        <a href="create_event.php"><i class="fas fa-plus-circle"></i> Create Event</a>
        <a href="view_events.php"><i class="fas fa-calendar-alt"></i> View Events</a>
        <a href="register.php"><i class="fas fa-user-edit"></i> Register</a>
        <a href="view_registrations.php"><i class="fas fa-list"></i> View Registrations</a>
    </nav>
    <main>
        <h1>All Registrations</h1>
        <table border="1">
            <tr><th><i class='fas fa-hashtag'></i> ID</th><th><i class='fas fa-calendar-alt'></i> Event</th><th><i class='fas fa-user'></i> Name</th><th><i class='fas fa-envelope'></i> Email</th></tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['event_title']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>
</html>
