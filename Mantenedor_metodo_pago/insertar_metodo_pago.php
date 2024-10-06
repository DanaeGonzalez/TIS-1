<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar - Método de Pago</title>
</head>
<body>
    <form action="insertar_metodo_pago.php" method="post">
        Nombre del Método: <input type="text" name="nombre_metodo"><br>
        <input type="submit" value="Agregar Método de Pago">
        <a href="mostrar_metodo_pago.php">Volver</a>
    </form>
</body>
</html>

<?php
include 'conexion.php'; // Archivo que contiene la conexión a la base de datos.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_metodo'];

    $sql = "INSERT INTO metodo_pago (nombre_metodo) VALUES ('$nombre')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo método de pago agregado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
