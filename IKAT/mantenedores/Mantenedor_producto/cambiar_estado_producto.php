<?php
session_start();
include '../../config/conexion.php';

if (isset($_GET['id'])) {
    $id_producto = $_GET['id'];

    $sqlToggleActive = "UPDATE producto SET activo = IF(activo = 1, 0, 1) WHERE id_producto = ?";
    $stmt = $conn->prepare($sqlToggleActive);
    $stmt->bind_param("i", $id_producto);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "El estado del producto se ha cambiado correctamente.";
    } else {
        $_SESSION['mensaje'] = "Error al cambiar el estado del producto.";
    }

    $stmt->close();
}

$conn->close();

header('Location: mostrar_producto.php');
exit();


?>
