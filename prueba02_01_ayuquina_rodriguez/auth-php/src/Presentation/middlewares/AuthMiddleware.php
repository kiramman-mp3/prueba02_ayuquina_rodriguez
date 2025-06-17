<?php
namespace Presentation\Middlewares;

use Config\JwtAdapter;
use Config\DatabaseFactory;
use Domain\Errors\CustomError;

class AuthMiddleware {
    public static function validateJWT(): ?array {
        $headers = getallheaders();
        $authHeader = $headers['Authorization'] ?? '';

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid or missing token']);
            exit;
        }

        $token = explode(' ', $authHeader)[1] ?? '';

        try {
            $payload = JwtAdapter::validateToken($token);

            if (!$payload || !isset($payload['id'])) {
                http_response_code(401);
                echo json_encode(['error' => 'Invalid token structure']);
                exit;
            }


            $pdo = DatabaseFactory::create();

            $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
            $stmt->execute(['id' => $payload['id']]);
            $user = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$user) {
                http_response_code(404);
                echo json_encode(['error' => 'User not found']);
                exit;
            }

            return $user;

        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal server error', 'details' => $e->getMessage()]);
            exit;
        }
    }
}
