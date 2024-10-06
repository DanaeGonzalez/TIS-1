<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM metodo_pago WHERE id_metodo = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Método de pago eliminado exitosamente <br>";
        echo "<a href='mostrar_metodo_pago.php'>Volver</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
