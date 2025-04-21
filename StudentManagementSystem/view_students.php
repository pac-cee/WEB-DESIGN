<?php
require_once __DIR__ . '/config/db.php';
$db = new Database();
$conn = $db->getConnection();
$result = $conn->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="add_student.php">Add Student</a>
        <a href="view_students.php">View Students</a>
    </nav>
    <main>
        <h1>All Students</h1>
        <table border="1">
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Course</th></tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['course']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>
</html>
