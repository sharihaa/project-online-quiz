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
                  VALUES (:role, :fname, :lname, :username, :email, :password, :dob, :school)";
        
        $stmt = $this->conn->prepare($query);
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt->bindParam(':role', $data['role']);
        $stmt->bindParam(':fname', $data['fname']);
        $stmt->bindParam(':lname', $data['lname']);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':dob', $data['dob']);
        $stmt->bindParam(':school', $data['school']);

        return $stmt->execute();
    }

  public function loginUser($username, $password, $role) {
    $query = "SELECT * FROM users WHERE username = :username AND role = :role LIMIT 1";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':role', $role);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
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
