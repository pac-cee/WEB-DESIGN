<?php
require_once __DIR__ . '/config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $event_id = $_POST['event_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("INSERT INTO registrations (event_id, name, email) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $event_id, $name, $email);
    if ($stmt->execute()) {
        $msg = "Registration successful!";
    } else {
        $msg = "Error: " . $stmt->error;
    }
    $stmt->close();
}
$db = new Database();
$conn = $db->getConnection();
$events = $conn->query("SELECT * FROM events");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Event</title>
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
        <h1>Register for Event</h1>
        <?php if(isset($msg)) echo "<p>$msg</p>"; ?>
        <form method="post">
            <label>Event:
                <select name="event_id" required>
                    <option value="">Select Event</option>
                    <?php while($row = $events->fetch_assoc()): ?>
                    <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?> (<?= htmlspecialchars($row['date']) ?>)</option>
                    <?php endwhile; ?>
                </select>
            </label><br>
            <label>Name:<input type="text" name="name" required></label><br>
            <label>Email:<input type="email" name="email" required></label><br>
            <button type="submit">Register</button>
        </form>
    </main>
</body>
</html>
