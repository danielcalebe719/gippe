<?php
session_start();
include("conecta.php");

// Verifica se o usuário está logado e se o ID do cliente está na sessão
if (!isset($_SESSION['idClientes'])) {
    header("Location: login.php");
    exit();
}

// Criar conexão
$conexao = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}

// Obter o ID do cliente da sessão
$idCliente = $_SESSION['idClientes'];

// Verificar se o cadastro está completo
$sqlVerificarCadastro = "SELECT nome, cpf, dataNascimento FROM clientes WHERE idClientes = ?";
$stmtVerificarCadastro = $conexao->prepare($sqlVerificarCadastro);
$stmtVerificarCadastro->bind_param("i", $idCliente);
$stmtVerificarCadastro->execute();
$resultVerificarCadastro = $stmtVerificarCadastro->get_result();
$cliente = $resultVerificarCadastro->fetch_assoc();

// Verificar se todos os campos obrigatórios estão preenchidos
if (!empty($cliente['nome']) && !empty($cliente['cpf']) && !empty($cliente['dataNascimento'])) {
    // Verificar se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar se todos os campos obrigatórios foram preenchidos
        if (!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['dob']) && !empty($_POST['cep']) && !empty($_POST['endereco']) && !empty($_POST['numero']) && !empty($_POST['bairro']) && !empty($_POST['city'])) {
            // Redirecionar para servicos.php se todos os campos estiverem preenchidos
            header("Location: servicos.php");
            exit();
        } else {
            // Caso contrário, exibir uma mensagem de erro ou realizar outra ação desejada
            echo "Todos os campos obrigatórios devem ser preenchidos.";
        }
    }
} else {
    // Caso o cadastro não esteja completo, exibir uma mensagem ou redirecionar para completar o cadastro
    echo "Por favor, complete seu cadastro antes de prosseguir.";
}


// Consulta para obter os dados do endereço do cliente
$sqlEnderecoCliente = "SELECT tipo, cep, rua, numero, complemento, bairro, cidade FROM EnderecosClientes WHERE idClientes = ?";
$stmtEnderecoCliente = $conexao->prepare($sqlEnderecoCliente);
$stmtEnderecoCliente->bind_param("i", $idCliente);
$stmtEnderecoCliente->execute();
$resultEnderecoCliente = $stmtEnderecoCliente->get_result();

// Verifica se o endereço do cliente existe no banco de dados
if ($resultEnderecoCliente->num_rows > 0) {
    // Preenche a variável $endereco com os dados do endereço do cliente
    $endereco = $resultEnderecoCliente->fetch_assoc();
} else {
    // Se não houver dados de endereço para o cliente, defina $endereco como um array vazio
    $endereco = array();
}

// Array associativo com os campos do formulário e os respectivos valores do cliente
$formularioDados = array(
    'nome' => isset($cliente['nome']) ? $cliente['nome'] : '',
    'cpf' => isset($cliente['cpf']) ? $cliente['cpf'] : '',
    'dataNascimento' => isset($cliente['dataNascimento']) ? $cliente['dataNascimento'] : '',
    'cep' => isset($endereco['cep']) ? $endereco['cep'] : '',
    'rua' => isset($endereco['rua']) ? $endereco['rua'] : '',
    'numero' => isset($endereco['numero']) ? $endereco['numero'] : '',
    'complemento' => isset($endereco['complemento']) ? $endereco['complemento'] : '',
    'bairro' => isset($endereco['bairro']) ? $endereco['bairro'] : '',
    'cidade' => isset($endereco['cidade']) ? $endereco['cidade'] : '',
    'tipo_endereco' => isset($endereco['tipo']) ? $endereco['tipo'] : ''
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $dataNascimento = $_POST['dob'];
    $cep = $_POST['cep'];
    $endereco = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['city'];

    // Atualizar dados do cliente
    $sqlCliente = "UPDATE clientes SET nome = ?, cpf = ?, dataNascimento = ? WHERE idClientes = ?";
    $stmtCliente = $conexao->prepare($sqlCliente);
    $stmtCliente->bind_param("sssi", $nome, $cpf, $dataNascimento, $idCliente);

    if ($stmtCliente->execute()) {
        // Verificar se o cliente já possui um endereço cadastrado
        $sqlCheckEndereco = "SELECT COUNT(*) AS num_rows FROM EnderecosClientes WHERE idClientes = ?";
        $stmtCheckEndereco = $conexao->prepare($sqlCheckEndereco);
        $stmtCheckEndereco->bind_param("i", $idCliente);
        $stmtCheckEndereco->execute();
        $resultCheckEndereco = $stmtCheckEndereco->get_result();
        $row = $resultCheckEndereco->fetch_assoc();
        $numRows = $row['num_rows'];

        // Inserir ou atualizar endereço do cliente
        if ($numRows == 0) {
            // Se não existir, execute um INSERT
            $sqlEndereco = "INSERT INTO EnderecosClientes (idClientes, tipo, cep, cidade, bairro, rua, numero, complemento) VALUES (?, 'residencial', ?, ?, ?, ?, ?, ?)";
            $stmtEndereco = $conexao->prepare($sqlEndereco);
            $stmtEndereco->bind_param("isssssi", $idCliente, $cep, $cidade, $bairro, $endereco, $numero, $complemento);
        } else {
            // Se existir, execute um UPDATE
            $sqlEndereco = "UPDATE EnderecosClientes SET cep = ?, cidade = ?, bairro = ?, rua = ?, numero = ?, complemento = ? WHERE idClientes = ?";
            $stmtEndereco = $conexao->prepare($sqlEndereco);
            $stmtEndereco->bind_param("ssssssi", $cep, $cidade, $bairro, $endereco, $numero, $complemento, $idCliente);
        }

        if ($stmtEndereco->execute()) {
            header("Location: produtos.php");
            exit();
        } else {
            echo "Erro ao atualizar o endereço: " . $stmtEndereco->error;
        }
    } else {
        echo "Erro ao atualizar o perfil: " . $stmtCliente->error;
    }

    // Fechar conexões
    $stmtCliente->close();
    $stmtEndereco->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete seu cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style_02cadastro.css">
</head>
<body>
<div class="container">
    <div class="background"></div>
    <img src="assets/img/logo.png" alt="Logo" style="display: block; margin: 0 auto; width: 50%;">
    <div class="services-text">
        <h2>Insira alguns dados adicionais para continuar nosso atendimento!</h2>
    </div>
    <form action="" method="POST">
    <div class="input-group">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required value="<?php echo isset($formularioDados['nome']) ? $formularioDados['nome'] : ''; ?>">
    </div>
    <div class="input-group">
        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" maxlength="11" required value="<?php echo isset($formularioDados['cpf']) ? $formularioDados['cpf'] : ''; ?>">
    </div>
    <div class="input-group">
        <label for="dob">Data de Nascimento:</label>
        <input type="date" id="dob" name="dob" required value="<?php echo isset($formularioDados['dataNascimento']) ? $formularioDados['dataNascimento'] : ''; ?>">
    </div>
    <div class="input-group">
        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" maxlength="8" required value="<?php echo isset($formularioDados['cep']) ? $formularioDados['cep'] : ''; ?>">
    </div>
    <div class="input-group">
        <label for="rua">Rua:</label>
        <input type="text" id="rua" name="rua" maxlength="40" required value="<?php echo isset($formularioDados['rua']) ? $formularioDados['rua'] : ''; ?>">
    </div>
    <div style="display: flex; flex-direction: row;">
        <div class="input-group" style="max-width: 50%;">
            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero" maxlength="5" required value="<?php echo isset($formularioDados['numero']) ? $formularioDados['numero'] : ''; ?>">
        </div>
        <div class="input-group" style="max-width: 50%;">
            <label for="complemento">Complemento:</label>
            <input type="text" id="complemento" name="complemento" maxlength="20" value="<?php echo isset($formularioDados['complemento']) ? $formularioDados['complemento'] : ''; ?>">
        </div>
    </div>  
    <div class="input-group">
        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" maxlength="25" required value="<?php echo isset($formularioDados['bairro']) ? $formularioDados['bairro'] : ''; ?>">
    </div>
    <div class="input-group" style="max-width: 95%; margin-right: 20px;">
        <label for="city">Cidade:</label>
        <select name="city" id="city" required>
            <option value=""></option>
            <option value="Belo Horizonte" <?php echo ($formularioDados['cidade'] == 'Belo Horizonte') ? 'selected' : ''; ?>>Belo Horizonte</option>
            <option value="Contagem" <?php echo ($formularioDados['cidade'] == 'Contagem') ? 'selected' : ''; ?>>Contagem</option>
            <option value="Betim" <?php echo ($formularioDados['cidade'] == 'Betim') ? 'selected' : ''; ?>>Betim</option>
            <option value="Sabará" <?php echo ($formularioDados['cidade'] == 'Sabará') ? 'selected' : ''; ?>>Sabará</option>
            <option value="Ibirité" <?php echo ($formularioDados['cidade'] == 'Ibirité') ? 'selected' : ''; ?>>Ibirité</option>
        </select>
    </div>
    <div class="input-group">
        <label for="tipo_endereco">Tipo de Endereço:</label>
        <select name="tipo_endereco" id="tipo_endereco" required>
            <option value=""></option>
            <option value="residencial" <?php echo ($formularioDados['tipo_endereco'] == 'residencial') ? 'selected' : ''; ?>>Residencial</option>
            <option value="comercial" <?php echo ($formularioDados['tipo_endereco'] == 'comercial') ? 'selected' : ''; ?>>Comercial</option>
        </select>
    </div>
    <div class="input-check">
        <input type="checkbox" id="terms" name="terms" required>
        <label for="terms">Eu concordo com os <a href="#">termos e condições</a> do site. <br> </label>
    </div>
    <button class="submit-button" type="submit">Continuar</button>
</form>

    <div class="separation-line1"></div>
    <div class="separation-line"></div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Função para limpar o formulário de CEP
        function limparFormularioCEP() {
            $("#rua").val("");
            $("#bairro").val("");
            $("#city").val("");
            // Limpe outros campos conforme necessário
        }

        // Evento "blur" para detectar quando o usuário termina de digitar o CEP
        $("#cep").blur(function() {
            var cep = $(this).val().replace(/\D/g, ''); // Remove qualquer caractere não numérico do CEP
            if (cep !== "") {
                var validacep = /^[0-9]{8}$/; // Expressão regular para validar o formato do CEP
                if(validacep.test(cep)) {
                    // Preenche os campos com "..." enquanto a busca está sendo realizada
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#city").val("...");
                    
                    // Faz a requisição para a API ViaCEP
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {
                            // Atualiza os campos do formulário com os dados recebidos
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#city").val(dados.localidade);
                            // Atualize outros campos conforme necessário
                        } else {
                            // CEP não encontrado
                            limparFormularioCEP();
                            alert("CEP não encontrado.");
                        }
                    });
                } else {
                    // CEP em formato inválido
                    limparFormularioCEP();
                    alert("Formato de CEP inválido.");
                }
            } else {
                // CEP sem valor, limpa formulário
                limparFormularioCEP();
            }
        });
    });
</script>


    
</body>
</html>