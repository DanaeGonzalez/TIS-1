<?php
include 'conexion.php';

// Obtener la oferta por ID
if (isset($_GET['id_oferta'])) {
    $id_oferta = $_GET['id_oferta'];
    $query = "SELECT * FROM oferta WHERE id_oferta = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_oferta);
    $stmt->execute();
    $result = $stmt->get_result();
    $oferta = $result->fetch_assoc();
}
?>

<form action="actualizar_oferta.php" method="post">
    <input type="hidden" name="id_oferta" value="<?php echo $oferta['id_oferta']; ?>">

    <label for="id_producto">ID Producto:</label>
    <input type="text" name="id_producto" value="<?php echo $oferta['id_producto']; ?>" disabled><br>

    <label for="porcentaje_descuento">Porcentaje de Descuento (0 a 1):</label>
    <input type="number" step="0.01" min="0" max="1" name="porcentaje_descuento" value="<?php echo $oferta['porcentaje_descuento']; ?>" required><br>

    <input type="submit" value="Actualizar Descuento">
</form>

<br>
<a href='mostrar_ofertas.php'>Volver</a>
