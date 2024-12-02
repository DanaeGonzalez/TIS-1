<?php
require_once '../../config/conexion.php'; // Archivo de conexión a la base de datos

$data = json_decode(file_get_contents('php://input'), true);

$idResena = $data['id_resenia'] ?? null;
$calificacion = $data['calificacion'] ?? null;
$comentario = $data['comentario'] ?? null;

if (!$idResena || !$calificacion || !$comentario) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios.']);
    exit;
}

$sql = "UPDATE resenia SET calificacion = ?, comentario = ?, fecha_resenia = NOW() WHERE id_resenia = ? AND activo = 1";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param('isi', $calificacion, $comentario, $idResena);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se realizaron cambios en la reseña.']);
        }
    } else {
        error_log('Error en la consulta SQL: ' . $stmt->error);
        echo json_encode(['success' => false, 'message' => 'Error al actualizar la reseña.']);
    }

    $stmt->close();
} else {
    error_log('Error en la preparación de la consulta: ' . $conn->error);
    echo json_encode(['success' => false, 'message' => 'Error en la preparación de la consulta.']);
}
?>
