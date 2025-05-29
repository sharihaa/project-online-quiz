<?php
require_once __DIR__ . '/../config/db.php';

class UserModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function registerUser($data) {
        $query = "INSERT INTO users (role, fname, lname, username, email, password, dob, school)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt->bind_param(
            "ssssssss", 
            $data['role'], 
            $data['fname'], 
            $data['lname'], 
            $data['username'], 
            $data['email'], 
            $hashedPassword, 
            $data['dob'], 
            $data['school']
        );

        return $stmt->execute();
    }

    public function loginUser($username, $password, $role) {
        $query = "SELECT * FROM users WHERE username = ? AND role = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("ss", $username, $role);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user;
            } else {
                echo "❌ Password doesn't match.";
            }
        } else {
            echo "❌ No user found with that username and role.";
        }

        return false;
    }
}
