<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'student') {
    header("Location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
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
                <li><a href="join_quiz.php">Join Quiz</a></li>
                <li><a href="my_scores.php">My Scores</a></li>
                <li><a href="my_certificates.php">My Certificates</a></li>
            </ul>
        </div>
        <div class="container">
            <h2>Welcome, Student!</h2>
            <p>Join quizzes, check your results, and download certificates.</p>
        </div>
    </div>
</body>
</html>
