<?php
    session_start();
    include '../../config/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_n_asientos = $_POST['id_n_asientos'];
        $cantidad_asientos = $_POST['cantidad_asientos'];

        $sql = "UPDATE n_asientos SET cantidad_asientos='$cantidad_asientos' WHERE id_n_asientos= $id_n_asientos";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensaje'] = "Asiento editado exitosamente";
        } else {
            $_SESSION['mensaje'] = "Error al editar el color: " . $conn->error;
        }
    
        header('Location: mostrar_n_asientos.php');
        exit();
    }
?>