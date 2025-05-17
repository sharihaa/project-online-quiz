<?php
session_start();
$questions = $_SESSION['questions'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $score = 0;
    foreach ($questions as $index => $q) {
        if ($_POST["q$index"] == $q['correct']) {
            $score++;
        }
    }
    $total = count($questions);
    echo "<h2>Your Score: $score / $total</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Student Quiz</title>
</head>
<body>
  <h2>Student Quiz</h2>
  <form method="POST">
    <?php foreach ($questions as $index => $q): ?>
      <div>
        <p><strong>Q<?php echo $index+1; ?>:</strong> <?php echo $q['question']; ?></p>
        <?php foreach (['A', 'B', 'C', 'D'] as $opt): ?>
          <label>
            <input type="radio" name="q<?php echo $index; ?>" value="<?php echo $opt; ?>" required>
            <?php echo $q['options'][array_search($opt, ['A', 'B', 'C', 'D'])]; ?>
          </label><br>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
    <br>
    <button type="submit">Submit Quiz</button>
  </form>
</body>
</html>
