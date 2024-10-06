<?php
include 'conexion.php';

// Consulta para mostrar productos top ventas
$query = "SELECT * FROM producto WHERE top_venta = true";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    echo "<table border='1'>
                <tr>
                    <th>ID Producto</th>
                    <th>Nombre</th>
                    <th>Precio Unitario</th>
                    <th>Acciones</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id_producto"] . "</td>
                    <td>" . $row["nombre_producto"] . "</td>
                    <td>" . $row["precio_unitario"] . "</td>
                    <td>
                        <form action='borrar_top_ventas.php' method='post'>
                            <input type='hidden' name='id_producto' value='" . $row["id_producto"] . "'>
                            <input type='submit' name='accion' value='quitar'>
                        </form>
                    </td>
                  </tr>";
        }
        echo "</table>";
    echo "<a href='agregar_top_ventas.php'>Agregar top ventas</a>";
} else {
    echo "No hay productos en top ventas. <br>";
    echo "<a href='agregar_top_ventas.php'>Agregar top ventas</a>";
}
?>
