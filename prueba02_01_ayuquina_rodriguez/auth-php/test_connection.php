<?php
require_once __DIR__ . '/src/config/Envs.php';
require_once __DIR__ . '/src/data/postgres/DataSource.php';

use Data\Postgres\DataSource;
use Config\Envs;

try {
    $config = Envs::postgres();
    $pg = new DataSource($config);
    $conn = $pg->getConnection();

    $stmt = $conn->query("SELECT version()");
    $version = $stmt->fetchColumn();

    echo "✅ Conexión exitosa a PostgreSQL: $version";
} catch (Throwable $e) {
    echo "❌ Error: " . $e->getMessage();
}
