<?php
namespace Config;

use PDO;

class Driver {
    private static ?Driver $instance = null;
    private PDO $connection;

    private function __construct() {
        $config = Envs::get();
        $this->connection = new PDO(
            "mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']}",
            $config['DB_USER'],
            $config['DB_PASS']
        );
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(): Driver {
        if (self::$instance === null) {
            self::$instance = new Driver();
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->connection;
    }
}