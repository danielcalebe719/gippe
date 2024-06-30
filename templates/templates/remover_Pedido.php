<?php
include("config.php");

$idPedido = $_POST['id'];


$sql = "DELETE FROM notificacoesclientes WHERE idPedidos = '$idPedido'";
$conn->query($sql);


$sql = "DELETE FROM pedidosprodutos WHERE idPedidos = '$idPedido'";
$conn->query($sql);


$sql = "DELETE FROM pedidos WHERE idPedidos = '$idPedido'";
$conn->query($sql);

echo "Cadastro removido com sucesso";

?>
