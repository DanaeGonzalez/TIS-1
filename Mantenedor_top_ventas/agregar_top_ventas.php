<?php
include 'conexion.php';

// Cuando se envía el formulario para agregar a top ventas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST["id_producto"];

    $query = "UPDATE producto SET top_venta = true WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_producto);
    
    if ($stmt->execute()) {
        echo "Producto agregado a top ventas con éxito.";
    } else {
        echo "Error al agregar el producto a top ventas.";
    }
}

$query = "SELECT id_producto, nombre_producto FROM producto WHERE top_venta = false";
$result = $conn->query($query);
?>

<form method="post" action="">
    <label for="id_producto">Agregar producto a top ventas ingresando el ID:</label>
    <input type="number" name="id_producto" required>
    <button type="submit">Agregar</button>
</form>

<br>

<a href='mostrar_top_ventas.php'>Volver</a>
