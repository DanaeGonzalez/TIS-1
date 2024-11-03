<?php
session_start();
include '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_subcategoria = $_POST['id_subcategoria'];
    $nombre_subcategoria = $_POST['nombre_subcategoria'];

    $sql = "UPDATE subcategoria SET nombre_subcategoria='$nombre_subcategoria' WHERE id_subcategoria=$id_subcategoria";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Subcategoría editada exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al editar subcategoría: " . $conn->error;
    }

    header('Location: mostrar_subcategoria.php');
    exit();
}
?>
