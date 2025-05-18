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

    $db = new Database();
    $conn = $db->connect();

    $stmt = $conn->prepare("UPDATE users SET fname = :fname, lname = :lname, username = :username, email = :email, dob = :dob, school = :school WHERE id = :id");
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':dob', $dob);
    $stmt->bindParam(':school', $school);
    $stmt->bindParam(':id', $user_id);

    if ($stmt->execute()) {
        header('Location: profile_teacher.php');
        exit;
    } else {
        echo "Error updating profile.";
    }
}
?>
