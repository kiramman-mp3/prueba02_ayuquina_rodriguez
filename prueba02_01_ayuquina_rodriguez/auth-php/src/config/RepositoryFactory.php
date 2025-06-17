<?php
namespace Config;

use Infrastructure\Repositories\AuthRepositoryImpl;
use Infrastructure\Datasources\AuthDatasourceImpl;
use Domain\Repositories\AuthRepository;

class RepositoryFactory {
    public static function createAuthRepository(): AuthRepository {
        $conn = DatabaseConnection::getInstance();
        $datasource = new AuthDatasourceImpl($conn);
        return new AuthRepositoryImpl($datasource);
    }
}
