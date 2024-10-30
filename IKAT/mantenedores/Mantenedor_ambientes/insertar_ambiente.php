<?php
session_start();
include '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_ambiente = $_POST['nombre_ambiente'];

    $sql = "INSERT INTO ambiente (nombre_ambiente) VALUES ('$nombre_ambiente')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Ambiente agregado exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al agregar el ambiente: " . $conn->error;
    }

    header('Location: mostrar_ambiente.php');
    exit();
}
?>