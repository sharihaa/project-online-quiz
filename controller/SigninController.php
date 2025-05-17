<?php
require_once __DIR__ . '/../model/UserModel.php';

class SigninController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function handleSignin($postData) {
        if ($this->userModel->registerUser($postData)) {
            header("Location: ../view/login.php");
            exit();
        } else {
            echo "Registration failed. Please try again.";
        }
    }
}
