<?php
require_once("conecta.php");
//aqui denovo apenas testes de commit
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Armazenando imagens no banco de dados Mysql</title>
</head>
<body>
<h2>Selecione um novo arquivo de imagem</h2>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <input type="text" name="evento" placeholder="Nome do evento">
    <input type="text" name="descricao_evento" placeholder="descricao do evento">
    <input type="file" name="imagem">
    <input type="submit" value="Enviar">
</form>

<br />
<table border="1">
    <tr>
        <td align="center">
            Código
        </td>
        <td align="center">
            Evento
        </td>
        <td align="center">
            Descrição
        </td>
        <td align="center">
            Nome da imagem
        </td>
        <td align="center">
            Tamanho
        </td>
        <td align="center">
            Visualizar imagem
        </td>
        <td align="center">
            Excluir imagem
        </td>
    </tr>
    <?php
$conexao = mysqli_connect("localhost", "root", "","bdtcc");
    
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    $querySelecao = "SELECT codigo, evento, descricao,
    nome_imagem, tamanho_imagem, imagem FROM galeriaimagens";
    $resultado = mysqli_query($conexao, $querySelecao);


    $queryTudo = "SELECT * FROM galeriaimagens WHERE codigo = 1";
    $tudo =  mysqli_query($conexao, $queryTudo);

    while ($aquivos = mysqli_fetch_array($resultado)) { ?>
        <tr>
            <td align="center"><?php echo $aquivos['codigo']; ?></td>
            <td align="center"><?php echo $aquivos['evento']; ?></td>
            <td align="center"><?php echo $aquivos['descricao']; ?></td>
            <td align="center"><?php echo $aquivos['nome_imagem']; ?></td>
            <td align="center"><?php echo $aquivos['tamanho_imagem']; ?></td>
            <td align="center">
            <?php echo '<a href="ver_imagem.php?codigo='.$aquivos['codigo'].'">imagem '.$aquivos['codigo'].'</a>'; ?>
       
            </td>
            <td align="center">
            <?php echo '<a href="ver_imagem.php?codigo='.$aquivos['codigo'].'">imagem '.$aquivos['codigo'].'</a>'; ?>

            </td>
        </tr>
    <?php } ?>
</table>
</body>
</html>
