<?php
session_start();
// echo "123";
require_once 'config.php';

// Example: check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

 header("Location: dashboard.php");