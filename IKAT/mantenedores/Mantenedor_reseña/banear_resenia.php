<?php
include '../../config/conexion.php';
session_start();

$id_resenia = isset($_POST['id_resenia']) ? intval($_POST['id_resenia']) : 0;
$razon = isset($_POST['razon']) ? $conn->real_escape_string($_POST['razon']) : '';

if ($id_resenia > 0 && !empty($razon)) {
    $sql = "UPDATE resenia SET activo = 0, razon = '$razon' WHERE id_resenia = $id_resenia";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Reseña baneada correctamente.";
    } else {
        $_SESSION['mensaje'] = "Error al banear la reseña: " . $conn->error;
    }
} else {
    $_SESSION['mensaje'] = "Datos inválidos.";
}

header("Location: mostrar_resenia.php");
exit();
?>
