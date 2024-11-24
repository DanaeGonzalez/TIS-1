<?php
include '../../config/conexion.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM metodo_pago WHERE id_metodo = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Método de pago eliminado exitosamente <br>";
    } else {
        $_SESSION['mensaje'] = "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: mostrar_metodo_pago.php');
    exit();
}
?>
