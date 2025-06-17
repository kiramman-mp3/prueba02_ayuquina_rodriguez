<?php
namespace Presentation\Auth;

use Domain\DTOs\LoginUserDTO;
use Domain\DTOs\RegisterUserDTO;
use Domain\Errors\CustomError;
use Domain\Repositories\AuthRepository;
use UseCases\Auth\LoginUserUseCase;
use UseCases\Auth\RegisterUserUseCase;

class Controller {

    public function __construct(
        private AuthRepository $authRepository
    ) {}

    private function handleError($error): void {
        http_response_code(500);
        echo json_encode([
            'error' => $error instanceof CustomError ? $error->getMessage() : 'Internal Server Error',
            'details' => $error->getMessage(),
            'trace' => $error->getTraceAsString()
        ]);
        exit;
    }
    
    public function registerUser(array $body): void {
        [$error, $dto] = RegisterUserDTO::create($body);

        if ($error) {
            http_response_code(400);
            echo json_encode(['error' => $error]);
            return;
        }

        try {
            $useCase = new RegisterUserUseCase($this->authRepository);
            $result = $useCase->execute($dto);
            echo json_encode($result);
        } catch (\Throwable $e) {
            $this->handleError($e);
        }
    }

    public function loginUser(array $body): void {
        [$error, $dto] = LoginUserDTO::create($body);

        if ($error) {
            http_response_code(400);
            echo json_encode(['error' => $error]);
            return;
        }

        try {
            $useCase = new LoginUserUseCase($this->authRepository);
            $result = $useCase->execute($dto);
            echo json_encode($result);
        } catch (\Throwable $e) {
            $this->handleError($e);
        }
    }

    public function getUsers(array $user): void {
        echo json_encode([
            'msg' => 'El Token válido ✅',
            'user' => $user
        ]);
    }
}
