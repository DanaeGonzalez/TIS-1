<?php
session_start();
include '../../config/conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_resenia = $_POST['id_resenia'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    $activo = $_POST['activo'];
    $id_usuario = $_POST['id_usuario'];
    $id_producto = $_POST['id_producto'];

    $sql = "UPDATE resenia SET calificacion = ?, comentario = ?, activo = ?, id_usuario = ?, id_producto = ? WHERE id_resenia = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isiisi", $calificacion, $comentario, $activo, $id_usuario, $id_producto, $id_resenia);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Reseña actualizada correctamente";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la reseña: " . $conn->error;
    }
    
    $stmt->close();
    $conn->close();
    
    header("Location: mostrar_resenia.php");
    exit();
}
?>
