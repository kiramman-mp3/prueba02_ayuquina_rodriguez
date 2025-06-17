<?php
namespace Config;

class BcryptAdapter {
    public static function hash(string $password): string {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function compare(string $password, string $hashed): bool {
        return password_verify($password, $hashed);
    }
}
