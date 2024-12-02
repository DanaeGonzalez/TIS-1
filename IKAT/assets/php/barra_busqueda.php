<?php
include '../../config/conexion.php';

// Obtener el término de búsqueda
$buscar = $_GET['buscar'] ?? '';

if ($buscar) {
    $sql = "SELECT id_producto, nombre_producto, foto_producto FROM producto 
    WHERE nombre_producto LIKE '%$buscar%' AND activo = 1 ORDER BY nombre_producto ASC LIMIT 10";
    
    $result = $conn->query($sql);

    $productos = [];
    if ($result && $result->num_rows > 0) {
        while ($producto = $result->fetch_assoc()) {
            // Ajustar la ruta de la imagen

            $productos[] = [
                'id_producto' => $producto['id_producto'],
                'nombre_producto' => $producto['nombre_producto'],
                'foto_producto' => $producto['foto_producto'],
            ];
        }
    }

    // Devolver los resultados como JSON
    echo json_encode($productos);
} else {
    echo json_encode([]);
}
?>
