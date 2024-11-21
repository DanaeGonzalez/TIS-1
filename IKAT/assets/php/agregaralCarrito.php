<?php
session_start();
include_once '../../config/conexion.php';

header('Content-Type: application/json');

// Obtener datos JSON
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id_producto']) && isset($data['cantidad'])) {
    $id_producto = $data['id_producto'];
    $cantidad = $data['cantidad'];

    // Obtén el ID del carrito de la sesión del usuario
    $id_carrito = $_SESSION['id_carrito']; 

    // Verifica que el id_carrito esté definido
    if (!isset($id_carrito)) {
        echo json_encode(['success' => false, 'error' => 'ID de carrito no encontrado en la sesión.']);
        exit;
    }

    // Consulta para obtener el stock disponible del producto
    $sql_stock = "SELECT stock_producto FROM producto WHERE id_producto = ?";
    $stmt_stock = $conn->prepare($sql_stock);
    $stmt_stock->bind_param('i', $id_producto);
    $stmt_stock->execute();
    $stmt_stock->bind_result($stock_disponible);
    $stmt_stock->fetch();
    $stmt_stock->close();

    // Verifica si el stock disponible es suficiente
    if ($cantidad > $stock_disponible) {
        echo json_encode(['success' => false, 'error' => 'No hay suficiente stock para el producto solicitado.']);
        exit;
    }

    // Consulta para obtener la cantidad actual en el carrito para este producto
    $sql_carrito = "SELECT cantidad_producto FROM carrito_producto WHERE id_carrito = ? AND id_producto = ?";
    $stmt_carrito = $conn->prepare($sql_carrito);
    $stmt_carrito->bind_param('ii', $id_carrito, $id_producto);
    $stmt_carrito->execute();
    $stmt_carrito->bind_result($cantidad_actual);
    $stmt_carrito->fetch();
    $stmt_carrito->close();

    // Si ya existe el producto en el carrito, actualiza la cantidad
    if ($cantidad_actual) {
        $nueva_cantidad = $cantidad_actual + $cantidad;

        // Verifica que la nueva cantidad no supere el stock disponible
        if ($nueva_cantidad > $stock_disponible) {
            echo json_encode(['success' => false, 'error' => 'No hay suficiente stock para la cantidad solicitada.']);
            exit;
        }

        // Actualiza la cantidad del producto en el carrito
        $sql_update = "UPDATE carrito_producto SET cantidad_producto = ? WHERE id_carrito = ? AND id_producto = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param('iii', $nueva_cantidad, $id_carrito, $id_producto);
        $stmt_update->execute();
        $stmt_update->close();
    } else {
        // Si el producto no está en el carrito, agrégalo
        $sql_insert = "INSERT INTO carrito_producto (id_carrito, id_producto, cantidad_producto) VALUES (?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param('iii', $id_carrito, $id_producto, $cantidad);
        $stmt_insert->execute();
        $stmt_insert->close();
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
}

$conn->close();
?>
