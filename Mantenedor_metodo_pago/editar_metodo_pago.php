<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM metodo_pago WHERE id_metodo = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<form action="actualizar_metodo_pago.php" method="post">
    <input type="hidden" name="id_metodo" value="<?php echo $row['id_metodo']; ?>">
    Nombre del Método: <input type="text" name="nombre_metodo" value="<?php echo $row['nombre_metodo']; ?>"><br>
    <input type="submit" value="Actualizar Método de Pago">
</form>
