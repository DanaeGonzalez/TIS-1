<?php
session_start();
include '../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $nombre = $_POST['nombre_usuario'];
        $apellido = $_POST['apellido_usuario'];
        $run = $_POST['run_usuario'];
        $correo = $_POST['correo_usuario'];
        $numero = $_POST['numero_usuario'];
        $contrasenia = password_hash($_POST['contrasenia_usuario'], PASSWORD_BCRYPT);
        $direccion = $_POST['direccion_usuario'];
        $tipo = $_POST['tipo_usuario'];
        $puntos_totales = 0;
        $activo = 1;
        $ultima_sesion = NULL;

        $sql = "INSERT INTO usuario (nombre_usuario, apellido_usuario, run_usuario, correo_usuario, numero_usuario, contrasenia_usuario, direccion_usuario, tipo_usuario, puntos_totales, activo, ultima_sesion)
                VALUES ('$nombre', '$apellido', '$run', '$correo', '$numero', '$contrasenia', '$direccion', '$tipo', $puntos_totales, $activo, $ultima_sesion)";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['mensaje'] = "Usuario creado exitosamente";
        } else {
            $_SESSION['mensaje'] = "Error al crear Usuario: " . $conn->error;
        }
    }
        
   

    header('Location: mostrar_usuario.php');
    exit();
}
?>



