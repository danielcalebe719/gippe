<?php
require("conecta.php");

$nomeEvento = $_POST['evento'];
$descricaoEvento = isset($_POST['descricao_evento']) ? $_POST['descricao_evento'] : '';

$imagem = $_FILES['imagem']['tmp_name'];
$tamanho = $_FILES['imagem']['size'];
$tipo = $_FILES['imagem']['type'];
$nome = $_FILES['imagem']['name'];

if ($imagem != "none") {
    $diretorioDestino = 'galeriaImagens/';
    $nomeImagem = $nome;

    if (move_uploaded_file($imagem, $diretorioDestino . $nomeImagem)) {
        $caminhoImagem =  $nomeImagem;
        $queryInsercao = "INSERT INTO galeriaImagens (evento, descricao, nome_imagem, tamanho_imagem, tipo_imagem, imagemCaminho) VALUES ('$nomeEvento', '$descricaoEvento', '$nomeImagem', '$tamanho', '$tipo', '$caminhoImagem')";

        $resultado = mysqli_query($conexao, $queryInsercao);

        if ($resultado) {
            echo 'Registro inserido com sucesso!';
            header('Location: index.php');
            exit();
        } else {
            die("Algo deu errado ao inserir o registro. Tente novamente. Erro: " . mysqli_error($conexao));
        }
    } else {
        print "Não foi possível mover a imagem para o diretório de destino.";
    }
} else {
    print "Não foi possível carregar a imagem.";
}


?>