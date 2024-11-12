<?php
include_once '../config/conexion.php';
include 'menu_registro/auth.php';

if (isset($_POST['id_producto'])) {
    // Recupera el ID del producto
    $id_producto = $_POST['id_producto'];

    // Verifica si el ID del producto es válido
    if (isset($id_producto) && !empty($id_producto)) {
        // Prepara la consulta para eliminar el producto del carrito
        $sql = "DELETE FROM carrito_producto WHERE id_producto = ? AND id_carrito = ?";

        $stmt = $conn->prepare($sql);

        // Vincula los parámetros
        $stmt->bind_param('ii', $id_producto, $_SESSION['id_carrito']);

        // Ejecuta y verifica la eliminación
        if ($stmt->execute()) {
            echo "Producto eliminado exitosamente.";
        } else {
            echo "Error al eliminar el producto: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();

// Redirige de vuelta al carrito de compras
header('Location: carrito.php');
exit();
?>