<?php
include '../../config/conexion.php'; // Cambia la ruta si es necesario
header('Content-Type: application/json');
// Verifica si se ha enviado una búsqueda
if (isset($_GET['buscar'])) {
    $buscar = $_GET['buscar'];

    // Preparar la consulta SQL con LIKE para buscar coincidencias
    $sql = "SELECT * FROM producto WHERE nombre_producto LIKE ? AND activo = 1";
    $stmt = $conn->prepare($sql);
    $param = "%" . $buscar . "%"; // Agregar % para la búsqueda parcial
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $result = $stmt->get_result();

    $productos = [];

    if ($result->num_rows > 0) {
        while ($producto = $result->fetch_assoc()) {
            $productos[] = $producto;
        }
        echo json_encode($productos);
    } else {
        echo json_encode(["error" => "No se encontraron productos."]);
    }
    
}

