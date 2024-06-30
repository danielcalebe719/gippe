<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['user'];
    $senha = $_POST['senha'];

    // Verifica o usuário e a senha diretamente na consulta SQL
    $stmt = $conn->prepare("SELECT idFuncionario FROM funcionarios WHERE email = ? AND senha = ?");
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $stmt->store_result();

    // Se encontrar o usuário com a senha correspondente
    if ($stmt->num_rows > 0) {
        // Registra o nome do usuário em sessão
        $stmt->bind_result($email);
        $stmt->fetch();

        $_SESSION['user'] = $email;
        
        
        header('Location: painel-operacional.html');
        exit();
    } else {
        echo "<script>alert('Usuário ou senha incorretos!');location.href=\"index.html\";</script>";
    }

    $stmt->close();
} else {
    
    header('Location: index.html');
    exit();
}

$conn->close();
?>