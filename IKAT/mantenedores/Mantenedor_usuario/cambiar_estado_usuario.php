<?php
session_start();
include '../../config/conexion.php';

if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];

    $sqlToggleActive = "UPDATE usuario SET activo = IF(activo = 1, 0, 1) WHERE id_usuario = ?";
    $stmt = $conn->prepare($sqlToggleActive);
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "El estado del producto se ha cambiado correctamente.";
    } else {
        $_SESSION['mensaje'] = "Error al cambiar el estado del producto.";
    }

    $stmt->close();
}

$conn->close();

header('Location: mostrar_usuario.php');
exit();


?>
