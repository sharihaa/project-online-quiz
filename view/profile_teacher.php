<?php
require_once __DIR__ . '/../config/db.php';
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Connect to the database
$db = new Database();
$conn = $db->connect();

// Fetch user data
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = :id AND role = 'teacher'");
$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Redirect if user not found or not a teacher
if (!$user) {
    echo "User not found or not authorized.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Profile</title>
    <link rel="stylesheet" href="../css/homepage.css">
    <link rel="stylesheet" href="../css/profile.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <a href="landingpage.html">QUIZ APP</a>
        </div>
        <div class="nav-buttons">
            <button><a href="homepage_teacher.php">HOME</a></button>
            <button><a href="logout.php">LOG OUT</a></button>
        </div>
    </nav>

    <div class="main-content">
        <div class="sidebar">
            <ul>
                <li><a href="teacher.php">Create Question</a></li>
                <li><a href="#">Check Scores</a></li>
                <li><a href="#">Certificate Generate</a></li>
            </ul>
        </div>

        <!-- Profile container -->
        <div class="profile-container">
            <div class="profile-header">
                <h3>Hello, <?php echo htmlspecialchars($user['fname']); ?></h3>
                <div class="profile-pic">
                    <img id="preview" src="<?php echo htmlspecialchars($profilePic); ?>" alt="Profile Picture">
                    <!-- Upload form, hidden by default -->
                    <form method="post" action="upload.php" enctype="multipart/form-data" class="upload-form" style="display:none; margin-top:10px;">
                        <input type="file" id="fileInput" name="myfile" accept="image/*" required>
                        <button type="submit" id="uploadBtn">Upload</button>
                    </form>
                </div>
            </div>

            <!-- Main Profile Info Form (separate) -->
            <form method="post" action="update_profile.php" enctype="multipart/form-data">
                <div class="profile-details">
                    <div class="details-columns">
                        <div class="column left">
                            <label>First Name:</label>
                            <input type="text" name="fname" value="<?php echo htmlspecialchars($user['fname']); ?>" disabled>
                            <label>Last Name:</label>
                            <input type="text" name="lname" value="<?php echo htmlspecialchars($user['lname']); ?>" disabled>
                            <label>Username:</label>
                            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" disabled>
                            <label>Email:</label>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" disabled>
                        </div>
                        <div class="column right">
                            <label>Date of Birth:</label>
                            <input type="date" name="dob" value="<?php echo htmlspecialchars($user['dob']); ?>" disabled>
                            <label>School or Institution:</label>
                            <textarea name="school" disabled><?php echo htmlspecialchars($user['school']); ?></textarea>
                        </div>
                    </div>
                    <div class="button-group">
                        <button type="button" id="editBtn">Edit Profile</button>
                        <button type="submit" id="saveBtn" style="display: none;">Save Profile</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/profile.js"></script>
</body>
</html>
