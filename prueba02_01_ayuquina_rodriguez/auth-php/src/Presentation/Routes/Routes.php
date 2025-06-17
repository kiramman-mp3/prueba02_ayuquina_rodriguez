<?php
namespace Presentation\Routes;

use Infrastructure\Datasources\AuthDatasourceImpl;
use Infrastructure\Repositories\AuthRepositoryImpl;
use Presentation\Auth\Controller;
use Presentation\Middlewares\AuthMiddleware;

class Routes {

    private Controller $controller;

    public function __construct() {
        $authDatasource = new AuthDatasourceImpl();
        $authRepository = new AuthRepositoryImpl($authDatasource);
        $this->controller = new Controller($authRepository);
    }

    public function handleRequest(): void {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        header("Content-Type: application/json");

        $body = json_decode(file_get_contents('php://input'), true) ?? [];

        if ($uri === '/api/auth/register' && $method === 'POST') {
            $this->controller->registerUser($body);
            return;
        }

        if ($uri === '/api/auth/login' && $method === 'POST') {
            $this->controller->loginUser($body);
            return;
        }

        if ($uri === '/api/auth/profile' && $method === 'GET') {
            $user = AuthMiddleware::validateJWT();
            $this->controller->getUsers($user);
            return;
        }

        http_response_code(404);
        echo json_encode(['error' => 'Route not found']);
    }
}
