<?php
namespace Data\MySQL\Entities;

class UserEntity {
    public string $id;
    public string $name;
    public string $email;
    public string $password;
    public array $role;
    public ?string $img;

    public function __construct(
        string $id,
        string $name,
        string $email,
        string $password,
        array $role = ['user'],
        ?string $img = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->img = $img;
    }

    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['password'],
            explode(',', $data['role']),
            $data['img'] ?? null
        );
    }

    public function toArray(): array {
        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password,
            'role'     => implode(',', $this->role),
            'img'      => $this->img,
        ];
    }
}
