<?php
include("conecta.php");

// Verifica se os dados foram recebidos corretamente
if(isset($_POST['itens']) && !empty($_POST['itens'])) {
    // Prepara a query para inserção dos itens do carrinho
    $queryInserir = "INSERT INTO pedidosProdutos (idPedidos, idProdutos, quantidade, subtotal) VALUES (?, ?, ?, ?)";
    $stmt = $conexao->prepare($queryInserir);

    // Itera sobre os itens do carrinho recebidos
    foreach ($_POST['itens'] as $item) {
        // Coleta os dados do item
        $nome = $item['nome'];
        $preco = $item['preco'];
        $quantidade = $item['quantidade'];

        // Calcula o subtotal
        $subtotal = $preco * $quantidade;

        // Executa a query de inserção para cada item do carrinho
        $stmt->bind_param("iiid", $idPedido, $idProduto, $quantidade, $subtotal);

        $stmt->execute();
    }

    // Fecha a conexão com o banco de dados
    $stmt->close();
    $conexao->close();

    // Retorna uma resposta de sucesso (você pode ajustar conforme necessário)
    echo "Itens do carrinho inseridos com sucesso!";
} else {
    // Retorna uma resposta de erro caso os dados não sejam recebidos corretamente
    echo "Erro: Não foram recebidos dados do carrinho.";
}
?>
