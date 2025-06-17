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
}
