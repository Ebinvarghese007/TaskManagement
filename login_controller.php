<?php
session_start();
require_once 'config.php';

try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Fetch user
        $stmt = $pdo->prepare("SELECT * FROM public.tbl_users WHERE user_email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    //    echo '=>'.$user;exit;  
        if ($user) {
        // Use password_verify to check hashed password
        if (password_verify($password, $user['user_password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email']   = $user['user_email']; // fixed key
            $_SESSION['user_name']   = $user['user_name']; // fixed key

            header("Location: dashboard.php");
            exit;
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found";
    }
    }

} catch (PDOException $e) {
    echo "DB Error: " . $e->getMessage();
}

// Check if the logout action is triggered
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Destroy all session data
    session_unset();    // Unset all session variables
    session_destroy();  // Destroy the session

    // Redirect to the login page
    header("Location: login.php");
    exit;
}