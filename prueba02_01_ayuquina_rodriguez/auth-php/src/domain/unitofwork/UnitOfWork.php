<?php
namespace Domain\UnitOfWork;

interface UnitOfWork {
    public function beginTransaction(): void;
    public function commit(): void;
    public function rollback(): void;
}
