<?php
require_once __DIR__ . '/../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $school = $_POST['school'];

    $profile_pic_name = null;

    // Handle file upload if provided
    if (isset($_FILES['myfile']) && $_FILES['myfile']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $profile_pic_name = basename($_FILES['myfile']['name']);
        $uploadPath = $uploadDir . $profile_pic_name;

        if (!move_uploaded_file($_FILES['myfile']['tmp_name'], $uploadPath)) {
            echo "Failed to upload profile picture.";
            exit;
        }
    }

    $db = new Database();
    $conn = $db->connect();

    // Add profile_pic update only if a new file was uploaded
    if ($profile_pic_name) {
        $stmt = $conn->prepare("UPDATE users SET fname = ?, lname = ?, username = ?, email = ?, dob = ?, school = ?, profile_pic = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", $fname, $lname, $username, $email, $dob, $school, $profile_pic_name, $user_id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET fname = ?, lname = ?, username = ?, email = ?, dob = ?, school = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $fname, $lname, $username, $email, $dob, $school, $user_id);
    }

    if ($stmt->execute()) {
        header('Location: profile_teacher.php');
        exit;
    } else {
        echo "Error updating profile.";
    }
}
?>
