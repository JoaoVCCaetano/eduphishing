<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();
$dotenv->required(['AWS_ACCESS_KEY_ID', 'AWS_SECRET_ACCESS_KEY', 'AWS_REGION']);
# Garanta que todas as variáveis carregadas pelo dotenv também fiquem disponíveis para o getenv().
foreach ($_ENV as $key => $value) {
    putenv("$key=$value");
}

return [
    'db' => [
        'host' => $_ENV['MYSQL_HOST'],
        'dbname' => $_ENV['MYSQL_DATABASE'],
        'user' => $_ENV['MYSQL_USER'],
        'pass' => $_ENV['MYSQL_PASSWORD']
    ]
];
