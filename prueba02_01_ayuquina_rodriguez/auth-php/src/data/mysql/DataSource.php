<?php
namespace Data\MySQL;

use PDO;

class DataSource {
    private PDO $conn;

    public function __construct(array $config) {
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']}";
        $this->conn = new PDO($dsn, $config['username'], $config['password']);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection(): PDO {
        return $this->conn;
    }
}
