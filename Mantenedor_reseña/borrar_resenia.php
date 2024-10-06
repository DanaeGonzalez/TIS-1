<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id_resenia = $_GET['id'];
    $sql = "DELETE FROM resenia WHERE id_resenia = $id_resenia";

    if ($conn->query($sql) === TRUE) {
        echo "Reseña eliminada exitosamente <br>";
        echo "<a href='mostrar_resenia.php'>Volver</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
