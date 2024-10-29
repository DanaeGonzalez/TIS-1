<?php
session_start();
include '../conexion.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_metodo'];
    $activo = 1;

    $sql = "INSERT INTO metodo_pago (nombre_metodo, activo) VALUES ('$nombre', $activo)";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Metodo de pago creado exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al crear metodo de pago: " . $conn->error;
    }

    header('Location: mostrar_metodo_pago.php');
    exit();
}

