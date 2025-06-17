<?php
namespace Config;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Config\Envs;

class JwtAdapter {

    public static function generateToken(array $payload, string $duration = '2h'): ?string {
        $payload['exp'] = time() + self::parseDuration($duration);
        return JWT::encode($payload, Envs::jwt(), 'HS256');
    }

    public static function validateToken(string $token): ?array {
        try {
            return (array) JWT::decode($token, new Key(Envs::jwt(), 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }

    private static function parseDuration(string $duration): int {
        if (str_ends_with($duration, 'h')) {
            return (int)$duration * 3600;
        }
        if (str_ends_with($duration, 'm')) {
            return (int)$duration * 60;
        }
        return 7200; 
    }
}
