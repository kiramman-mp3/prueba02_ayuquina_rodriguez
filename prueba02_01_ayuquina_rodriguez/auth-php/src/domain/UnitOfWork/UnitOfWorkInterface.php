<?php
namespace Domain\UnitOfWork;

interface UnitOfWorkInterface {
    public function beginTransaction(): void;
    public function commit(): void;
    public function rollback(): void;
}