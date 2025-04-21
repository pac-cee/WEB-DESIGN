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
    <title>View Registrations</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="create_event.php">Create Event</a>
        <a href="view_events.php">View Events</a>
        <a href="register.php">Register</a>
        <a href="view_registrations.php">View Registrations</a>
    </nav>
    <main>
        <h1>All Registrations</h1>
        <table border="1">
            <tr><th>ID</th><th>Event</th><th>Name</th><th>Email</th></tr>
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
