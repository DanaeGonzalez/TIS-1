<?php
session_start();
include '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cantidad_cajones = $_POST['cantidad_cajones'];

    $sql = "INSERT INTO n_cajones (cantidad_cajones) VALUES ('$cantidad_cajones')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Cajones agregado exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al agregar cajones: " . $conn->error;
    }

    header('Location: mostrar_n_cajones.php');
    exit();
}
?>