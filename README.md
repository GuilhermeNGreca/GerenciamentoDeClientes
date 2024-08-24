# Sistema de Gerenciamento de Clientes

Este projeto é um Sistema de Gerenciamento de Clientes, desenvolvido para permitir que um administrador gerencie os dados de seus clientes de maneira eficiente.

## Funcionalidades

- **Cadastro e Login:** O administrador pode se cadastrar utilizando um nome de usuário e senha. Após o cadastro, ele pode realizar o login para acessar a área de gerenciamento de clientes.
- **Gerenciamento de Clientes:** Após o login, o administrador terá acesso a uma página onde é possível:
  - **Adicionar novos clientes** com informações como nome, documento, telefone, e-mail e endereço.
  - **Editar os dados de clientes existentes**.
  - **Deletar clientes** da lista.

## Requisitos

- **Banco de Dados:** Este projeto utiliza MySQL como banco de dados. As configurações necessárias podem ser encontradas no arquivo `DB/config.php`. Recomenda-se o uso do DBeaver para gerenciar e realizar alterações no banco de dados.
- **Ambiente de Desenvolvimento:** O projeto roda em um ambiente local utilizando o [XAMPP](https://www.apachefriends.org/index.html), que inclui o servidor Apache e o MySQL.

## Como Executar o Projeto

1. **Configurar o Banco de Dados:**

   - Crie um banco de dados MySQL conforme as instruções no arquivo `DB/config.php`.
   - Utilize o DBeaver para aplicar as alterações e gerenciar o banco de dados conforme necessário.

2. **Iniciar o XAMPP:**

   - Abra o XAMPP e inicie os serviços do **Apache** e do **MySQL**.

3. **Executar o Projeto:**
   - Coloque os arquivos do projeto na pasta `htdocs` do XAMPP.
   - Acesse o projeto pelo navegador, utilizando o endereço `http://localhost/nome_do_projeto`.
