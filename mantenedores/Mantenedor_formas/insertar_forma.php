<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_forma = $_POST['nombre_forma'];

    $sql = "INSERT INTO forma (nombre_forma) VALUES ('$nombre_forma')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Forma agregada exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al agregar la forma: " . $conn->error;
    }

    header('Location: mostrar_forma.php');
    exit();
}
?>