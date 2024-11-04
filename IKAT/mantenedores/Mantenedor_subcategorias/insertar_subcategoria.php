<?php
session_start();
include '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_subcategoria = $_POST['nombre_subcategoria'];
    $id_categoria = $_POST['id_categoria'];  //Clave foránea de la categoría

    $sql = "INSERT INTO subcategoria (nombre_subcategoria, id_categoria) VALUES ('$nombre_subcategoria', '$id_categoria')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Subcategoría creada exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al crear subcategoría: " . $conn->error;
    }

    header('Location: mostrar_subcategoria.php');
    exit();
}
?>
