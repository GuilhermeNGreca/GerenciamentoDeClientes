<?php
session_start();
require '../DB/config.php';

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar se o usuário existe
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header("Location: ../Clientes/index.php");
        exit();
    } else {
        $error = "Nome de usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="../Login/login.css">
</head>

<body>
  <div class="container">
    <h2>Login</h2>
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
      <button type="submit">Entrar</button>
    </form>
    <p>Não tem uma conta? <a href="../Cadastro/cadastro.php">Cadastre-se aqui</a></p>
  </div>
</body>

</html>