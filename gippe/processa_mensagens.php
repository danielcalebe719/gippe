<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdTcc";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verifica se os dados do formulário foram enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém e escapa os dados do formulário
    $nome = $conn->real_escape_string($_POST['nome']);
    $endereco = $conn->real_escape_string($_POST['endereco']);
    $assunto = $conn->real_escape_string($_POST['assunto']);
    $mensagem = $conn->real_escape_string($_POST['mensagem']);

    // Prepara e vincula
    $stmt = $conn->prepare("INSERT INTO mensagens (nome, endereco, assunto, mensagem) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $endereco, $assunto, $mensagem);

    // Executa a inserção
    if ($stmt->execute()) {
        // Se a execução foi bem-sucedida, exibe a mensagem de sucesso
        echo '<div class="sent-message d-block">Mensagem enviada com sucesso!</div>';
        
    } else {
        echo "Error: " . $stmt->error; 
    }

    // Fecha a conexão
    $stmt->close();
} else {
    echo "Por favor, envie o formulário.";
}

$conn->close();
?>