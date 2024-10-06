<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar - Divisa</title>
</head>
<body>
    <form action="insertar_divisa.php" method="post">
        Código de la Divisa: <input type="text" name="codigo_divisa" required><br>
        Nombre de la Divisa: <input type="text" name="nombre_divisa" required><br>
        <input type="submit" value="Crear Divisa">
        <a href="mostrar_divisa.php">Volver</a>
    </form>

</body>
</html>

<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo = $_POST['codigo_divisa'];
    $nombre = $_POST['nombre_divisa'];

    $sql = "INSERT INTO divisa (codigo_divisa, nombre_divisa) VALUES ('$codigo', '$nombre')";

    if ($conn->query($sql) === TRUE) {
        echo "Nueva divisa creada exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
