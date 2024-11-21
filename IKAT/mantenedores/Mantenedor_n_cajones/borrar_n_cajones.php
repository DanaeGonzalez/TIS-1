<?php
include '../../config/conexion.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM n_cajones WHERE id_n_cajones = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Cajones eliminado exitosamente <br>";
    } else {
        $_SESSION['mensaje'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location: mostrar_n_cajones.php');
    exit();
}
?>
