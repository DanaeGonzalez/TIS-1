<?php
session_start();
include_once '../../config/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(['success' => false, 'message' => 'Usuario no autenticado.']);
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$data = json_decode(file_get_contents("php://input"), true);
$id_producto = $data['id_producto'] ?? null;

if ($id_producto) {
    // Primero verificamos si el producto ya está en la lista de deseos del usuario
    $check_sql = "SELECT 1 FROM lista_deseos_producto AS ldp
                  INNER JOIN lista_de_deseos AS ld ON ld.id_lista_deseos = ldp.id_lista_deseos
                  WHERE ld.id_usuario = ? AND ldp.id_producto = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $id_usuario, $id_producto);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // El producto ya está en la lista de deseos
        echo json_encode(['success' => false, 'message' => 'El producto ya se encuentra en la lista de deseos.']);
    } else {
        // Si el producto no está, procedemos a insertarlo
        $sql = "INSERT INTO lista_deseos_producto (id_lista_deseos, id_producto)
                SELECT id_lista_deseos, ? FROM lista_de_deseos WHERE id_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id_producto, $id_usuario);
        $result = $stmt->execute();

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Producto agregado a la lista de deseos.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al agregar el producto a la lista de deseos.']);
        }
    }

    $check_stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'ID de producto no proporcionado.']);
}

$conn->close();
?>
