<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_producto'];
    $precio = $_POST['precio_unitario'];
    $descripcion = $_POST['descripcion_producto'];
    $caracteristicas = $_POST['caracteristicas_producto'];
    $foto = $_POST['foto_producto'];

    $sql = "INSERT INTO producto (nombre_producto, precio_unitario, descripcion_producto, caracteristicas_producto, foto_producto, stock_producto, cantidad_vendida, top_venta)
            VALUES ('$nombre', $precio, '$descripcion', '$caracteristicas', '$foto', 0, 0, false)";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Producto creado exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al crear producto: " . $conn->error;
    }

    header('Location: mostrar_producto.php');
    exit();
}
?>