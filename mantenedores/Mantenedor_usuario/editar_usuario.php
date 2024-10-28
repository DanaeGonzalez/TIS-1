<?php
    session_start();
    include '../conexion.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM usuario WHERE id_usuario = $id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }
?>

