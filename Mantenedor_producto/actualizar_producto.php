<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_producto'];
    $nombre = $_POST['nombre_producto'];
    $precio = $_POST['precio_unitario'];
    $descripcion = $_POST['descripcion_producto'];
    $caracteristicas = $_POST['caracteristicas_producto'];
    $foto = $_POST['foto_producto'];

    $sql = "UPDATE producto SET nombre_producto='$nombre', precio_unitario=$precio, descripcion_producto='$descripcion', caracteristicas_producto='$caracteristicas', foto_producto='$foto' WHERE id_producto=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto actualizado exitosamente <br>";
        echo "<a href='mostrar_producto.php'>Volver</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
