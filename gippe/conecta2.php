<?php
$conexao = mysqli_connect("localhost", "root", "");

if ($conexao) {
    $baseSelecionada = mysqli_select_db($conexao, "bdtcc");
    if (!$baseSelecionada) {
        die('Não foi possível conectar à base de dados: ' . mysqli_error($conexao));
    }
} else {
    die('Não conectado: ' . mysqli_error());
}
?>
