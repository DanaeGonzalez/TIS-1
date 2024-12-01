<?php
session_start();
require_once '../../config/conexion.php';

$data = json_decode(file_get_contents('php://input'), true);

$producto_id = $data['producto_id'] ?? null;
$calificacion = $data['calificacion'] ?? null;
$comentario = $data['comentario'] ?? null;  
$id_usuario = $_SESSION['id_usuario'] ?? null;

if (!$producto_id || !$calificacion || !$comentario || !$id_usuario) {
    echo json_encode([
        'success' => false,
        'message' => 'Faltan datos obligatorios',
        'data' => compact('producto_id', 'calificacion', 'comentario', 'id_usuario')
    ]);
    exit;
}

$sql = "INSERT INTO resenia (id_producto, id_usuario, calificacion, comentario, activo, fecha_resenia) 
        VALUES (?, ?, ?, ?, 1, NOW())";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al preparar la consulta: ' . $conn->error
    ]);
    exit;
}

$stmt->bind_param("iiis", $producto_id, $id_usuario, $calificacion, $comentario);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'No se pudo guardar la reseña',
        'error' => $stmt->error
    ]);
}

$stmt->close();
?>
