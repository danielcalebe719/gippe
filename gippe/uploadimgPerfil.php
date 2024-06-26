<?php

require("conecta.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acao = $_POST['acao'];
    if ($acao == 'imgInsercao') {
  
      $idClientes = $_POST['idClientes'];
      $imagem = $_FILES['imagem']['tmp_name'];
      $tamanho = $_FILES['imagem']['size'];
      $tipo = $_FILES['imagem']['type'];
      $nome = $_FILES['imagem']['name'];
  
      if ($imagem != "none") {
          $diretorioDestino = 'imagensPerfil/';
          $nomeImagem = $nome;
  
          if (move_uploaded_file($imagem, $diretorioDestino . $nomeImagem)) {
              $caminhoImagem =  $nomeImagem;
              $queryUpdate = "UPDATE clientes SET imgCaminho = '$nome' WHERE idClientes = '$idClientes'";
  
              $resultado = mysqli_query($conexao, $queryUpdate);
  
              if ($resultado) {
                  echo 'Registro inserido com sucesso!';
                  header("Location: perfil.php?idClientes=$idClientes");
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
    }
  }


?>
