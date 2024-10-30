<?php
session_start();
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_oferta = $_POST['id_oferta'];
    $porcentaje_descuento = $_POST['porcentaje_descuento'];

    $query = "UPDATE oferta SET porcentaje_descuento = ? WHERE id_oferta = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("di", $porcentaje_descuento, $id_oferta);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Oferta actualizada exitosamente <br>";
    } else {
        $_SESSION['mensaje'] = "<div class='alert alert-danger'>Error al actualizar la oferta.</div>";
    }
}

header('Location: mostrar_ofertas.php');
exit();
?>
