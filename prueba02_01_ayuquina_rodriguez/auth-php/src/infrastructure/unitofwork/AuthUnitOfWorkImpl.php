<?php
namespace Infrastructure\UnitOfWork;

use Domain\UnitOfWork\UnitOfWork;
use PDO;

class AuthUnitOfWorkImpl implements UnitOfWork {
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
}
