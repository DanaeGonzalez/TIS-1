<?php
include '../../config/conexion.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM forma WHERE id_forma = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Forma eliminada exitosamente <br>";
    } else {
        $_SESSION['mensaje'] = "Error: " . $sql . "<br>" . $conn->error;
    }

    header('Location: mostrar_forma.php');
    exit();
}
?>
