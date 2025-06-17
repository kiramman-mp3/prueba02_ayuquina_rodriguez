<?php
require_once '../controllers/AuthController.php';

if (session_status() === PHP_SESSION_NONE) session_start();

if (!empty($_SESSION['token'])) {
    header('Location: profile.php');
    exit;
}

$controller = new AuthController();
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = $controller->login();
}

require_once '../views/login.view.php';