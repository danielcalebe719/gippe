<?php
include("config.php");

//$conn = new mysqli($servername, $username, $password, $dbname);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $query = "SELECT * FROM pedidos WHERE idPedidos = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Client not found']);
    }
}
