<?php
    session_start();
    include '../../config/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_forma = $_POST['id_forma'];
        $nombre_forma = $_POST['nombre_forma'];

        $sql = "UPDATE forma SET nombre_forma='$nombre_forma' WHERE id_forma= $id_forma";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensaje'] = "Forma editada exitosamente";
        } else {
            $_SESSION['mensaje'] = "Error al editar la forma: " . $conn->error;
        }
    
        header('Location: mostrar_forma.php');
        exit();
    }
?>