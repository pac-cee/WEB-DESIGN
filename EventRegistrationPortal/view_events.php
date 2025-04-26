<?php
require_once __DIR__ . '/config/db.php';
$db = new Database();
$conn = $db->getConnection();
$result = $conn->query("SELECT * FROM events");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="View all events - Professional Portal">
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
    </nav>
    <main>
        <h1>All Events</h1>
        <table border="1">
            <tr><th><i class='fas fa-hashtag'></i> ID</th><th><i class='fas fa-heading'></i> Title</th><th><i class='fas fa-calendar-day'></i> Date</th><th><i class='fas fa-map-marker-alt'></i> Location</th></tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['date']) ?></td>
                <td><?= htmlspecialchars($row['location']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>
</html>
