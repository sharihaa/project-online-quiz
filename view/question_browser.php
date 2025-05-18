<?php
session_start();
if (!isset($_SESSION['questions'])) {
    $_SESSION['questions'] = [];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Teacher - Question Browser</title>
  <link rel="stylesheet" type="text/css" href="../css/homepage.css">
    <link rel="stylesheet" type="text/css" href="../css/question_browser.css">
</head>
<body>
  <div class="container">
    <h2>Question Browser</h2>
    <div class="filter-section">
      <h3>Filter Questions</h3>
      <select id="filter-type">
        <option value="">All Types</option>
        <option value="mcq">Multiple Choice</option>
        <option value="truefalse">True/False</option>
        <option value="matching">Matching</option>
      </select>
      <select id="filter-difficulty">
        <option value="">All Difficulties</option>
        <option value="Beginner">Beginner</option>
        <option value="Intermediate">Intermediate</option>
        <option value="Advanced">Advanced</option>
      </select>
      <select id="filter-topic">
        <option value="">All Topics</option>
        <option value="Algebra">Algebra</option>
        <option value="Geometry">Geometry</option>
        <option value="Calculus">Calculus</option>
      </select>
      <button onclick="filterQuestions()">Apply Filters</button>
    </div>

    <h3>Questions</h3>
    <ul id="question-list">
      <?php foreach ($_SESSION['questions'] as $index => $q): ?>
        <li data-type="<?php echo $q['type']; ?>" data-difficulty="<?php echo $q['difficulty']; ?>" data-topic="<?php echo $q['topic']; ?>">
          <?php echo $q['question']; ?> 
          (Type: <?php echo $q['type']; ?>, 
          Correct: <?php echo $q['correct']; ?>, 
          Difficulty: <?php echo $q['difficulty']; ?>, 
          Topic: <?php echo $q['topic']; ?>)
        </li>
      <?php endforeach; ?>
    </ul>
    <a href="teacher.php"><button>Back to Question Editor</button></a>
  </div>
  <script src="../js/question_browser.js"></script>
</body>
</html>