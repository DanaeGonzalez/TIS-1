<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_categoria = $_POST['id_categoria'];
    $nombre_categoria = $_POST['nombre_categoria'];


    $sql = "UPDATE categoria SET nombre_categoria='$nombre_categoria' WHERE id_categoria= $id_categoria";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado exitosamente <br>";
        echo "<a href='mostrar_categoria.php'>Volver</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>