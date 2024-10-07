<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM categoria WHERE id_categoria = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Categoria eliminada exitosamente <br>";
        echo "<a href='mostrar_categoria.php'>Volver</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>