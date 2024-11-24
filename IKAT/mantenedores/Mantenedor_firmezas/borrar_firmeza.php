<?php
include '../../config/conexion.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM firmeza WHERE id_firmeza = $id";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Nivel de firmeza eliminado exitosamente <br>";
    } else {
        $_SESSION['mensaje'] = "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: mostrar_firmeza.php');
    exit();
}
?>