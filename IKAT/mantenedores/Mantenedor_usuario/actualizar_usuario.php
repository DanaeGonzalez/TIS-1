<?php
    session_start();
    include '../../config/conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id_usuario'];
        $nombre = $_POST['nombre_usuario'];
        $apellido = $_POST['apellido_usuario'];
        $run = $_POST['run_usuario'];
        $correo = $_POST['correo_usuario'];
        $numero = $_POST['numero_usuario'];
        $direccion = $_POST['direccion_usuario'];
        $tipo = $_POST['tipo_usuario'];

        $sql = "UPDATE usuario SET 
                nombre_usuario='$nombre', apellido_usuario='$apellido', 
                run_usuario='$run', correo_usuario='$correo', 
                numero_usuario='$numero', direccion_usuario='$direccion', 
                tipo_usuario='$tipo' WHERE id_usuario=$id";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensaje'] = "Usuario actualizado exitosamente <br>";
        } else {
            $_SESSION['mensaje'] = "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
        }
    }

    header('Location: mostrar_usuario.php');
    exit();
?>