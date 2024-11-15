<?php
session_start();
include '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nivel_firmeza = $_POST['nivel_firmeza'];

    $sql = "INSERT INTO firmeza (nivel_firmeza) VALUES ('$nivel_firmeza')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Nivel de firmeza agregado exitosamente";
    } else {
        $_SESSION['mensaje'] = "Error al agregar el nivel de firmeza: " . $conn->error;
    }

    header('Location: mostrar_firmeza.php');
    exit();
}
?>