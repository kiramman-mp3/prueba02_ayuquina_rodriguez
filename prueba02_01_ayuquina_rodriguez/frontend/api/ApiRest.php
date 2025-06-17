<?php
if (session_status() === PHP_SESSION_NONE) session_start();

define('API_BASE_URL', 'http://localhost:3000/api/auth');

class ApiRest {

    public static function registerUser($name, $email, $password) {
        return self::post('/register', [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }

    public static function loginUser($email, $password) {
        return self::post('/login', [
            'email' => $email,
            'password' => $password
        ]);
    }

    public static function getProfile() {
        return self::get('/profile');
    }

    // ✅ POST con manejo de errores HTTP
    private static function post($endpoint, $data) {
        $url = API_BASE_URL . $endpoint;

        $headers = ['Content-Type: application/json'];
        if (!empty($_SESSION['token'])) {
            $headers[] = 'Authorization: Bearer ' . $_SESSION['token'];
        }

        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => implode("\r\n", $headers),
                'content' => json_encode($data),
                'ignore_errors' => true // ← CLAVE para que file_get_contents lea respuesta aunque sea 400
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === false) {
            return ['error' => 'No se pudo conectar con el backend'];
        }

        $response = json_decode($result, true);
        $httpCode = self::getHttpResponseCode($http_response_header);

        if ($httpCode >= 400) {
            return ['error' => $response['error'] ?? "Error HTTP $httpCode"];
        }

        return $response;
    }

    // ✅ GET con manejo de errores HTTP
    private static function get($endpoint) {
        $url = API_BASE_URL . $endpoint;

        if (empty($_SESSION['token'])) {
            return ['error' => 'No token'];
        }

        $headers = ['Authorization: Bearer ' . $_SESSION['token']];

        $options = [
            'http' => [
                'method' => 'GET',
                'header' => implode("\r\n", $headers),
                'ignore_errors' => true
            ]
        ];

        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === false) {
            return ['error' => 'No se pudo conectar con el backend'];
        }

        $response = json_decode($result, true);
        $httpCode = self::getHttpResponseCode($http_response_header);

        if ($httpCode >= 400) {
            return ['error' => $response['error'] ?? "Error HTTP $httpCode"];
        }

        return $response;
    }

    // ✅ Extrae el código HTTP del encabezado
    private static function getHttpResponseCode($headers) {
        foreach ($headers as $header) {
            if (preg_match('#HTTP/\d+\.\d+\s+(\d+)#', $header, $matches)) {
                return (int)$matches[1];
            }
        }
        return 0;
    }
}
