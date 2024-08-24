<?php
session_start();
require '../DB/config.php';

// Verifique se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Receber os dados do formulário sem sanitização
    $clientId = $_POST['clientId'];
    $name = $_POST['name'];
    $document = $_POST['document'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    if (!empty($clientId)) {
        // Atualizar o cliente existente
        $stmt = $pdo->prepare("UPDATE clients SET name = ?, document = ?, phone = ?, email = ?, address = ? WHERE id = ?");
        $stmt->execute([$name, $document, $phone, $email, $address, $clientId]);
    } else {
        // Adicionar um novo cliente
        $stmt = $pdo->prepare("INSERT INTO clients (name, document, phone, email, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $document, $phone, $email, $address]);
    }

    // Redirecionar ou manter a página
    header("Location: index.php");
    exit();
}
?>