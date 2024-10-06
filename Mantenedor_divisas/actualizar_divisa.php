<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_divisa'];
    $codigo = $_POST['codigo_divisa'];
    $nombre = $_POST['nombre_divisa'];

    $sql = "UPDATE divisa SET codigo_divisa='$codigo', nombre_divisa='$nombre' WHERE id_divisa=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Divisa actualizada exitosamente <br>";
        echo "<a href='mostrar_divisa.php'>Volver</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
