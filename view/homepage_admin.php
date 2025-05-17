<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location:login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/homepage.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo"><a href="#">QUIZ APP</a></div>
        <div class="nav-buttons">
            <button><a href="profile.php">PROFILE</a></button>
            <button><a href="logout.php">LOG OUT</a></button>
        </div>
    </nav>

    <div class="main-content">
        <div class="sidebar">
            <ul>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="assign_roles.php">Assign Roles</a></li>
                <li><a href="view_reports.php">View Reports</a></li>
            </ul>
        </div>
        <div class="container">
            <h2>Welcome, Admin!</h2>
            <p>Use the sidebar to manage users and monitor system analytics.</p>
        </div>
    </div>
</body>
</html>
