<?php
include 'conexion.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Stock - Producto</title>
</head>
<body>
    <h2>Modificar Stock del Producto</h2>
    <form action="modificar_stock_producto.php" method="post">
        <label for="id_producto">ID del Producto:</label>
        <input type="number" name="id_producto" required><br><br>
        <label for="cantidad_modificar">Cantidad a modificar (Negativo para descontar):</label>
        <input type="number" name="cantidad_modificar" required><br><br>
        <input type="submit" value="Modificar Stock">
    </form>
    <a href="mostrar_producto.php">Volver</a>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_producto = $_POST['id_producto'];
    $cantidad_modificar = $_POST['cantidad_modificar'];

    $sql = "SELECT stock_producto FROM producto WHERE id_producto = $id_producto";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stock_actual = $row['stock_producto'];

        $nuevo_stock = $stock_actual + $cantidad_modificar;

        if ($nuevo_stock < 0) {
            echo "Error: No se puede tener stock negativo.";
        } else {
            
            $sql_update = "UPDATE producto SET stock_producto = $nuevo_stock WHERE id_producto = $id_producto";

            if ($conn->query($sql_update) === TRUE) {
                echo "Stock actualizado exitosamente.";
            } else {
                echo "Error al actualizar el stock: " . $conn->error;
            }
        }
    } else {
        echo "Error: Producto no encontrado.";
    }
}
?>
