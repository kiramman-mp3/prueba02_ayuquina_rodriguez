<?php
namespace Domain\Entities;

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
        array $role,
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
    public function getId(): string {
    return $this->id;
}

public function getName(): string {
    return $this->name;
}

public function getEmail(): string {
    return $this->email;
}

public function getPassword(): string {
    return $this->password;
}

public function getRoles(): array {
    return $this->role;
}

public function getImg(): ?string {
    return $this->img;
}

}
