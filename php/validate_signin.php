<?php
require_once __DIR__ . '/../controller/SigninController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new SigninController();
    $controller->handleSignin($_POST);
} else {
    echo "Invalid request method.";
}
