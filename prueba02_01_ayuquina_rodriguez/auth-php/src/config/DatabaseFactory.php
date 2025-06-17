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
            'mysql' => MySQLDataSource::getInstance(Envs::mysql())->getConnection(),
            'pgsql' => PostgresDataSource::getInstance(Envs::postgres())->getConnection(),
            default => throw new \InvalidArgumentException("Unsupported driver '$driver'")
        };
    }
}
