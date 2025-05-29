
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make Your Certificate!</title>
    <link rel="stylesheet" href="../css/certificate.css">
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
        <div class="container">
            <h1>Create Certificate!</h1>
            <p>Enter your name and click the button to get your certificate!</p>
            
            <div class="form-container">
                <input type="text" id="nameInput" placeholder="Your Name">
                <button onclick="generateCertificate()">Make Certificate!</button>
            </div>
            
            <canvas id="certificateCanvas" width="800" height="600"></canvas>
            <p id="verifyLink"></p>
        </div>
    </div>
    <script src="../js/certificate.js"></script>
</body>
</html>