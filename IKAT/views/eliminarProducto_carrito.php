<?php
include_once '../config/conexion.php';
include 'menu_registro/auth.php';

session_start(); // Inicia o reanuda la sesión

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
        $params = array_merge($product_ids, [$_SESSION['id_carrito']]);
        $types = str_repeat('i', count($product_ids)) . 'i';

        // Vincula los parámetros
        $stmt->bind_param($types, ...$params); // Bind de todos los IDs

        // Ejecuta y verifica la eliminación
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