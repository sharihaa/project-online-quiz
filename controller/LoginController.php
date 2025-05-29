<?php
require_once __DIR__ . '/../model/UserModel.php';
session_start();

class LoginController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function handleLogin($username, $password, $role) {
        $user = $this->userModel->loginUser($username, $password, $role);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            
            setcookie('status', 'true', time() + 3000, '/');

            switch ($role) {
                case 'admin':
                    header('Location: ../view/homepage_admin.php');
                    exit;
                case 'teacher':
                    header('Location: ../view/homepage_teacher.php');
                    exit;
                case 'student':
                    header('Location: ../view/homepage_student.php');
                    exit;
                default:
                    echo "Unknown role.";
                    return;
            }
        } else {
            echo "<p style='color:red; text-align:center;'>Invalid username, password, or role.</p>";
        }
    }
}