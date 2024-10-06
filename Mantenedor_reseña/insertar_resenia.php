<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar - Reseña</title>
</head>
<body>
    <form action="insertar_resenia.php" method="post">
        Calificación: <input type="number" name="calificacion" required><br>
        Comentario: <input type="text" name="comentario"><br>
        ID Usuario: <input type="number" name="id_usuario" required><br>
        ID Producto: <input type="number" name="id_producto" required><br>
        <input type="submit" value="Crear Reseña">
        <a href="mostrar_resenia.php">Volver</a>
    </form>
</body>
</html>

<?php
include 'conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];
    $id_usuario = $_POST['id_usuario'];
    $id_producto = $_POST['id_producto'];

    $sql = "INSERT INTO resenia (calificacion, comentario, id_usuario, id_producto)
            VALUES ($calificacion, '$comentario', $id_usuario, $id_producto)";

    if ($conn->query($sql) === TRUE) {
        echo "Nueva reseña creada exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
