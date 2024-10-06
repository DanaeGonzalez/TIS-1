<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];

    // Actualiza el producto para que no sea más top venta
    $query = "UPDATE producto SET top_venta = false WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_producto);
    
    if ($stmt->execute()) {
        echo "Producto quitado de top ventas con éxito.";
    } else {
        echo "Error al quitar el producto de top ventas.";
    }

    // Redirige de vuelta a la página de mostrar los productos top ventas
    
} else {
    echo "No se recibió un ID de producto válido.";
}
?>

<br>

<a href='mostrar_top_ventas.php'>Volver</a>
