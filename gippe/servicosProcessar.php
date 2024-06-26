<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todas as variáveis foram recebidas
    if (isset($_POST["barmans"], $_POST["garcons"], $_POST["cozinheiros"], $_POST["duracaoHoras"], $_POST["quantidadePessoas"])) {
        // Recupera os valores do formulário
        $barmans = $_POST["barmans"];
        $garcons = $_POST["garcons"];
        $cozinheiros = $_POST["cozinheiros"];
        $duracaoHoras = $_POST["duracaoHoras"]; // Recupera a duração da festa em horas
        $quantidadePessoas = $_POST["quantidadePessoas"]; // Recupera a quantidade de pessoas
        
        // Conecta-se ao banco de dados
        include("conecta.php");

        // Verifica se a conexão foi estabelecida corretamente
        if (!$conexao) {
            die("Erro de conexão: " . mysqli_connect_error());
        }

        // Insere um novo serviço "personalizado" na tabela 'servicos'
        $queryInserirServico = "INSERT INTO servicos (nomeServico, duracaoHoras, quantidadePessoas) VALUES ('personalizado', ?, ?)";
        $stmt = mysqli_prepare($conexao, $queryInserirServico);
        mysqli_stmt_bind_param($stmt, "ii", $duracaoHoras, $quantidadePessoas);

        if (mysqli_stmt_execute($stmt)) {
            // Recupera o idServicos do serviço "personalizado" recém-inserido
            $idServicosPersonalizado = mysqli_insert_id($conexao);

            // Prepara a query de inserção na tabela 'servicosPedidos' usando prepared statements
            $queryInsercao = "INSERT INTO servicosPedidos (idServicos, funcionarioTipo, quantidade, subtotal) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conexao, $queryInsercao);
            
            // Define os parâmetros da query
            $funcionarioTipo = ""; // Aqui você define o tipo de funcionário, como "barman", "garçom", "cozinheiro", etc.
            $subtotal = 0; // Aqui você define o subtotal com base na quantidade de funcionários e em alguma lógica de preços
            // Liga os parâmetros
            mysqli_stmt_bind_param($stmt, "isid", $idServicosPersonalizado, $funcionarioTipo, $barmans, $subtotalBarmans);
            // Executa a query
            mysqli_stmt_execute($stmt);

            // Redireciona o usuário para pedidos.php levando o id do serviço
            header("Location: pedidos.php?idServico=$idServicosPersonalizado");
            exit();
        } else {
            echo "Erro ao inserir os dados: " . mysqli_error($conexao);
        }

        // Fecha a conexão com o banco de dados
        mysqli_close($conexao);
    } else {
        echo "Todos os campos do formulário devem ser preenchidos.";
    }
}
?>
