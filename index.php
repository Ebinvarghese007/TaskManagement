<?php
session_start();
require_once 'config.php';

// Example: check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

