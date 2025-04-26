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
    <meta name="description" content="Create a new event - Professional Portal">
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
        <h1>Create Event</h1>
        <?php if(isset($msg)) {
            $icon = strpos($msg, 'success') !== false ? '<i class=\'fas fa-check-circle\' style=\'color:var(--primary);margin-right:0.5em;\'></i>' : '<i class=\'fas fa-exclamation-circle\' style=\'color:var(--accent);margin-right:0.5em;\'></i>';
            echo "<p style='font-weight:600;'>$icon$msg</p>";
        } ?>
        <form method="post">
            <label>Title:<input type="text" name="title" required></label><br>
            <label>Date:<input type="date" name="date" required></label><br>
            <label>Location:<input type="text" name="location" required></label><br>
            <button type="submit">Create Event</button>
        </form>
    </main>
</body>
</html>
