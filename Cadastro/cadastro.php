<?php
require '../DB/config.php';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar se o nome de usuário já existe
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        $error = "Nome de usuário já existe.";
    } else {
        // Inserir novo usuário no banco de dados
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt->execute([$username, $hashedPassword])) {
            header("Location: ../Login/login.php");
            exit();
        } else {
            $error = "Erro ao cadastrar o usuário.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Cadastro</title>
  <link rel="stylesheet" href="../Cadastro/cadastro.css">
</head>

<body>
  <div class="container">
    <h2>Cadastro</h2>
    <?php if (isset($error)) { echo '<p class="error">' . $error . '</p>'; } ?>
    <form method="POST">
      <div class="input-group">
        <label for="username">Nome de Usuário:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="input-group">
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Cadastrar</button>
    </form>
    <p>Já tem uma conta? <a href="../Login/login.php">Faça login aqui</a></p>
  </div>
</body>

</html>