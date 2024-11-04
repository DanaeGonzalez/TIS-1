<?php
session_start();
include '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_material = $_POST['nombre_material'];

    $sql = "INSERT INTO material (nombre_material) VALUES ('$nombre_material')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Material agregado exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al agregar el material: " . $conn->error;
    }

    header('Location: mostrar_material.php');
    exit();
}
?>