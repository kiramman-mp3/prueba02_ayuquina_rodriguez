<?php
namespace Config;
class Envs
{
    public static function get()
    {
        return [
            'DB_HOST' => 'localhost',
            'DB_NAME' => 'auth_db',
            'DB_USER' => 'root',
            'DB_PASS' => '',
            'DB_CONNECTION' => 'mysql'
        ];
    }
}