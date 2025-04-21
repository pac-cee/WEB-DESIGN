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
    <title>View Events</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="create_event.php">Create Event</a>
        <a href="view_events.php">View Events</a>
        <a href="register.php">Register</a>
    </nav>
    <main>
        <h1>All Events</h1>
        <table border="1">
            <tr><th>ID</th><th>Title</th><th>Date</th><th>Location</th></tr>
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
