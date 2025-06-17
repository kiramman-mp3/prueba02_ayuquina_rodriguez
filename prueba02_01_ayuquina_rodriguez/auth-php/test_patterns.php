<?php
require_once __DIR__ . '/vendor/autoload.php';

use Config\RepositoryFactory;
use Infrastructure\UnitOfWork\AuthUnitOfWorkImpl;
use Domain\Entities\UserEntity;

// Repositorio creado con Factory Method
$authRepo = RepositoryFactory::createAuthRepository();
$conn = \Config\DatabaseConnection::getInstance();

// Singleton comprobación
$conn2 = \Config\DatabaseConnection::getInstance();
echo $conn === $conn2 ? "Singleton OK: misma instancia PDO\n" : "Fallo Singleton\n";

// Unit of Work
$unitOfWork = new AuthUnitOfWorkImpl($conn);
try {
    $unitOfWork->beginTransaction();
    $id = uniqid();
    $user = new UserEntity($id, 'Test', 'test@ejemplo.com', 'clave123', ['USER']);
    $authRepo->add($user); // debes implementar el método add() en AuthRepository
    $unitOfWork->commit();
    echo "Usuario registrado con ID $id\n";
} catch (\Throwable $e) {
    $unitOfWork->rollback();
    echo "Error en UnitOfWork: " . $e->getMessage();
}
