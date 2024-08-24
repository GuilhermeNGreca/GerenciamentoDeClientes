<?php
session_start();
require '../DB/config.php';

// Verifique se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Verificar se o ID do cliente foi passado
if (isset($_POST['clientId'])) {
    $clientId = $_POST['clientId'];

    // Excluir o cliente do banco de dados
    try {
        $stmt = $pdo->prepare("DELETE FROM clients WHERE id = :id");
        $stmt->bindParam(':id', $clientId, PDO::PARAM_INT);
        $stmt->execute();

        echo 'Cliente excluído com sucesso!';
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
} else {
    echo 'ID do cliente não fornecido.';
}
?>