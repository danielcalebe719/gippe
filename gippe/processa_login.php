<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bdtcc";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Obtém os dados do formulário
    $email = $_POST["username"] ?? '';
    $senha = $_POST["password"] ?? '';

    // Prepara e executa a consulta SQL para selecionar o cliente com o email fornecido
    $sql = "SELECT idClientes, senha FROM clientes WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($idClientes, $senha_armazenada);
 
    if ($stmt->fetch()) {
        // Senha encontrada, verifica se corresponde à senha fornecida
        if (password_verify($senha, $senha_armazenada)) {
            // Senha correta, inicia a sessão e redireciona para a página de destino
            session_start();
            echo "<script>console.log('estou aqui')</script>";
            $_SESSION['loggedIn'] = true;
            $_SESSION['email'] = $email;
            $_SESSION['idClientes'] = $idClientes;
            header('Location: home.php');
            exit();
        } else {
            // Senha incorreta, redireciona para a página de login com mensagem de erro
            header('Location: login.php?error=senha_incorreta');
            exit();
        }
    } else {
        // Cliente não encontrado para o email fornecido, redireciona para a página de login com mensagem de erro
        header('Location: login.php?error=cliente_nao_encontrado');
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Método de requisição inválido, não redireciona para a página de login
    // Exibe a página de login normalmente
    include 'processa_login.php';
}
?>
