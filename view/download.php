<?php
if (isset($_GET['download'])) {
    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="questions_template.csv"');
    
    // Create CSV content
    $output = fopen('php://output', 'w');
    fputcsv($output, ['Question', 'Answer']); // Simple format: question and correct answer
    fputcsv($output, ['What is 2+2?', '4']);
    fputcsv($output, ['What color is the sky?', 'Blue']);
    fclose($output);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Questions Template</title>
    <link rel="stylesheet" href="../css/import.css">
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
                <li><a href="quiz_history.php">Import Questions</a></li>
                <li><a href="generate_certificate.php">Certificate Generate</a></li>
            </ul>
        </div>
    <h1>Download Your Questions Template!</h1>
    <p>Click the button to get a CSV file. Fill it with your questions!</p>
    <a href="download.php?download=true"><button>Download Template</button></a>
    <p><a href="import.php">Go to Import Questions</a></p>
</body>
</html>