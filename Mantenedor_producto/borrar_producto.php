<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM producto WHERE id_producto = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado exitosamente <br>";
        echo "<a href='mostrar_producto.php'>Volver</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
