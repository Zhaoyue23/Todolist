<?php

$dsn = 'mysql:host=127.0.0.1;dbname=todolist_db;charset=utf8';
$user = 'root';
$pass = '1234';

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
