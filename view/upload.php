<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['myfile'])) {
    $targetDir = 'upload/';
    $fileName = basename($_FILES['myfile']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Allow only image file types
    $allowTypes = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($fileType, $allowTypes)) {
        $check = getimagesize($_FILES['myfile']['tmp_name']);
        if ($check !== false) {
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            if (move_uploaded_file($_FILES['myfile']['tmp_name'], $targetFilePath)) {
                // Optionally, update the user's profile image in the database
                if (isset($_SESSION['user_id'])) {
                    require_once __DIR__ . '/../config/db.php';
                    $db = new Database();
                    $conn = $db->connect();
                    $stmt = $conn->prepare("UPDATE users SET profile_pic = :pic WHERE id = :id");
                    $stmt->bindParam(':pic', $targetFilePath);
                    $stmt->bindParam(':id', $_SESSION['user_id']);
                    $stmt->execute();
                }
                // Save the path in session for immediate display
                $_SESSION['profile_pic'] = $targetFilePath;
                // Redirect to profile page
                header('Location: profile_teacher.php');
                exit();
            } else {
                echo 'Upload failed.';
            }
        } else {
            echo 'File is not a valid image.';
        }
    } else {
        echo 'Only JPG, JPEG, PNG, and GIF files are allowed.';
    }
}
?>

<form method="post" action="upload.php" enctype="multipart/form-data">
    <!-- ...profile fields... -->
    <div class="profile-pic">
        <img id="preview" src="default-user.png" alt="Profile Picture">
        <input type="file" id="fileInput" name="myfile" accept="image/*" style="display: none;">
        <input type="submit" id="uploadBtn" value="Upload" style="display: none;">
    </div>
    <!-- ...profile fields... -->
</form>
