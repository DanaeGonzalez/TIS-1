<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM producto WHERE id_producto = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<form action="actualizar_producto.php" method="post">
    <input type="hidden" name="id_producto" value="<?php echo $row['id_producto']; ?>">
    Nombre del Producto: <input type="text" name="nombre_producto" value="<?php echo $row['nombre_producto']; ?>" required><br>
    Precio Unitario: <input type="number" name="precio_unitario" value="<?php echo $row['precio_unitario']; ?>" required><br>
    Descripción: <textarea name="descripcion_producto"><?php echo $row['descripcion_producto']; ?></textarea><br>
    Características: <textarea name="caracteristicas_producto"><?php echo $row['caracteristicas_producto']; ?></textarea><br>
    Foto del Producto (URL): <input type="text" name="foto_producto" value="<?php echo $row['foto_producto']; ?>"><br>
    <input type="submit" value="Actualizar Producto">
</form>
