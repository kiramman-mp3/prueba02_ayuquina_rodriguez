<?php

require_once __DIR__ . '/../src/config/Envs.php';
require_once __DIR__ . '/../src/config/driver.php';
require_once __DIR__ . '/../src/config/DatabaseFactory.php';
require_once __DIR__ . '/../src/data/mysql/DataSource.php';
require_once __DIR__ . '/../src/data/postgres/DataSource.php';

use Config\DatabaseFactory;

// Conexión desacoplada (según driver.php)
$pdo = DatabaseFactory::create();
