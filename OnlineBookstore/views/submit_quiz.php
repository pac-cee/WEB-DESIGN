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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A modern online bookstore to buy, sell, and manage books.">
    <link rel="icon" type="image/png" href="https://cdn.jsdelivr.net/gh/twitter/twemoji@14.0.2/assets/72x72/1f4da.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
     <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="/assets/css/quiz.css">
    <link rel="stylesheet" href="/assets/css/dashboard.css">
    <link rel="stylesheet" href="/assets/css/dashboard_custom.css">
</head>
<body>
    <div class="quiz-result">
        <h2>Quiz Submitted</h2>
        <p>Your score: <strong><?php echo $score; ?> / <?php echo $total; ?></strong></p>
        <a href="quiz.php">&larr; Back to Quizzes</a>
    </div>
</body>
</html>
