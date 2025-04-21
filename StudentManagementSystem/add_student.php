<?php
require_once __DIR__ . '/config/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $course = $_POST['course'] ?? '';
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare("INSERT INTO students (name, email, course) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $course);
    if ($stmt->execute()) {
        $msg = "Student added successfully!";
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
    <title>Add Student</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="add_student.php">Add Student</a>
        <a href="view_students.php">View Students</a>
    </nav>
    <main>
        <h1>Add Student</h1>
        <?php if(isset($msg)) echo "<p>$msg</p>"; ?>
        <form method="post">
            <label>Name:<input type="text" name="name" required></label><br>
            <label>Email:<input type="email" name="email" required></label><br>
            <label>Course:<input type="text" name="course" required></label><br>
            <button type="submit">Add Student</button>
        </form>
    </main>
</body>
</html>
