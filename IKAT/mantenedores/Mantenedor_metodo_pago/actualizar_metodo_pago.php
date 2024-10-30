<?php
session_start();
include '../conexion.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_categoria = $_POST['id_metodo'];
    $nombre_categoria = $_POST['nombre_metodo'];

    $sql = "UPDATE metodo_pago SET nombre_metodo='$nombre_categoria' WHERE id_metodo=$id_categoria";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Metodo de pago actualizado exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar metodo de pago: " . $conn->error;
    }

    header('Location: mostrar_metodo_pago.php');
    exit();
}
?>
