<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_categoria = $_POST['nombre_categoria'];

    $sql = "INSERT INTO categoria (nombre_categoria) VALUES ('$nombre_categoria')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Categoria creada exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al categoria producto: " . $conn->error;
    }

    header('Location: mostrar_categoria.php');
    exit();
}
?>