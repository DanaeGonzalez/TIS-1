<?php
include '../../config/conexion.php';
header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario']; 

    $query = "SELECT cp.id_compra, p.nombre_producto, p.precio_unitario, cp.cantidad, p.foto_producto, c.fecha_compra
              FROM compra_producto cp
              JOIN producto p USING (id_producto)
              JOIN compra c USING (id_compra)
              WHERE c.id_usuario = ?
              ORDER BY c.fecha_compra DESC";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    $historial = [];
    while ($row = $result->fetch_assoc()) {
        $historial[] = $row;
    }

    echo json_encode($historial);
    exit;
}
?>
