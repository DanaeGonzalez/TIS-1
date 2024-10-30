<?php
session_start();
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST["id_producto"];

    $query = "UPDATE producto SET top_venta = true WHERE id_producto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_producto);

    if ($stmt->execute() === TRUE) { 
        $_SESSION['mensaje'] = "Producto agregado exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al agregar producto: " . $conn->error;
    }

    header('Location: mostrar_top_ventas.php');
    exit();
}

$query = "SELECT id_producto, nombre_producto FROM producto WHERE top_venta = false";
$result = $conn->query($query);
?>
