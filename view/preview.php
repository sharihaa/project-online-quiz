
<?php
session_start();
$questions = $_SESSION['questions'] ?? [];


if (isset($_POST['reset_questions'])) {
    $_SESSION['questions'] = [];
    header("Location: preview.php");
    exit;
}


if (isset($_POST['save_quiz'])) {
   
    $_SESSION['questions'] = [];
    header("Location: homepage_teacher.php?saved=1");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Preview Quiz</title>
  <link rel="stylesheet" type="text/css" href="../css/homepage.css">
  <link rel="stylesheet" type="text/css" href="../css/preview.css">
  
</head>
<body>
  <nav class="navbar">
      <div class="logo">
          <a href="homepage_teacher.php">QUIZ APP</a>
      </div>
      <div class="nav-buttons">
          <button><a href="../view/homepage_teacher.php">HOME</a></button>
          <button><a href="logout.php">LOG OUT</a></button>
      </div>
  </nav>
  <div class="main-content">
    <div class="sidebar">
        <ul>
            <li><a href="teacher.php">Create Question</a></li>
                <li><a href="question_browser.php">Check Questions</a></li>
                <li><a href="preview.php">Preview Questions</a></li>
                <li><a href="quiz_history.php">Check Scores</a></li>
                <li><a href="download.php">Import Questions</a></li>
                <li><a href="generate_certificate.php">Certificate Generate</a></li>
        </ul>
    </div>
    <div class="quiz-container">
      <h2>Quiz Preview</h2>
      <?php if (empty($questions)): ?>
        <p style="color:#888;">No questions to preview. Please add questions in the editor.</p>
      <?php else: ?>
        <?php foreach ($questions as $index => $q): ?>
          <div class="question-block">
            <p><strong>Q<?php echo $index + 1; ?>:</strong> <?php echo htmlspecialchars($q['question']); ?></p>
            <?php foreach (['A', 'B', 'C', 'D'] as $opt): ?>
              <?php if (!empty($q['options'][array_search($opt, ['A','B','C','D'])])): ?>
                <p class="option"><?php echo $opt . '. ' . htmlspecialchars($q['options'][array_search($opt, ['A','B','C','D'])]); ?></p>
              <?php endif; ?>
            <?php endforeach; ?>
            <div class="meta">
              Type: <?php echo ucfirst($q['type']); ?> |
              Difficulty: <?php echo htmlspecialchars($q['difficulty']); ?> |
              Topic: <?php echo htmlspecialchars($q['topic']); ?>
            </div>
            <p><em>Correct Answer: <?php echo $q['correct']; ?></em></p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <form method="post" style="margin-top:30px;">
        <a href="teacher.php"><button type="button" class="back-btn">Back to creating questions</button></a>
        <a href="homepage_teacher.php"> <button type="submit" name="save_quiz" class="back-btn" style="background:#27ae60;">Save Quiz</button></a>
        <button type="submit" name="reset_questions" class="back-btn" style="background:#e74c3c;">Reset All Questions</button>
      </form>
    </div>
  </div>
</body>
</html>
