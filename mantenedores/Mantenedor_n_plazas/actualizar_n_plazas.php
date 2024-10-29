<?php
    session_start();
    include '../conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_n_plazas = $_POST['id_n_plazas'];
        $tamaño_plaza = $_POST['tamaño_plaza'];

        $sql = "UPDATE n_plazas SET tamaño_plaza='$tamaño_plaza' WHERE id_n_plazas= $id_n_plazas";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensaje'] = "Plazas editada exitosamente";
        } else {
            $_SESSION['mensaje'] = "Error al editar plazas: " . $conn->error;
        }
    
        header('Location: mostrar_n_plazas.php');
        exit();
    }
?>