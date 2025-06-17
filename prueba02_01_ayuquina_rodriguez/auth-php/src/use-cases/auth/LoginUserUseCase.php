<?php
namespace UseCases\Auth;

use Domain\DTOs\LoginUserDTO;
use Domain\Repositories\AuthRepository;
use Domain\Errors\CustomError;
use Config\JwtAdapter;

class LoginUserUseCase {

    public function __construct(
        private AuthRepository $authRepository,
        private $signToken = [JwtAdapter::class, 'generateToken'] 
    ) {}

    public function execute(LoginUserDTO $dto): array {
        $user = $this->authRepository->login($dto);

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
