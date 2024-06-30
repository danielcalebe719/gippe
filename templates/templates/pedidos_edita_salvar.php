<?php
include("config.php");


$id = $_POST['id'];
$observacao = $_POST['observacao'];
$status = $_POST['status'];
$totalPedido = $_POST['totalPedido'];
$dataEntrega = $_POST['dataEntrega'];




$sql =" UPDATE pedidos SET observacao='$observacao', status='$status', totalPedido='$totalPedido', dataEntrega='$dataEntrega' WHERE idPedidos = '$id'";

if($conn->query($sql)==TRUE){
    echo "Cadastro realizado com sucesso!";
} else{
    echo "Erro ao inserir registro".$conn->error;
};

header('Location: pedidos.php')
?>