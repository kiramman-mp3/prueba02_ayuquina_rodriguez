<?php
namespace Domain\Datasources;

use Domain\DTOs\LoginUserDTO;
use Domain\DTOs\RegisterUserDTO;
use Domain\Entities\UserEntity;

interface AuthDatasource {
    public function login(LoginUserDTO $dto): UserEntity;
    public function register(RegisterUserDTO $dto): UserEntity;
    public function getConnection(): \PDO;


}
