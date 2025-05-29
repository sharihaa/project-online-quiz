<?php
session_start();
if (!isset($_SESSION['questions'])) {
    $_SESSION['questions'] = [];
}

// Handle reset
if (isset($_POST['reset_questions'])) {
    $_SESSION['questions'] = [];
    echo "<script>alert('All questions have been deleted.');</script>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['reset_questions'])) {
    $question = $_POST['question'];
    $options = [$_POST['optA'], $_POST['optB'], $_POST['optC'], $_POST['optD']];
    $correct = $_POST['correct'];
    $type = $_POST['question-type'];
    $difficulty = $_POST['difficulty'];
    $topic = $_POST['topic'];

    // Basic duplicate detection (compare question text)
    $isDuplicate = false;
    foreach ($_SESSION['questions'] as $q) {
        if (similar_text($question, $q['question']) > 80) { // 80% similarity threshold
            $isDuplicate = true;
            break;
        }
    }

    if (!$isDuplicate) {
        $_SESSION['questions'][] = [
            'question' => $question,
            'options' => $options,
            'correct' => $correct,
            'type' => $type,
            'difficulty' => $difficulty,
            'topic' => $topic
        ];
    } else {
        echo "<script>alert('Warning: This question may be a duplicate!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Teacher - Create Quiz (Question Editor)</title>
  <link rel="stylesheet" type="text/css" href="../css/homepage.css">
  <link rel="stylesheet" type="text/css" href="../css/createquiz.css">
</head>
<body>
  <nav class="navbar">
      <div class="logo">
          <a href="homepage_teacher.php">QUIZ APP</a>
      </div>
      <div class="nav-buttons">
          <button><a href="homepage_teacher.php">HOME</a></button>
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
    <div class="container">
      <h2>Create Quiz (Question Editor)</h2>
      <form method="POST">
        <input type="text" name="question" placeholder="Enter question" required><br>
        <select name="question-type" required>
          <option value="mcq">Multiple Choice</option>
          <option value="truefalse">True/False</option>
          <option value="matching">Matching</option>
        </select><br>
        <input type="text" name="optA" placeholder="Option A" required><br>
        <input type="text" name="optB" placeholder="Option B" required><br>
        <input type="text" name="optC" placeholder="Option C"><br>
        <input type="text" name="optD" placeholder="Option D"><br>
        <select name="correct" required>
          <option value ='""'>Select correct</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
          <option value="D">D</option>
        </select><br>
        <select name="difficulty" required>
          <option value="">Select Difficulty</option>
          <option value="Beginner">Beginner</option>
          <option value="Intermediate">Intermediate</option>
          <option value="Advanced">Advanced</option>
        </select><br>
        <select name="topic" required>
          <option value="">Select Topic</option>
          <option value="Algebra">Algebra</option>
          <option value="Geometry">Geometry</option>
          <option value="Calculus">Calculus</option>
        </select><br>
        <button type="submit">Add Question</button>
        <button type="submit" name="reset_questions" style="background:#e74c3c;color:#fff;">Reset All Questions</button>
        <a href="question_browser.php"><button type="button">Go to Question Browser</button></a>
        <a href="preview.php"><button type="button">Preview Quiz</button></a>
      </form>
    </div>
  </div> 
</body>
</html>