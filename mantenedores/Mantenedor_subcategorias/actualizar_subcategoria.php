<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_subcategoria = $_POST['id_subcategoria'];
    $nombre_subcategoria = $_POST['nombre_subcategoria'];
    $id_categoria = $_POST['id_categoria'];  //Actualiza también la categoría asociada si es necesario

    $sql = "UPDATE subcategoria SET nombre_subcategoria='$nombre_subcategoria', id_categoria='$id_categoria' WHERE id_subcategoria=$id_subcategoria";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Subcategoría editada exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al editar subcategoría: " . $conn->error;
    }

    header('Location: mostrar_subcategoria.php');
    exit();
}
?>
