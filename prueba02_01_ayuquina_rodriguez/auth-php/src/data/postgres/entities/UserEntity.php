<?php
namespace Data\Postgres\Entities;

class UserEntity
{
    public function __construct(
        public ?string $id,
        public string  $name,
        public string  $email,
        public string  $password,
        public array   $role,
        public ?string $img = null
    ) {}


    public static function fromArray(array $row): self
    {
        $rolesField = $row['role'];

        if (is_string($rolesField) && str_starts_with($rolesField, '{') && str_ends_with($rolesField, '}')) {
            $trimmed   = trim($rolesField, '{}');
            $roleArray = $trimmed === '' ? [] : explode(',', $trimmed);
        } elseif (is_array($rolesField)) {
            $roleArray = $rolesField;
        } else {
            $roleArray = explode(',', $rolesField);
        }

        return new self(
            $row['id']       ?? null,
            $row['name'],
            $row['email'],
            $row['password'],
            $roleArray,
            $row['img']      ?? null
        );
    }

 
    public function toArray(): array
    {
        $roleLiteral = '{' . implode(',', $this->role) . '}';

        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password,
            'role'     => $roleLiteral,
            'img'      => $this->img,
        ];
    }
}
