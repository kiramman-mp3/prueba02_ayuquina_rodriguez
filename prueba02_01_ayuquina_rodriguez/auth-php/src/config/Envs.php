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
            'password' => 'S1805787841',
            'dbname' => 'node_auth'
        ];
    }

    public static function jwt(): string {
        return '95a2a4ada62c2a93e5fafd7277bd1373ec96a5c4f6849ee7f1008502a14394bf';
    }
}
