<?php
// Iniciar a sessão
session_start();

// Destruir a sessão
session_destroy();

// Definir cabeçalhos HTTP para forçar o navegador a limpar a sessão
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Content-Type: text/html; charset=UTF-8");

// Redirecionar o usuário para a página de login
header('Location: http://localhost/n/home.php');
exit();
?>
