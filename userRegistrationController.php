<?php
session_start();
require_once 'config.php';

try {
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['newusername'] ?? '';
        $email    = $_POST['newuseremail'] ?? '';
        $password = $_POST['newuserpassword'] ?? '';

        if (empty($username) || empty($email) || empty($password)) {
            echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $checkStmt = $pdo->prepare("SELECT user_id FROM tbl_users WHERE user_email = :email");
        $checkStmt->execute(['email' => $email]);

        if ($checkStmt->fetch()) {
            echo json_encode(['status' => 'error', 'message' => 'Email already exists']);
            exit;
        }

        // INSERT USER
        $stmt = $pdo->prepare("
            INSERT INTO tbl_users (user_name, user_email, user_password)
            VALUES (:name, :email, :password)
        ");

        $stmt->execute([
            'name'     => $username,
            'email'    => $email,
            'password' => $hashedPassword
        ]);

        echo json_encode(['status' => 'success', 'message' => 'User registered successfully']);
    }

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}