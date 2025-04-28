<?php
session_start();
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['admin', 'teacher'])) {
    header('Location: ../views/login.php');
    exit;
}
require_once __DIR__ . '/../config/db.php';

$db = new Database();
$conn = $db->getConnection();
// Fetch all students
$students_sql = "SELECT u.id, u.username, u.email, s.name AS school FROM users u LEFT JOIN memberships m ON u.id = m.user_id LEFT JOIN schools s ON m.school_id = s.id WHERE u.role = 'student' ORDER BY s.name, u.username";
$students_result = $conn->query($students_sql);
$students = [];
while ($row = $students_result->fetch_assoc()) {
    $students[] = $row;
}
// Fetch quiz results for all students
$results_sql = "SELECT qr.user_id, q.title, qr.score, qr.total, qr.taken_at FROM quiz_results qr JOIN quizzes q ON qr.quiz_id = q.id";
$results_result = $conn->query($results_sql);
$results = [];
while ($row = $results_result->fetch_assoc()) {
    $results[] = $row;
}
$conn->close();
?>
<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>School Dashboard - OnlineBookstore</title>
    <link rel=\"stylesheet\" href=\"../assets/css/styles.css\">
    <style>
        .school-dashboard { max-width: 1100px; margin: 3rem auto; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 12px rgba(42,82,152,0.08); }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 0.75rem 1rem; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f4f7fa; }
        .section { margin-bottom: 2.5rem; }
    </style>
</head>
<body>
    <div class=\"school-dashboard\">
        <h2>School Dashboard</h2>
        <div class=\"section\">
            <h3>Students</h3>
            <?php if (empty($students)): ?>
                <p>No students found.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr><th>Username</th><th>Email</th><th>School</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $stu): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($stu['username']); ?></td>
                                <td><?php echo htmlspecialchars($stu['email']); ?></td>
                                <td><?php echo htmlspecialchars($stu['school']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div class=\"section\">
            <h3>Quiz Results</h3>
            <?php if (empty($results)): ?>
                <p>No quiz results found.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr><th>Student ID</th><th>Quiz</th><th>Score</th><th>Date Taken</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $res): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($res['user_id']); ?></td>
                                <td><?php echo htmlspecialchars($res['title']); ?></td>
                                <td><?php echo htmlspecialchars($res['score']) . ' / ' . htmlspecialchars($res['total']); ?></td>
                                <td><?php echo htmlspecialchars($res['taken_at']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        <div style=\"margin-top:2rem;\"><a href=\"../views/dashboard.php\">&larr; Back to Dashboard</a></div>
    </div>
</body>
</html>
