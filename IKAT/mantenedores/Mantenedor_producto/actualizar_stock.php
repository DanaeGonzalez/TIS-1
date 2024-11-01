<?php
session_start();
include '../../config/conexion.php';

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$id_producto = $_POST['id_producto'];
$cantidad = $_POST['cantidad'];
$motivo = $_POST['motivo'];
$explicacion = $_POST['explicacion'];

// Empezar una transacción para asegurar consistencia de datos
$conn->begin_transaction();

try {
    // Obtener el stock actual del producto
    $sqlGetStock = "SELECT stock_producto FROM producto WHERE id_producto = ?";
    $stmtGetStock = $conn->prepare($sqlGetStock);
    $stmtGetStock->bind_param("i", $id_producto);
    $stmtGetStock->execute();
    $stmtGetStock->bind_result($stock_actual);
    $stmtGetStock->fetch();
    $stmtGetStock->close();

    // Calcular el nuevo stock según el motivo
    if ($motivo === 'Ingreso') {
        $nuevo_stock = $stock_actual + $cantidad;
    } else if ($motivo === 'Salida') {
        $nuevo_stock = $stock_actual - $cantidad;
    }

    // Verificar si el stock quedaría en negativo
    if ($nuevo_stock < 0) {
        // Revertir la transacción y establecer un mensaje de error
        $conn->rollback();
        $_SESSION['mensaje'] = "Error: La operación dejaría el stock en negativo.";
    } else {
        // Actualizar el stock en la tabla producto
        $sqlUpdateStock = "UPDATE producto SET stock_producto = ? WHERE id_producto = ?";
        $stmtUpdate = $conn->prepare($sqlUpdateStock);
        $stmtUpdate->bind_param("ii", $nuevo_stock, $id_producto);
        $stmtUpdate->execute();

        // Insertar el registro en la tabla control_stock
        $sqlInsertControl = "INSERT INTO control_stock (id_producto, cantidad, motivo, explicacion, fecha) VALUES (?, ?, ?, ?, NOW())";
        $stmtInsert = $conn->prepare($sqlInsertControl);
        $stmtInsert->bind_param("iiss", $id_producto, $cantidad, $motivo, $explicacion);
        $stmtInsert->execute();

        // Confirmar la transacción
        $conn->commit();

        // Establecer mensaje de éxito
        $_SESSION['mensaje'] = "Stock modificado exitosamente.";
    }
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conn->rollback();
    $_SESSION['mensaje'] = "Error al modificar el stock: " . $e->getMessage();
}

// Cerrar conexiones
$conn->close();

// Redireccionar a la página anterior o donde necesites
header("Location: mostrar_producto.php");
exit;
?>
