<?php
include_once '../../config/conexion.php';
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../login.php');
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

// Eliminar todos los productos de la lista de deseos
$eliminar_deseos = $conn->prepare("DELETE FROM lista_deseos_producto WHERE id_lista_deseos = (SELECT id_lista_deseos FROM lista_de_deseos WHERE id_usuario = ?)");
$eliminar_deseos->bind_param("i", $id_usuario);
$eliminar_deseos->execute();

$eliminar_deseos->close();

// Redirigir a la página de deseos después de eliminar
header("Location: ../../views/deseados.php");
exit();
?>
