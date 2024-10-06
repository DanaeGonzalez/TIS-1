<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM divisa WHERE id_divisa = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<form action="actualizar_divisa.php" method="post">
    <input type="hidden" name="id_divisa" value="<?php echo $row['id_divisa']; ?>">
    Código de la Divisa: <input type="text" name="codigo_divisa" value="<?php echo $row['codigo_divisa']; ?>" required><br>
    Nombre de la Divisa: <input type="text" name="nombre_divisa" value="<?php echo $row['nombre_divisa']; ?>" required><br>
    <input type="submit" value="Actualizar Divisa">
</form>
