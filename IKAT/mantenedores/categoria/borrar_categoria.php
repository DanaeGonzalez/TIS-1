<?php
include '../../config/conexion.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM categoria WHERE id_categoria = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Categoría eliminada exitosamente <br>";
    } else {
        $_SESSION['mensaje'] = "Error: " . $sql . "<br>" . $conn->error;
    }
}

    header('Location: mostrar_categoria.php');
    exit();

?>


