<?php

// Activar CORS si es necesario
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// Manejar preflight OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Autoload Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Cargar router
use Presentation\Routes\Routes;

$router = new Routes();
$router->handleRequest();
