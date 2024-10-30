<?php
session_start();
include '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cantidad_asientos = $_POST['cantidad_asientos'];

    $sql = "INSERT INTO n_asientos (cantidad_asientos) VALUES ('$cantidad_asientos')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Asiento agregado exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al agregar el asiento: " . $conn->error;
    }

    header('Location: mostrar_n_asientos.php');
    exit();
}
?>