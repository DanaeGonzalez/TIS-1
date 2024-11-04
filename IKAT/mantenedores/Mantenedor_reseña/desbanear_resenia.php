<?php
include '../../config/conexion.php';
session_start();

$id_resenia = isset($_POST['id_resenia']) ? intval($_POST['id_resenia']) : 0;

if ($id_resenia > 0) {
    $sql = "UPDATE resenia SET activo = 1, razon = NULL WHERE id_resenia = $id_resenia";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Reseña desbaneada correctamente.";
    } else {
        $_SESSION['mensaje'] = "Error al desbanear la reseña: " . $conn->error;
    }
} else {
    $_SESSION['mensaje'] = "ID de reseña inválido.";
}

header("Location: mostrar_resenia.php");
exit();
?>
