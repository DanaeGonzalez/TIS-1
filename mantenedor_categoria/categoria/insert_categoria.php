
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar - Categoría</title>
</head>
<body>
    <form action="insert_categoria.php" method="post">
        Nombre: <input type="text" name="nombre_categoria" required><br><br>
        <input type="submit" value="Crear categoría"><br>
        <a href='mostrar_categoria.php'>Volver</a>
    </form>
    <br>
</body>
</html>

<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_categoria = $_POST['nombre_categoria'];

    $sql = "INSERT INTO categoria (nombre_categoria)
            VALUES ('$nombre_categoria')";

    if ($conn->query($sql) === TRUE) {
        echo "Nueva categoría creada exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}
// Cerrar la conexión
$conn->close();
?>
