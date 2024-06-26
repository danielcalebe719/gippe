<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos obrigatórios foram preenchidos
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
        // Conexão com o banco de dados (substitua pelos seus dados)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bdtcc";

        // Cria uma conexão
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Captura os dados do formulário
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        // Verifica se as senhas coincidem
        if ($password !== $confirm_password) {
            echo json_encode(array('success' => false, 'message' => 'As senhas não coincidem.'));
        } else {
            // Criptografa a senha
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insere os dados no banco de dados
            $sql = "INSERT INTO clientes (email, senha) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                echo json_encode(array('success' => false, 'message' => 'Erro ao preparar a consulta: ' . $conn->error));
                $conn->close();
                exit();
            }

            $stmt->bind_param("ss", $username, $hashed_password);
            if ($stmt->execute() === TRUE) {
                echo json_encode(array('success' => true, 'message' => 'Cadastro realizado com sucesso!'));
            } else {
                echo json_encode(array('success' => false, 'message' => 'Erro ao cadastrar: ' . $stmt->error));
            }

            $stmt->close();
        }

        // Fecha a conexão
        $conn->close();
    } else {
        echo json_encode(array('success' => false, 'message' => 'Por favor, preencha todos os campos obrigatórios.'));
    }
}
?>
