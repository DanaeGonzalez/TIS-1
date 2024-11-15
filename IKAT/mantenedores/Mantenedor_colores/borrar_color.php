<?php
include '../../config/conexion.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM color WHERE id_color = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Color eliminado exitosamente <br>";
    } else {
        $_SESSION['mensaje'] = "Error: " . $sql . "<br>" . $conn->error;
    }
}

header('Location: mostrar_color.php');
exit();
?>

