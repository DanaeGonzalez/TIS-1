<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id_metodo'];
    $nombre = $_POST['nombre_metodo'];

    $sql = "UPDATE metodo_pago SET nombre_metodo='$nombre' WHERE id_metodo=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Método de pago actualizado exitosamente <br>";
        echo "<a href='mostrar_metodo_pago.php'>Volver</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
