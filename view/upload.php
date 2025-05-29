<?php
require_once __DIR__ . '/../config/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Check if a file was uploaded
if (isset($_FILES['myfile']) && $_FILES['myfile']['error'] === UPLOAD_ERR_OK) {
    $fileTmp = $_FILES['myfile']['tmp_name'];
    $fileName = basename($_FILES['myfile']['name']);
    $uploadDir = __DIR__ . '/uploads/';
    $uploadPath = $uploadDir . $fileName;

    // Create uploads directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Move the uploaded file
    if (move_uploaded_file($fileTmp, $uploadPath)) {
        // Save the filename in the database
        $db = new Database();
        $conn = $db->connect();

        $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
        $stmt->bind_param("si", $fileName, $user_id);
        $stmt->execute();

        header("Location: profile_teacher.php");
        exit;
    } else {
        echo "Failed to move uploaded file.";
    }
} else {
    echo "No file uploaded or error occurred.";
}
?>
