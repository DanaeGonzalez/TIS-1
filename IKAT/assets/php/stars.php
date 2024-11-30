<?php
include '../../config/conexion.php';

$id_producto = $_GET['id_producto'];

// Obtener la calificación promedio y la cantidad de reseñas
$query = "SELECT AVG(calificacion) as promedio, COUNT(*) as total FROM resenia WHERE id_producto = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_producto);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

$promedio = round($result['promedio'], 1);
$total = $result['total'];

// Generar el HTML
echo '<div class="rating">';
for ($i = 5; $i >= 1; $i--) {
    $checked = ($i == round($promedio)) ? 'checked' : '';
    echo "<input value='$i' name='rate-$id_producto' id='star$i-$id_producto' type='radio' $checked>";
    echo "<label title='$i estrellas' for='star$i-$id_producto'></label>";
}
echo '</div>';
echo "<span style='font-size: 17px;'>($total)</span>";
