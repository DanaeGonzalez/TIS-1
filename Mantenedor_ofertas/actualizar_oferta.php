<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_oferta = $_POST['id_oferta'];
    $porcentaje_descuento = $_POST['porcentaje_descuento'];

    // Actualizar el porcentaje de descuento
    $query = "UPDATE oferta SET porcentaje_descuento = ? WHERE id_oferta = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("di", $porcentaje_descuento, $id_oferta);

    if ($stmt->execute()) {
        echo "Oferta actualizada con éxito.";
    } else {
        echo "Error al actualizar la oferta.";
    }
}
?>

<br>
<a href='mostrar_ofertas.php'>Volver</a>
