<?php
namespace Infrastructure\Datasources;

use Config\BcryptAdapter;
use Config\DatabaseFactory;
use Domain\Datasources\AuthDatasource;
use Domain\DTOs\LoginUserDTO;
use Domain\DTOs\RegisterUserDTO;
use Domain\Entities\UserEntity;
use Domain\Errors\CustomError;

class AuthDatasourceImpl implements AuthDatasource {

    private \PDO $conn;

    public function __construct() {
        $this->conn = DatabaseFactory::create(); // ✔ Se usa el factory desacoplado
    }

    public function login(LoginUserDTO $dto): UserEntity {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $dto->email]);
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$data) {
            throw CustomError::badRequest('User does not exist - email');
        }

        if (!BcryptAdapter::compare($dto->password, $data['password'])) {
            throw CustomError::badRequest('Invalid password');
        }

        return UserEntity::fromArray($data);
    }

    public function register(RegisterUserDTO $dto): UserEntity {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $dto->email]);
        if ($stmt->fetch(\PDO::FETCH_ASSOC)) {
            throw CustomError::badRequest('Email already in use');
        }

        $stmt = $this->conn->prepare("
            INSERT INTO users (id, name, email, password, role)
            VALUES (:id, :name, :email, :password, :role)
        ");

        $id = uniqid('', true);
        $hashedPassword = BcryptAdapter::hash($dto->password);
        $role = 'user';

        $stmt->execute([
            'id'       => $id,
            'name'     => $dto->name,
            'email'    => $dto->email,
            'password' => $hashedPassword,
            'role'     => $role
        ]);

        return new UserEntity($id, $dto->name, $dto->email, $hashedPassword, [$role]);
    }
}
