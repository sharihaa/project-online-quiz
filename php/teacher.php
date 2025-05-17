<?php
session_start();
if (!isset($_SESSION['questions'])) {
    $_SESSION['questions'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['question'];
    $options = [$_POST['optA'], $_POST['optB'], $_POST['optC'], $_POST['optD']];
    $correct = $_POST['correct'];
    $_SESSION['questions'][] = [
        'question' => $question,
        'options' => $options,
        'correct' => $correct
    ];
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Teacher - Create Quiz</title>
  <link rel="stylesheet" type="text/css" href="homepage.css">
  <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 600px;
        margin: 50px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h2, h3 {
        color: #630375;
        text-align: center;
    }
    form input, form select, form button {
        width: 100%;
        margin: 10px 0;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    form button {
        background-color: #b97cda;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
    }
    form button:hover {
        background-color: #a05bb5;
    }
    ul {
        list-style: none;
        padding: 0;
    }
    ul li {
        background: #fbf7fc;
        margin: 5px 0;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #b97cda;
    }
    a button {
        display: block;
        margin: 20px auto;
        text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Create Quiz</h2>
    <form method="POST">
      <input type="text" name="question" placeholder="Enter question" required><br>
      <input type="text" name="optA" placeholder="Option A" required><br>
      <input type="text" name="optB" placeholder="Option B" required><br>
      <input type="text" name="optC" placeholder="Option C" required><br>
      <input type="text" name="optD" placeholder="Option D" required><br>
      <select name="correct" required>
        <option value="">Select correct</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
      </select><br><br>
      <button type="submit">Add Question</button>
    </form>

    <h3>Preview Questions</h3>
    <ul>
      <?php foreach ($_SESSION['questions'] as $index => $q): ?>
        <li><?php echo $q['question']; ?> (Correct: <?php echo $q['correct']; ?>)</li>
      <?php endforeach; ?>
    </ul>
  </div>
</body>
</html>
