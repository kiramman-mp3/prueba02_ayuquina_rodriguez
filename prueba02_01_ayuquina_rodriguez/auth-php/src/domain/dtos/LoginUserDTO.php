<?php
namespace Domain\DTOs;

class LoginUserDTO {
    public string $email;
    public string $password;

    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public static function create(array $data): array {
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? '';

        if (!$email) return ['Missing email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return ['Email is not valid'];
        if (strlen($password) < 6) return ['Password too short'];

        return [null, new self($email, $password)];
    }
}
