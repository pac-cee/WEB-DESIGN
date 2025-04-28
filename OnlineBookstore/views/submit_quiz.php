<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['quiz_id']) || !isset($_POST['answers'])) {
    echo '<p>Invalid quiz submission.</p><a href="quiz.php">&larr; Back to Quizzes</a>';
    exit;
}
$user_id = $_SESSION['user_id'];
$quiz_id = intval($_POST['quiz_id']);
$answers = $_POST['answers'];
$db = new Database();
$conn = $db->getConnection();
// Fetch correct answers
$sql = 'SELECT id, correct_answer FROM quiz_questions WHERE quiz_id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $quiz_id);
$stmt->execute();
$result = $stmt->get_result();
$correct = [];
while ($row = $result->fetch_assoc()) {
    $correct[$row['id']] = $row['correct_answer'];
}
$stmt->close();
// Grade quiz
$score = 0;
$total = count($correct);
foreach ($correct as $qid => $corr_idx) {
    if (isset($answers[$qid]) && $answers[$qid] == $corr_idx) {
        $score++;
    }
}
// Save result
$stmt = $conn->prepare('INSERT INTO quiz_results (user_id, quiz_id, score, total, taken_at) VALUES (?, ?, ?, ?, NOW())');
$stmt->bind_param('iiii', $user_id, $quiz_id, $score, $total);
$stmt->execute();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Result - OnlineBookstore</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        .quiz-result { max-width: 400px; margin: 3rem auto; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 12px rgba(42,82,152,0.08); text-align: center; }
    </style>
</head>
<body>
    <div class="quiz-result">
        <h2>Quiz Submitted</h2>
        <p>Your score: <strong><?php echo $score; ?> / <?php echo $total; ?></strong></p>
        <a href="quiz.php">&larr; Back to Quizzes</a>
    </div>
</body>
</html>
