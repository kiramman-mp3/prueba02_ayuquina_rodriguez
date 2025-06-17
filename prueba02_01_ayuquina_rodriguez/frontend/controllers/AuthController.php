<?php
require_once __DIR__ . '/../api/ApiRest.php';

class AuthController {

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirmPassword'] ?? '';

            if ($password !== $confirm) {
                return 'Las contraseñas no coinciden.';
            }
            

            $response = ApiRest::registerUser($name, $email, $password);

            if (!isset($response['error'])) {
                if (session_status() === PHP_SESSION_NONE) session_start();
                $_SESSION['token'] = $response['token'];
                header('Location: ../routes/login.php');
                exit;
            } else {
                return $response['error'];
            }
        }

        return null;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
    
            $response = ApiRest::loginUser($email, $password);
    
            if (!isset($response['error'])) {
                if (session_status() === PHP_SESSION_NONE) session_start();
                $_SESSION['token'] = $response['token'];
                header('Location: ../routes/profile.php');
                exit;
            } else {
                return $response['error'];
            }
        }
    
        return null;
    }
    

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_destroy();
        header('Location: ../routes/login.php');
        exit;
    }
}
