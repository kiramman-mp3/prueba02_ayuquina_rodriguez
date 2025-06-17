<?php
namespace Config;

class Envs {
    public static function mysql(): array {
        return [
            'host' => 'localhost',
            'port' => 3306,
            'username' => 'root',
            'password' => '',
            'dbname' => 'node_auth'
        ];
    }

    public static function postgres(): array {
        return [
            'host' => 'localhost',
            'port' => 5432,
            'username' => 'postgres',
            'password' => 'Angel_4220',
            'dbname' => 'auth_db'
        ];
    }

    public static function jwt(): string {
        return 'aqui_va_tu_clave_secreta_segura';
    }
}
