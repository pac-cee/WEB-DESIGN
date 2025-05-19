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
