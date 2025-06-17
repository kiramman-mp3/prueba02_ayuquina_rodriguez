<?php
namespace Infrastructure\Datasources;

use Config\DatabaseFactory;
use Domain\Datasources\mysql\AuthDatasource;
use Domain\DTOs\LoginUserDTO;
use Domain\DTOs\RegisterUserDTO;
use Domain\Entities\UserEntity;
use PDO;
use Exception;

class AuthDatasourceImpl implements AuthDatasource {

    private PDO $conn;

    public function __construct() {
        $this->conn = DatabaseFactory::create();
    }

    public function register(RegisterUserDTO $dto): UserEntity {
        // Verificamos si el email ya existe
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$dto->email]);

        if ($stmt->fetch()) {
            throw new Exception("El email ya está registrado.");
        }

        // Insertamos nuevo usuario
        $stmt = $this->conn->prepare("INSERT INTO users (id, name, email, password, role, img) VALUES (?, ?, ?, ?, ?, ?)");

        $hashedPassword = password_hash($dto->password, PASSWORD_BCRYPT);

        $stmt->execute([
            $dto->id,
            $dto->name,
            $dto->email,
            $hashedPassword,
            $dto->role ?? 'user',
            $dto->img ?? null
        ]);

        return new UserEntity(
            $dto->id,
            $dto->name,
            $dto->email,
            $dto->role ?? 'user',
            $dto->img ?? null
        );
    }

    public function login(LoginUserDTO $dto): UserEntity {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$dto->email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($dto->password, $user['password'])) {
            throw new Exception("Credenciales inválidas");
        }

        return new UserEntity(
            $user['id'],
            $user['name'],
            $user['email'],
            $user['role'],
            $user['img']
        );
    }
}