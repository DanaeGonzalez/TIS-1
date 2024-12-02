<?php
include '../../config/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    $id_usuario = $_POST['id_usuario'];
    $id_producto = $_POST['id_producto'];

    $sql = "INSERT INTO resenia (calificacion, comentario, activo, id_usuario, id_producto)
            VALUES ($calificacion, '$comentario',1, $id_usuario, $id_producto)";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Nueva reseña creada exitosamente";
    } else {
        $_SESSION['mensaje']  = "Error: " . $sql . "<br>" . $conn->error;
    }
}

header("Location: mostrar_resenia.php");
exit();
?>