<?php
    session_start();
    include '../conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_n_cajones = $_POST['id_n_cajones'];
        $cantidad_cajones = $_POST['cantidad_cajones'];

        $sql = "UPDATE n_asientos SET cantidad_cajones='$cantidad_cajones' WHERE id_n_cajones= $id_n_cajones";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensaje'] = "Cajones editados exitosamente";
        } else {
            $_SESSION['mensaje'] = "Error al editar cajon: " . $conn->error;
        }
    
        header('Location: mostrar_n_cajones.php');
        exit();
    }
?>