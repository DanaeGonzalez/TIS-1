<?php
    session_start();
    include '../conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_ambiente = $_POST['id_ambiente'];
        $nombre_ambiente = $_POST['nombre_ambiente'];

        $sql = "UPDATE ambiente SET nombre_ambiente='$nombre_ambiente' WHERE id_ambiente= $id_ambiente";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensaje'] = "Ambiente editado exitosamente";
        } else {
            $_SESSION['mensaje'] = "Error al editar el ambiente: " . $conn->error;
        }
    
        header('Location: mostrar_ambiente.php');
        exit();
    }
?>