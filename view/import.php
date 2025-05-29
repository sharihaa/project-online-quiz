<?php
session_start();
$preview = [];
$uploadMessage = '';

if (isset($_POST['submit'])) {
    $src = $_FILES['myfile']['tmp_name'];
    $des = "upload/" . $_FILES['myfile']['name'];

    // Check if file is CSV
    if ($_FILES['myfile']['type'] == 'text/csv' || pathinfo($des, PATHINFO_EXTENSION) == 'csv') {
        if (move_uploaded_file($src, $des)) {
            // Read CSV for preview
            $file = fopen($des, 'r');
            $preview = [];
            $header = fgetcsv($file); // Skip header
            while ($row = fgetcsv($file)) {
                $preview[] = $row;
            }
            fclose($file);
            $_SESSION['questions'] = $preview; // Store for confirmation
            $uploadMessage = 'Success! Check the preview below.';
        } else {
            $uploadMessage = 'Error uploading file!';
        }
    } else {
        $uploadMessage = 'Please upload a CSV file!';
    }
}

if (isset($_POST['confirm'])) {
    // Simulate saving to database (here, just clear session)
    $uploadMessage = 'Questions imported successfully!';
    unset($_SESSION['questions']);
    $preview = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Your Questions!</title>
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
    <h1>Upload Your Questions!</h1>
    <p>Upload the filled CSV file to see your questions.</p>
    
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="myfile" accept=".csv">
        <button type="submit" name="submit">Upload CSV</button>
    </form>
    
    <p><?php echo htmlspecialchars($uploadMessage); ?></p>
    
    <?php if (!empty($preview)): ?>
        <h2>Preview Your Questions</h2>
        <table>
            <tr>
                <th>Question</th>
                <th>Answer</th>
            </tr>
            <?php foreach ($preview as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row[0]); ?></td>
                    <td><?php echo htmlspecialchars($row[1]); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <form method="post">
            <button type="submit" name="confirm">Confirm Import</button>
        </form>
    <?php endif; ?>
    
    <p><a href="download.php">Back to Download Template</a></p>
</body>
</html>