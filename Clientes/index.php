<?php
session_start();
require '../DB/config.php';

// Verifique se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Consultar os dados dos clientes no banco de dados
try {
    $stmt = $pdo->query("SELECT * FROM clients");
    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SGC</title>
  <link rel="stylesheet" href="../Clientes/clientes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
  <div class="style-default">
    <div class="style-default">
      <button onclick="window.location.href='../Login/login.php'">Logout</button>
      <span>Sistema de Gerenciamento de Clientes</span>
      <button onclick="openModal()">Incluir</button>
    </div>

    <div class="style-default">
      <table>
        <thead class="dados">
          <tr>
            <th>Nome</th>
            <th>Documento</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Endereço</th>
            <th>Editar</th>
            <th>Excluir</th>
          </tr>
        </thead>

        <tbody class="dados">
          <?php foreach ($clients as $client): ?>
          <tr>
            <td><?php echo $client['name']; ?></td>
            <td><?php echo $client['document']; ?></td>
            <td><?php echo $client['phone']; ?></td>
            <td><?php echo $client['email']; ?></td>
            <td><?php echo $client['address']; ?></td>
            <td>
              <button
                onclick="editModal('<?php echo $client['id']; ?>', '<?php echo $client['name']; ?>', '<?php echo $client['document']; ?>', '<?php echo $client['phone']; ?>', '<?php echo $client['email']; ?>', '<?php echo $client['address']; ?>')"
                type="button" class="edit-button">
                <i class="fas fa-pen"></i>
              </button>
            </td>
            <td>
              <button onclick="deleteClient('<?php echo $client['id']; ?>')" type="button" class="delete-button">
                <i class="fas fa-trash-alt"></i>
              </button>
            </td>

          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div id="modal" class="modal-container">
      <div class="modal-form">
        <span onclick="closeModal()" class="close">&times;</span>
        <h1>Adicionar Cliente</h1>
        <form id="clientForm" action="addClients.php" method="POST">
          <input type="hidden" id="clientId" name="clientId">

          <label for="name">Nome:</label>
          <input type="text" id="name" name="name" required>

          <label for="document">Documento:</label>
          <input type="number" id="document" name="document" required>

          <label for="phone">Telefone:</label>
          <input type="text" id="phone" name="phone" required>

          <label for="email">E-mail:</label>
          <input type="email" id="email" name="email" required>

          <label for="address">Endereço:</label>
          <input type="text" id="address" name="address" required>

          <button type="submit">Salvar</button>
        </form>
      </div>
    </div>

  </div>

  <script>
  function openModal() {
    document.getElementById('modal').style.display = 'flex';
  }

  function closeModal() {
    document.getElementById('modal').style.display = 'none';
  }

  function editModal(id, name, documentValue, phone, email, address) {
    document.getElementById('clientId').value = id;
    document.getElementById('name').value = name;
    document.getElementById('document').value = documentValue;
    document.getElementById('phone').value = phone;
    document.getElementById('email').value = email;
    document.getElementById('address').value = address;

    // Exibir o modal
    document.getElementById('modal').style.display = 'flex';
  }

  function deleteClient(clientId) {
    if (confirm('Tem certeza que deseja excluir este cliente?')) {
      fetch('deleteClient.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: new URLSearchParams({
            'clientId': clientId
          })
        })
        .then(response => response.text())
        .then(result => {
          location.reload();
        })
        .catch(error => console.error('Erro ao excluir cliente:', error));
    }
  }
  </script>
</body>

</html>