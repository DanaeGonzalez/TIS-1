<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM usuario WHERE id_usuario = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado exitosamente <br>";
        echo "<a href='mostrar_usuario.php'>Volver</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
