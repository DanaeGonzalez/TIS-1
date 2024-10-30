<?php
    session_start();
    include '../../config/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_firmeza = $_POST['id_firmeza'];
        $nivel_firmeza = $_POST['nivel_firmeza'];

        $sql = "UPDATE firmeza SET nivel_firmeza='$nivel_firmeza' WHERE id_firmeza= $id_firmeza";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensaje'] = "Nivel de firmeza editado exitosamente";
        } else {
            $_SESSION['mensaje'] = "Error al editar el nivel de firmeza: " . $conn->error;
        }
    
        header('Location: mostrar_firmeza.php');
        exit();
    }
?>