<?php
include '../../config/conexion.php'; 
header('Content-Type: application/json');

file_put_contents('php://stderr', "PHP recibido: " . json_encode($_POST) . "\n");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_compra'])) {
        $id_compra = $_POST['id_compra'];

        $query = "SELECT p.id_producto, p.nombre_producto, p.precio_unitario, cp.cantidad, p.foto_producto
                  FROM compra_producto cp
                  JOIN producto p USING (id_producto)
                  WHERE cp.id_compra = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_compra);
        $stmt->execute();
        $result = $stmt->get_result();

        $productos = [];
        while ($row = $result->fetch_assoc()) {
            $productos[] = [
                'id_producto' => $row['id_producto'],
                'nombre_producto' => $row['nombre_producto'],
                'precio_unitario' => $row['precio_unitario'],
                'cantidad' => $row['cantidad'],
                'foto_producto' => $row['foto_producto']
            ];
        }

        echo json_encode($productos);
    } else {
        echo json_encode(['error' => 'id_compra no proporcionado.']);
    }
} else {
    echo json_encode(['error' => 'Método no permitido.']);
}
?>
