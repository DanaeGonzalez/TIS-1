<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar - Producto</title>
</head>
<body>
    <form action="insertar_producto.php" method="post">
        Nombre del Producto: <input type="text" name="nombre_producto" required><br>
        Precio Unitario: <input type="number" name="precio_unitario" required><br>
        Descripción: <textarea name="descripcion_producto"></textarea><br>
        Características: <textarea name="caracteristicas_producto"></textarea><br>
        Foto del Producto (URL): <input type="text" name="foto_producto"><br>
        <input type="submit" value="Crear Producto">
        <a href="mostrar_producto.php">Volver</a>
    </form>

</body>
</html>

<?php
include 'conexion.php'; // Archivo que contiene la conexión a la base de datos.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_producto'];
    $precio = $_POST['precio_unitario'];
    $descripcion = $_POST['descripcion_producto'];
    $caracteristicas = $_POST['caracteristicas_producto'];
    $foto = $_POST['foto_producto'];

    // Valores de stock y cantidad vendida se establecen en 0 automáticamente
    $stock = 0;
    $cantidad_vendida = 0;

    $sql = "INSERT INTO producto (nombre_producto, precio_unitario, descripcion_producto, caracteristicas_producto, foto_producto, stock_producto, cantidad_vendida, top_venta)
            VALUES ('$nombre', $precio, '$descripcion', '$caracteristicas', '$foto', 0, 0, false)";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo producto creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
