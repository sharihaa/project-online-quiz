<?php
session_start();

// Dummy user credentials for demonstration
$valid_username = "admin";
$valid_password = "password123";

// Get the submitted username and password
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the credentials are valid
if ($username === $valid_username && $password === $valid_password) {
    // Set session variables
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;

    // Redirect to the homepage
    header("Location: ../view/homepage.html");
    exit();
} else {
    // Redirect back to the login page with an error message
    header("Location: ../view/login.html?error=invalid_credentials");
    exit();
}
?>