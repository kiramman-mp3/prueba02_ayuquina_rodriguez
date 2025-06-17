<?php
namespace Config;

use PDO;
use Data\MySQL\DataSource as MySQLDataSource;
use Data\Postgres\DataSource as PostgresDataSource;

class DatabaseFactory {
    public static function create(): PDO {
        $settings = include __DIR__ . '/driver.php';
        $driver = $settings['driver'] ?? 'mysql';

        return match ($driver) {
            'mysql' => (new MySQLDataSource(Envs::mysql()))->getConnection(),
            'pgsql' => (new PostgresDataSource(Envs::postgres()))->getConnection(),
            default => throw new \InvalidArgumentException("Unsupported driver '$driver'")
        };
    }
}
