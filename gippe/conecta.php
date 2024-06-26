<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bdtcc";

// Create connection
$conexao = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
} else {
}
