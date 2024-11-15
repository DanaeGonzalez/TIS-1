<?php
include '../../config/conexion.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM ambiente WHERE id_ambiente = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Ambiente eliminado exitosamente <br>";
    } else {
        $_SESSION['mensaje'] = "Error: " . $sql . "<br>" . $conn->error;
    }
}

header('Location: mostrar_ambiente.php');
exit();
?>


