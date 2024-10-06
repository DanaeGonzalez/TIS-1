<?php
include 'conexion.php';

// Cuando se envía el formulario para agregar una oferta
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST["id_producto"];
    $porcentaje_descuento = $_POST["porcentaje_descuento"];

    $query = "INSERT INTO oferta (id_producto, porcentaje_descuento) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("id", $id_producto, $porcentaje_descuento);
    
    if ($stmt->execute()) {
        echo "Oferta agregada con éxito.";
    } else {
        echo "Error al agregar la oferta.";
    }
}

// Mostrar los productos disponibles para aplicar oferta
$query = "SELECT id_producto, nombre_producto FROM producto";
$result = $conn->query($query);
?>

<form method="post" action="">
    <label for="id_producto">Selecciona el producto por ID:</label>
    <input type="number" name="id_producto" required><br>

    <label for="porcentaje_descuento">Porcentaje de descuento (0 a 1):</label>
    <input type="number" step="0.01" min="0" max="1" name="porcentaje_descuento" required><br>

    <button type="submit">Agregar Oferta</button>
</form>

<br>
<a href='mostrar_ofertas.php'>Volver</a>
