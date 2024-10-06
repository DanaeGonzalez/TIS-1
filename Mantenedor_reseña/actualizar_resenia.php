<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_resenia = $_POST['id_resenia'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];

    $sql = "UPDATE resenia SET calificacion=$calificacion, comentario='$comentario'
            WHERE id_resenia=$id_resenia";

    if ($conn->query($sql) === TRUE) {
        echo "Reseña actualizada exitosamente <br>";
        echo "<a href='mostrar_resenia.php'>Volver</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
