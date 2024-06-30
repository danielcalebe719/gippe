<?php
include("config.php");


$idCliente = $_POST['idCliente'];
$observacao = $_POST['observacao'];
$status = $_POST['status'];
$totalPedido = $_POST['totalPedido'];
$dataPedido = date("Y-m-d H:i:s");
$dataEntrega = $_POST['dataEntrega'];




$sql =" INSERT INTO pedidos (idCliente, observacao, status, totalPedido, dataPedido, dataEntrega) 
                    VALUES('$idCliente','$observacao','$status','$totalPedido','$dataPedido','$dataEntrega')";

if($conn->query($sql)==TRUE){
    echo "Cadastro realizado com sucesso!";
} else{
    echo "Erro ao inserir registro".$conn->error;
};

header('Location: pedidos.php')
?>