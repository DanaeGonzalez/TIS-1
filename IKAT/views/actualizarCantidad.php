<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    echo 'Usuario no autenticado';
    exit;
}

if (isset($_POST['id_producto']) && isset($_POST['cantidad'])) {
    $idProducto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    // Obtener el stock disponible del producto
    require_once '../config/conexion.php';
    $sql = "SELECT stock_producto FROM producto WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $idProducto);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stockDisponible = $row['stock_producto'];

    // Verificar que la cantidad esté dentro del rango válido
    if ($cantidad >= 1 && $cantidad <= $stockDisponible) {
        // Actualizar la cantidad en el carrito
        $sql = "UPDATE carrito SET cantidad = ? WHERE id_producto = ? AND id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iii', $cantidad, $idProducto, $_SESSION['id_usuario']);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo 'Cantidad actualizada';
        } else {
            echo 'Error al actualizar';
        }
    } else {
        echo 'Cantidad no válida';
    }
}
?>
