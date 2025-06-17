<?php
namespace Config;

class Validators {
    public static function isEmail(string $email): bool {
        return (bool) preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/', $email);
    }
}
