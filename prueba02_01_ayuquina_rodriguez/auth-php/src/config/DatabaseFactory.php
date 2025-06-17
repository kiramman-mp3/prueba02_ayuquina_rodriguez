<?php
namespace Config;

use PDO;
use Config\Driver;
use Config\Envs;

class DatabaseFactory {
    public static function create(): PDO {
        $config = Envs::get();  // Clase Envs centralizada que devuelve array de configuración
        $driver = $config['DB_CONNECTION'] ?? 'mysql';

        return match ($driver) {
            'mysql', 'pgsql' => Driver::getInstance()->getConnection(),
            default => throw new \InvalidArgumentException("Unsupported driver '$driver'")
        };
    }
}