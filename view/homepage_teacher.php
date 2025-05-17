<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Dashboard</title>
    <link rel="stylesheet" href="../css/homepage.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo"><a href="#">QUIZ APP</a></div>
        <div class="nav-buttons">
            <button><a href="profile.html">PROFILE</a></button>
            <button><a href="logout.php">LOG OUT</a></button>
        </div>
    </nav>

    <div class="main-content">
        <div class="sidebar">
            <ul>
                <li><a href="create_question.php">Create Question</a></li>
                <li><a href="quiz_history.php">Check Scores</a></li>
                <li><a href="generate_certificate.php">Certificate Generate</a></li>
            </ul>
        </div>
        <div class="container">
            <h2>Welcome, Teacher!</h2>
            <p>Manage your quizzes and evaluate student performance.</p>
        </div>
    </div>
</body>
</html>
