<?php
include 'conexion.php';

$sql = "SELECT * FROM producto";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Descripción</th>
                    <th>Características</th>
                    <th>Foto</th>
                    <th>Cantidad Vendida</th>
                    <th>Top Venta</th>
                    <th>Acciones</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id_producto"] . "</td>
                    <td>" . $row["nombre_producto"] . "</td>
                    <td>" . $row["precio_unitario"] . "</td>
                    <td>" . $row["stock_producto"] . "</td>
                    <td>" . $row["descripcion_producto"] . "</td>
                    <td>" . $row["caracteristicas_producto"] . "</td>
                    <td><img src='" . $row["foto_producto"] . "' alt='Foto del producto' width='50'></td>
                    <td>" . $row["cantidad_vendida"] . "</td>
                    <td>" . ($row["top_venta"] ? "Sí" : "No") . "</td>
                    <td>
                        <a href='editar_producto.php?id=" . $row["id_producto"] . "'>Editar</a> |
                        <a href='borrar_producto.php?id=" . $row["id_producto"] . "'>Borrar</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No hay productos registrados. <br>";
    }
} else {
    echo "Error en la consulta: " . $conn->error;
}
echo "<a href='insertar_producto.php'>Agregar Producto</a>";
?>
