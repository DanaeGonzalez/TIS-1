<?php
include '../../config/conexion.php';
header('Content-Type: application/json');

// Verifica si se ha enviado una búsqueda
if (isset($_GET['buscar'])) {
    $buscar = $_GET['buscar'];

    // Consulta para buscar productos con LIKE
    $sql = "SELECT id_producto, nombre_producto, foto_producto, precio_unitario 
            FROM producto WHERE nombre_producto LIKE ? AND activo = 1";
    $stmt = $conn->prepare($sql);
    $param = "%" . $buscar . "%";
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $result = $stmt->get_result();

    $productos = [];
    while ($producto = $result->fetch_assoc()) {
        $productos[] = $producto; // Agregar resultados al arreglo
    }

    // Si no hay resultados, enviar un arreglo vacío
    if (empty($productos)) {
        echo json_encode([]); // Responder con un arreglo vacío si no hay productos
    } else {
        echo json_encode($productos); // Devolver resultados en formato JSON
    }
} else {
    echo json_encode(['error' => 'No se ha enviado parámetro de búsqueda']);
}
?>
