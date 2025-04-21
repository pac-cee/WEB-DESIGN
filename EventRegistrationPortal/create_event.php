<?php
require_once __DIR__ . '/config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $date = $_POST['date'] ?? '';
    $location = $_POST['location'] ?? '';
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("INSERT INTO events (title, date, location) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $date, $location);
    if ($stmt->execute()) {
        $msg = "Event created successfully!";
    } else {
        $msg = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
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
        <h1>Create Event</h1>
        <?php if(isset($msg)) echo "<p>$msg</p>"; ?>
        <form method="post">
            <label>Title:<input type="text" name="title" required></label><br>
            <label>Date:<input type="date" name="date" required></label><br>
            <label>Location:<input type="text" name="location" required></label><br>
            <button type="submit">Create Event</button>
        </form>
    </main>
</body>
</html>
