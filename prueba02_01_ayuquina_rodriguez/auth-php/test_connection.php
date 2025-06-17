<?php
require_once __DIR__ . '/src/config/Envs.php';
require_once __DIR__ . '/src/data/postgres/DataSource.php';
require_once __DIR__ . '/src/data/mysql/DataSource.php';

use Data\Postgres\DataSource as PostgresDataSource;
use Data\MySQL\DataSource as MySQLDataSource;
use Config\Envs;

// Obtener el driver configurado
$settings = include __DIR__ . '/src/config/driver.php';
$driver = $settings['driver'] ?? 'mysql';

echo "Probando conexión a base de datos ($driver)...\n\n";

try {
    // Configurar la conexión según el driver
    switch ($driver) {
        case 'pgsql':
            $config = Envs::postgres();
            $dataSource = new PostgresDataSource($config);
            break;
        case 'mysql':
            $config = Envs::mysql();
            $dataSource = new MySQLDataSource($config);
            break;
        default:
            throw new Exception("Driver no soportado: $driver");
    }

    // Probar la conexión
    $conn = $dataSource->getConnection();
    $stmt = $conn->query("SELECT version()");
    $version = $stmt->fetchColumn();
    echo "✅ Conexión exitosa a " . ($driver === 'pgsql' ? 'PostgreSQL' : 'MySQL') . ": $version\n";
} catch (Throwable $e) {
    echo "❌ Error de conexión: " . $e->getMessage() . "\n";
}
