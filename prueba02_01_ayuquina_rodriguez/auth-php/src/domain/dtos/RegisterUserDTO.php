<?php
namespace Domain\DTOs;

class RegisterUserDTO {
    public string $name;
    public string $email;
    public string $password;

    private function __construct(string $name, string $email, string $password) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public static function create(array $data): array {
        $name = $data['name'] ?? null;
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? '';

        if (!$name) return ['Missing name'];
        if (!$email) return ['Missing email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return ['Email is not valid'];
        if (strlen($password) < 6) return ['Password too short'];

        return [null, new self($name, $email, $password)];
    }
}
