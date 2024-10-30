<?php
    session_start();
    include '../conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_material = $_POST['id_material'];
        $nombre_material = $_POST['nombre_material'];

        $sql = "UPDATE material SET nombre_material='$nombre_material' WHERE id_material= $id_material";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensaje'] = "Material editado exitosamente";
        } else {
            $_SESSION['mensaje'] = "Error al editar el material: " . $conn->error;
        }
    
        header('Location: mostrar_material.php');
        exit();
    }
?>