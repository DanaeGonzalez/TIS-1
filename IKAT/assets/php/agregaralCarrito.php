<?php
session_start(); // Asegúrate de que las sesiones están iniciadas
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

    // Consulta para agregar el producto al carrito
    $sql = "INSERT INTO carrito_producto (id_carrito, id_producto, cantidad_producto) 
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE cantidad_producto = cantidad_producto + ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iiii', $id_carrito, $id_producto, $cantidad, $cantidad); // El último parámetro actualiza la cantidad si ya existe

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Datos inválidos']);
}

$conn->close();
?>
