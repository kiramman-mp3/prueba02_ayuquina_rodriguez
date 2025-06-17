<?php
namespace UseCases\Auth;

use Domain\DTOs\RegisterUserDTO;
use Domain\Repositories\AuthRepository;
use Domain\Errors\CustomError;
use Config\JwtAdapter;

class RegisterUserUseCase {

    public function __construct(
        private AuthRepository $authRepository,
        private $signToken = [JwtAdapter::class, 'generateToken']
    ) {}

    public function execute(RegisterUserDTO $dto): array {
        $user = $this->authRepository->register($dto);

        $token = call_user_func($this->signToken, ['id' => $user->id], '2h');

        if (!$token) {
            throw CustomError::internalServer('Error generating token');
        }

        return [
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email
            ]
        ];
    }
}
