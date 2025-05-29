<?php
session_start();

// Dummy data for test attempts
$attempts = [
    ['name' => 'Alice', 'test_version' => 'Test A', 'score' => 80, 'datetime' => '2025-05-28 10:00 AM'],
    ['name' => 'Alice', 'test_version' => 'Test B', 'score' => 85, 'datetime' => '2025-05-28 02:00 PM'],
    ['name' => 'Bob', 'test_version' => 'Test A', 'score' => 70, 'datetime' => '2025-05-29 09:00 AM'],
    ['name' => 'Bob', 'test_version' => 'Test B', 'score' => 90, 'datetime' => '2025-05-29 11:00 AM'],
];

// Store in session for comparison page
$_SESSION['attempts'] = $attempts;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Gradebook!</title>
    <link rel="stylesheet" href="../css/quiz_history.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="../css/homepage.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo"><a href="homepage_teacher.php">QUIZ APP</a></div>
        <div class="nav-buttons">
            <button><a href="profile_teacher.php">PROFILE</a></button>
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
    <h1>Your Test Gradebook!</h1>
    <p>Check out your past test scores and see how you're doing!</p>

    <h2>Gradebook</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Test Version</th>
            <th>Score</th>
            <th>Date & Time</th>
        </tr>
        <?php foreach ($attempts as $attempt): ?>
            <tr>
                <td><?php echo htmlspecialchars($attempt['name']); ?></td>
                <td><?php echo htmlspecialchars($attempt['test_version']); ?></td>
                <td><?php echo htmlspecialchars($attempt['score']); ?></td>
                <td><?php echo htmlspecialchars($attempt['datetime']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Progress Graph</h2>
    <canvas id="progressChart" width="400" height="200"></canvas>


    <script>
        const ctx = document.getElementById('progressChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: [<?php foreach ($attempts as $a) { echo "'" . $a['datetime'] . "',"; } ?>],
                datasets: [{
                    label: 'Scores',
                    data: [<?php foreach ($attempts as $a) { echo $a['score'] . ','; } ?>],
                    borderColor: '#ff4081',
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true, max: 100 },
                    x: { title: { display: true, text: 'Date & Time' } }
                }
            }
        });
    </script>
</body>
</html>