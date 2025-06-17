<?php
namespace Infrastructure\UnitOfWork;

use Domain\UnitOfWork\UnitOfWorkInterface;
use PDO;

class MySQLUnitOfWork implements UnitOfWorkInterface {
    private PDO $conn;

    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    public function beginTransaction(): void {
        $this->conn->beginTransaction();
    }

    public function commit(): void {
        $this->conn->commit();
    }

    public function rollback(): void {
        $this->conn->rollBack();
    }

    public function getConnection(): PDO {
        return $this->conn;
    }
}
