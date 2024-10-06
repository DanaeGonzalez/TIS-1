<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id_resenia = $_GET['id'];
    $sql = "SELECT * FROM resenia WHERE id_resenia = $id_resenia";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<form action="actualizar_resenia.php" method="post">
    <input type="hidden" name="id_resenia" value="<?php echo $row['id_resenia']; ?>">
    Calificación: <input type="number" name="calificacion" value="<?php echo $row['calificacion']; ?>" required><br>
    Comentario: <input type="text" name="comentario" value="<?php echo $row['comentario']; ?>"><br>
    <input type="submit" value="Actualizar Reseña">
</form>
