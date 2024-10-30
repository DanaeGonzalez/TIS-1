<?php
    session_start();
    include '../conexion.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
        $id_producto = $_POST['id_producto'];
    
        $query = "UPDATE producto SET top_venta = false WHERE id_producto = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_producto);

        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "Producto quitado de top ventas con éxito.";
        } else {
            $_SESSION['mensaje'] = "Error al quitar el producto de top ventas.";
        }
    } else {
        $_SESSION['mensaje'] = "No se recibió un ID de producto válido.";
    }

    header('Location: mostrar_top_ventas.php');
    exit();
?>

