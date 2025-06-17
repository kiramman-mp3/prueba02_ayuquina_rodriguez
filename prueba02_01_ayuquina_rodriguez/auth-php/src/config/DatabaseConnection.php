<?php
namespace Config;

use PDO;

class DatabaseConnection {
    private static ?PDO $instance = null;

    public static function getInstance(): PDO {
        if (self::$instance === null) {
            $driver = require __DIR__ . '/driver.php';

            $envs = match ($driver) {
                'mysql'    => Envs::mysql(),
                'postgres' => Envs::postgres(),
            };

            $dsn = match ($driver) {
                'mysql'    => "mysql:host={$envs['host']};dbname={$envs['dbname']};charset=utf8",
                'postgres' => "pgsql:host={$envs['host']};port={$envs['port']};dbname={$envs['dbname']}",
            };

            self::$instance = new PDO($dsn, $envs['username'], $envs['password']);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return self::$instance;
    }
}
