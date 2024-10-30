<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_color = $_POST['nombre_color'];

    $sql = "INSERT INTO color (nombre_color) VALUES ('$nombre_color')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Color agregado exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al agregar el color: " . $conn->error;
    }

    header('Location: mostrar_color.php');
    exit();
}
?>