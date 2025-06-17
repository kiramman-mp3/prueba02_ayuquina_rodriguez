<?php
namespace Infrastructure\Repositories;

use Domain\Repositories\AuthRepository;
use Domain\Datasources\AuthDatasource;
use Domain\DTOs\LoginUserDTO;
use Domain\DTOs\RegisterUserDTO;
use Domain\Entities\UserEntity;

class AuthRepositoryImpl implements AuthRepository {

    public function __construct(
        private AuthDatasource $authDatasource
    ) {}

    public function login(LoginUserDTO $dto): UserEntity {
        return $this->authDatasource->login($dto);
    }

    public function register(RegisterUserDTO $dto): UserEntity {
        return $this->authDatasource->register($dto);
    }
    public function add(UserEntity $user): void {
    $stmt = $this->authDatasource->getConnection()->prepare(
        "INSERT INTO users (id, name, email, password, role) VALUES (:id, :name, :email, :password, :role)"
    );
    $stmt->execute([
        'id'       => $user->getId(),
        'name'     => $user->getName(),
        'email'    => $user->getEmail(),
        'password' => $user->getPassword(),
        'role'     => $user->getRoles()[0] ?? 'user'
    ]);
}

    

    
    
}
