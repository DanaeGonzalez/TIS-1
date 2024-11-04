<?php
    session_start();
    include '../../config/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_color = $_POST['id_color'];
        $nombre_color = $_POST['nombre_color'];

        $sql = "UPDATE color SET nombre_color='$nombre_color' WHERE id_color= $id_color";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensaje'] = "Color editado exitosamente";
        } else {
            $_SESSION['mensaje'] = "Error al editar el color: " . $conn->error;
        }
    
        header('Location: mostrar_color.php');
        exit();
    }
?>