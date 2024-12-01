<?php
include '../../config/conexion.php'; 
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_usuario'])) {
        $id_usuario = $_POST['id_usuario']; 

        // Consulta SQL
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

        // Construir el historial agrupado por id_compra
        $historial = [];
        while ($row = $result->fetch_assoc()) {
            $id_compra = $row['id_compra'];
            if (!isset($historial[$id_compra])) {
                $historial[$id_compra] = [
                    'id_compra' => $id_compra, 
                    'fecha_compra' => $row['fecha_compra'],
                    'productos' => []
                ];
            }
            $historial[$id_compra]['productos'][] = [
                'id_producto' => $row['id_producto'],
                'nombre_producto' => $row['nombre_producto'],
                'precio_unitario' => $row['precio_unitario'],
                'cantidad' => $row['cantidad'],
                'foto_producto' => $row['foto_producto']
            ];
        }

        // Reindexar para devolver un array en lugar de un objeto asociativo
        echo json_encode(array_values($historial));
    } else {
        echo json_encode(['error' => 'id_usuario no proporcionado.']);
    }
}
?>
