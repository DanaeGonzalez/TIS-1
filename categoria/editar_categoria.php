<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM categoria WHERE id_categoria = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
</head>
<body>
    <h1>Editar Categoría</h1>
    <form action="actualizar_categoria.php" method="post">
        <input type="hidden" name="id_categoria" value="<?php echo $row['id_categoria']; ?>">
        Nombre: <input type="text" name="nombre_categoria" value="<?php echo $row['nombre_categoria']; ?>"><br><br>

        <input type="submit" value="Actualizar Categoría">
    </form>
</body>
</html>
