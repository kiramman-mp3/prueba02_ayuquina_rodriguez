<?php
namespace Data\Postgres;

use PDO;
use PDOException;

class DataSource {
    private static ?DataSource $instance = null;
    private PDO $conn;

    private function __construct(array $config) {
        $dsn = "pgsql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
        $this->conn = new PDO($dsn, $config['username'], $config['password']);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(array $config): self {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    public function getConnection(): PDO {
        return $this->conn;
    }
}
