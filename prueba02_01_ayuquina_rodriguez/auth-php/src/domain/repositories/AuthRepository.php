<?php
namespace Domain\Repositories;

use Domain\DTOs\LoginUserDTO;
use Domain\DTOs\RegisterUserDTO;
use Domain\Entities\UserEntity;

interface AuthRepository {
    public function login(LoginUserDTO $dto): UserEntity;
    public function register(RegisterUserDTO $dto): UserEntity;
    public function add(UserEntity $user): void;

}
