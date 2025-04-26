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
    <meta name="description" content="Register for an event - Professional Portal">
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
        <h1>Register for Event</h1>
        <?php if(isset($msg)) {
            $icon = strpos($msg, 'success') !== false ? '<i class=\'fas fa-check-circle\' style=\'color:var(--primary);margin-right:0.5em;\'></i>' : '<i class=\'fas fa-exclamation-circle\' style=\'color:var(--accent);margin-right:0.5em;\'></i>';
            echo "<p style='font-weight:600;'>$icon$msg</p>";
        } ?>
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
