<?php

require_once __DIR__ . '/../controller/LoginController.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    $controller = new LoginController();
    $result = $controller->handleLogin($username, $password, $role);
    if ($result !== true) {
        $error = $result; 
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <link rel="stylesheet" href="login.css" />
  
</head>
<body>
   <nav class="navbar">
        <div class="logo"><a href="landingpage.html">QUIZ APP</a></div>
       
    </nav>
  <div class="login-container">
    <h2>Login Form</h2>

    <form method="POST" action="">
      <div class="form-control">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required />
      </div>

      <div class="form-control">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />
      </div>

      <div class="form-control">
        <label for="role">Login As:</label>
        <select id="role" name="role" required>
          <option value="admin">Admin</option>
          <option value="teacher">Teacher</option>
          <option value="student">Student</option>
        </select>
      </div>

      <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="signin.html">Register here</a></p>
    <p><a href="forgot_password.php">Forgot Password?</a></p>
  </div>
<?php if (!empty($error)) : ?>
  <p class="error-message"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

  <script src="../js/login.js"></script>
</body>
</html>
