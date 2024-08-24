<?php
$host = 'localhost'; 
$db = 'sgc'; 
$user = 'root'; 
$pass = ''; 

try {
    // Conectar ao MySQL
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar banco de dados se não existir
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $db");
    $pdo->exec("USE $db");

    // Criar tabela de usuários se não existir
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )
    ");

    // Criar tabela de clientes se não existir
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS clients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            document VARCHAR(50) NOT NULL UNIQUE,
            phone VARCHAR(20),
            email VARCHAR(100),
            address TEXT
        )
    ");
    
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>