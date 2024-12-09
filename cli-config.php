<?php
require_once "vendor/autoload.php";
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;
// Caminho para as entidades (pastas com as classes que representam o banco de dados)
// Configuração do Doctrine (produção ou desenvolvimento)
$config = ORMSetup::createAttributeMetadataConfiguration(
    paths: [__DIR__ . '/src/entities'],
    isDevMode: true,
);
$dbParams = [
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost:3306',
    'dbname' => 'ifpr',
];
// Obtém a conexão com o banco de dados
$conn = DriverManager::getConnection($dbParams);
// Criação do EntityManager
$entityManager = new EntityManager($conn, $config);
?>