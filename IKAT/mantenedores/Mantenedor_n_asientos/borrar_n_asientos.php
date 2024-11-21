<?php
include '../../config/conexion.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM n_asientos WHERE id_n_asientos = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Asiento eliminado exitosamente <br>";
    } else {
        $_SESSION['mensaje'] = "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: mostrar_n_asientos.php');
    exit();
}
?>
