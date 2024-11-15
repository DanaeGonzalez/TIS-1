<?php
session_start();
include '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_producto'];
    $precio = $_POST['precio_unitario'];
    $descripcion = $_POST['descripcion_producto'];
    $foto = $_POST['foto_producto'];

    $sql = "INSERT INTO producto (nombre_producto, precio_unitario, descripcion_producto, foto_producto, stock_producto, cantidad_vendida, top_venta, activo)
            VALUES ('$nombre', $precio, '$descripcion', '$foto', 0, 0, 0, 1)";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Producto creado exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al crear producto: " . $conn->error;
    }

    header('Location: mostrar_producto.php');
    exit();
}
?>