<?php
include_once '../../config/conexion.php';
include '../../views/menu_registro/auth.php';

if (isset($_POST['id_producto'])) {
    // Recupera el ID del producto
    $id_producto = $_POST['id_producto'];
    // Recupera el ID del usuario desde la sesión
    $id_usuario = $_SESSION['id_usuario'];

    // Verifica si el ID del producto y el ID de usuario son válidos
    if (isset($id_producto) && !empty($id_producto) && isset($id_usuario)) {
        // Prepara la consulta para eliminar el producto del carrito
        $sql = "DELETE FROM carrito WHERE id_producto = ? AND id_usuario = ?";
        $stmt = $conn->prepare($sql);
        // Vincula los parámetros
        $stmt->bind_param('ii', $id_producto, $id_usuario);
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
header('Location: ../../views/carrito.php');
exit();
?>
