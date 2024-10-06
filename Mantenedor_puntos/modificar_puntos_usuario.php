<?php
include 'conexion.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Puntos - Usuario</title>
</head>
<body>
    <h2>Modificar Puntos del Usuario</h2>
    <form action="modificar_puntos_usuario.php" method="post">
        <label for="id_usuario">ID del Usuario:</label>
        <input type="number" name="id_usuario" required><br><br>
        <label for="cantidad_modificar">Cantidad a modificar (Negativo para descontar):</label>
        <input type="number" name="cantidad_modificar" required><br><br>
        <input type="submit" value="Modificar puntos">
    </form>
    <a href="mostrar_usuario.php">Volver</a>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $cantidad_modificar = $_POST['cantidad_modificar'];

    $sql = "SELECT puntos_totales FROM usuario WHERE id_usuario = $id_usuario";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $puntos_actual = $row['puntos_totales'];

        $nueva_cantidad = $puntos_actual + $cantidad_modificar;

        if ($nueva_cantidad < 0) {
            echo "Error: No se puede tener puntos negativos.";
        } else {
            
            $sql_update = "UPDATE usuario SET puntos_totales = $nueva_cantidad WHERE id_usuario = $id_usuario";

            if ($conn->query($sql_update) === TRUE) {
                echo "Puntos actualizados exitosamente.";
            } else {
                echo "Error al actualizar los puntos: " . $conn->error;
            }
        }
    } else {
        echo "Error: Usuario no encontrado.";
    }
}
?>
