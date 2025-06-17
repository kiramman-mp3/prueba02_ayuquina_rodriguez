<?php
require_once __DIR__ . '/../api/ApiRest.php';
if (session_status() === PHP_SESSION_NONE) session_start();

$response = ApiRest::getProfile();
$user = $response['user'] ?? null;

if (!isset($user['id'])) {
    session_destroy();
    header('Location: login.php');
    exit;
}
