<?php
include_once '../config/conexion.php';

if (isset($_POST['product_ids'])) {
    // Decodifica la cadena JSON a un array
    $product_ids = json_decode($_POST['product_ids'], true);

    // Verifica si se obtuvo un array y no un valor nulo
    if (is_array($product_ids) && count($product_ids) > 0) {
        // Prepara la consulta para eliminar los productos del carrito
        $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
        $sql = "DELETE FROM carrito_producto WHERE id_producto IN ($placeholders) AND id_carrito = ?";
        $stmt = $conn->prepare($sql);

        // Combina los IDs de productos con el ID del carrito
        $id_carrito = 1; // Cambia esto por la lógica para obtener el ID del carrito del usuario actual
        $params = array_merge($product_ids, [$id_carrito]);
        $stmt->bind_param(str_repeat('i', count($product_ids)) . 'i', ...$params); // Bind de todos los IDs

        if ($stmt->execute()) {
            echo "Productos eliminados exitosamente.";
        } else {
            echo "Error al eliminar productos: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "No se seleccionaron productos para eliminar.";
    }
}

$conn->close();

// Redirige de vuelta al carrito de compras
header('Location: carrito.php');
exit();
?>