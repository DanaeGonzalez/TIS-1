<?php
session_start();
include '../../config/conexion.php';

if (isset($_SESSION['id_usuario'])) {
    $user_id = $_SESSION['id_usuario'];
    $query = "UPDATE usuario SET ultima_sesion = NOW() WHERE id_usuario = '$user_id'";
    mysqli_query($conn, $query);    
}

session_destroy();
header("Location: login.php");
exit(); // Es buena práctica agregar exit después de header()
?>