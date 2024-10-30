<?php
    session_start();
    include '../conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_categoria = $_POST['id_categoria'];
        $nombre_categoria = $_POST['nombre_categoria'];

        $sql = "UPDATE categoria SET nombre_categoria='$nombre_categoria' WHERE id_categoria= $id_categoria";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensaje'] = "Categoria editada exitosamente";
        } else {
            $_SESSION['mensaje'] = "Error al editar producto: " . $conn->error;
        }
    
        header('Location: mostrar_categoria.php');
        exit();
    }
?>