<?php
session_start();
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST["id_producto"];
    $porcentaje_descuento = $_POST["porcentaje_descuento"];

    $query = "INSERT INTO oferta (id_producto, porcentaje_descuento) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("id", $id_producto, $porcentaje_descuento);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Oferta agregada con éxito.";
    } else {
        $_SESSION['mensaje'] = "Error al agregar la oferta.";
    }
}

$query = "SELECT id_producto, nombre_producto FROM producto";
$result = $conn->query($query);

    header('Location: mostrar_ofertas.php');
    exit();
?>
