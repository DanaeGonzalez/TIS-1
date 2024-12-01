<?php
session_start();
include_once '../../config/conexion.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_usuario'])) {
    echo "Tu sesión ha expirado o no estás autenticado.";
    exit;
}

// Eliminar todos los productos del carrito
$sqlEliminar = "DELETE FROM carrito WHERE id_usuario = ?";
$stmtEliminar = $conn->prepare($sqlEliminar);
$stmtEliminar->bind_param("i", $_SESSION['id_usuario']);
if ($stmtEliminar->execute()) {
    // Redirigir al carrito después de eliminar todos los productos
    header("Location: ../../views/carrito.php");
    exit;
} else {
    echo "Error al eliminar los productos del carrito.";
}

$conn->close();
?>
