<?php

$host = getenv('MYSQL_ROOT_HOST') ?: getenv('MYSQL_HOST') ?: 'localhost';
$dbName = getenv('MYSQL_DATABASE') ?: 'yii1_catalog';
$user = getenv('MYSQL_USER') ?: 'root';
$password = getenv('MYSQL_PASSWORD') ?: '';

return [
    'connectionString' => 'mysql:host=' . $host . ';dbname=' . $dbName,
    'emulatePrepare' => true,
    'username' => $user,
    'password' => $password,
    'charset' => 'utf8mb4',
];
