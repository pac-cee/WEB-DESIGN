<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require_once __DIR__ . '/../config/db.php';

if (!isset($_GET['quiz_id'])) {
    echo '<p>Quiz not specified.</p><a href="quiz.php">&larr; Back to Quizzes</a>';
    exit;
}
$quiz_id = intval($_GET['quiz_id']);
$db = new Database();
$conn = $db->getConnection();
// Fetch quiz info
$qsql = 'SELECT * FROM quizzes WHERE id = ?';
$qstmt = $conn->prepare($qsql);
$qstmt->bind_param('i', $quiz_id);
$qstmt->execute();
$qres = $qstmt->get_result();
$quiz = $qres->fetch_assoc();
if (!$quiz) {
    echo '<p>Quiz not found.</p><a href="quiz.php">&larr; Back to Quizzes</a>';
    exit;
}
// Fetch quiz questions
$sql = 'SELECT * FROM quiz_questions WHERE quiz_id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $quiz_id);
$stmt->execute();
$result = $stmt->get_result();
$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[] = $row;
}
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($quiz['title']); ?> - Take Quiz</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <style>
        .quiz-container { max-width: 800px; margin: 3rem auto; background: #fff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 12px rgba(42,82,152,0.08); }
        .question { margin-bottom: 2rem; }
        .question h4 { margin: 0 0 0.5rem 0; }
        .choices label { display: block; margin-bottom: 0.4rem; }
        .btn-primary { background: #2a5298; color: #fff; border: none; padding: 0.5rem 1.2rem; border-radius: 5px; cursor: pointer; }
        .btn-primary:hover { background: #43cea2; }
    </style>
</head>
<body>
    <div class="quiz-container">
        <h2><?php echo htmlspecialchars($quiz['title']); ?></h2>
        <p><?php echo nl2br(htmlspecialchars($quiz['description'])); ?></p>
        <?php if (empty($questions)): ?>
            <p>No questions found for this quiz.</p>
            <a href="quiz.php">&larr; Back to Quizzes</a>
        <?php else: ?>
            <form method="POST" action="submit_quiz.php">
                <input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
                <?php foreach ($questions as $idx => $q): ?>
                    <div class="question">
                        <h4>Q<?php echo $idx+1; ?>. <?php echo htmlspecialchars($q['question']); ?></h4>
                        <div class="choices">
                            <?php
                            $choices = json_decode($q['choices'], true);
                            foreach ($choices as $choice_idx => $choice): ?>
                                <label>
                                    <input type="radio" name="answers[<?php echo $q['id']; ?>]" value="<?php echo $choice_idx; ?>" required>
                                    <?php echo htmlspecialchars($choice); ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="btn-primary">Submit Quiz</button>
            </form>
        <?php endif; ?>
        <div style="margin-top:2rem;"><a href="quiz.php">&larr; Back to Quizzes</a></div>
    </div>
</body>
</html>
