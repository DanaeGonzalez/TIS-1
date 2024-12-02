<?php
include '../../config/conexion.php';

$id_producto = $_GET['id_producto'] ?? null;

if (!$id_producto) {
    echo '<span>Error al cargar estrellas</span>';
    exit;
}

// Obtener la calificación promedio y la cantidad de reseñas
$query = "SELECT AVG(calificacion) as promedio, COUNT(*) as total FROM resenia WHERE id_producto = ? AND activo = 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

$promedio = round($result['promedio'], 1);
$total = $result['total'];

// Generar el HTML para las estrellas
for ($i = 1; $i <= 5; $i++) {
    if ($i <= $promedio) {
        echo '<i class="bi bi-star-fill text-warning"></i>'; // Estrella llena
    } else {
        echo '<i class="bi bi-star text-warning"></i>'; // Estrella vacía
    }
}
echo "<span style='font-size: 17px;'> ($total)</span>";
?>
