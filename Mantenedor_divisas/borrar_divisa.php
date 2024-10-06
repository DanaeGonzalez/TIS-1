<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM divisa WHERE id_divisa = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Divisa eliminada exitosamente <br>";
        echo "<a href='mostrar_divisa.php'>Volver</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
