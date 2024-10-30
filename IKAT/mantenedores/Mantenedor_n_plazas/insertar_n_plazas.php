<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tamaño_plaza = $_POST['tamaño_plaza'];

    $sql = "INSERT INTO n_plazas (tamaño_plaza) VALUES ('$tamaño_plaza')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Plazas agregada exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al agregar plazas: " . $conn->error;
    }

    header('Location: mostrar_n_plazas.php');
    exit();
}
?>