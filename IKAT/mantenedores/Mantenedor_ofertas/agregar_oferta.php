<?php
session_start();
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST["id_producto"];
    $porcentaje_descuento = $_POST["porcentaje_descuento"];
    $activo = 1; 

    $query = "INSERT INTO oferta (id_producto, porcentaje_descuento, activo) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("idi", $id_producto, $porcentaje_descuento, $activo);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Oferta agregada con éxito.";
    } else {
        $_SESSION['mensaje'] = "Error al agregar la oferta.";
    }

    header('Location: mostrar_ofertas.php');
    exit();
}
?>
