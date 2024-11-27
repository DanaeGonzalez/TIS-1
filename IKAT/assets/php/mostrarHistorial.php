<?php
include '../../config/conexion.php'; 
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_usuario'])) {
        $id_usuario = $_POST['id_usuario']; 

        //Consulta SQL
        $query = "SELECT cp.id_compra, p.nombre_producto, p.id_producto, p.precio_unitario, cp.cantidad, p.foto_producto, c.fecha_compra
                  FROM compra_producto cp
                  JOIN producto p USING (id_producto)
                  JOIN compra c USING (id_compra)
                  WHERE c.id_usuario = ?
                  ORDER BY c.fecha_compra DESC";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        //Construir el historial de compras
        $historial = [];
        while ($row = $result->fetch_assoc()) {
            $historial[] = $row;
        }

        // Responder con el historial en formato JSON
        echo json_encode($historial);
    } else {
        echo json_encode(['error' => 'id_usuario no proporcionado.']);  // Si no se proporciona id_usuario
    }
}
?>
