<?php
session_start();


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    header("Location: login.php");
    exit;
}


if (!isset($_SESSION['recent_activities'])) {
    $_SESSION['recent_activities'] = [];
}


if (isset($_GET['saved'])) {
    $activity = [
        'message' => 'Quiz saved successfully!',
        'timestamp' => date('Y-m-d H:i:s')
    ];
    $_SESSION['recent_activities'][] = $activity;

   
    if (count($_SESSION['recent_activities']) > 10) {
        array_shift($_SESSION['recent_activities']);
    }
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
            <?php if (isset($_GET['saved'])): ?>
                <div class="alert-success">Quiz saved successfully!</div>
            <?php endif; ?>
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p>Manage your quizzes and evaluate student performance.</p>

           
            <h3>Recent Activities</h3>
            <table class="activities-table">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Activity</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($_SESSION['recent_activities'])):
                        $serial = 1;
                        
                        foreach (array_reverse($_SESSION['recent_activities']) as $activity):
                    ?>
                    <tr>
                        <td><?php echo $serial++; ?></td>
                        <td><?php echo htmlspecialchars($activity['message']); ?></td>
                        <td><?php echo htmlspecialchars($activity['timestamp']); ?></td>
                    </tr>
                    <?php
                        endforeach;
                    else:
                    ?>
                    <tr>
                        <td colspan="3">No recent activities.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
