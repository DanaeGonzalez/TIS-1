<?php
include '../../config/conexion.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM material WHERE id_material = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Material eliminado exitosamente <br>";
    } else {
        $_SESSION['mensaje'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location: mostrar_material.php');
        exit();
}
?>
