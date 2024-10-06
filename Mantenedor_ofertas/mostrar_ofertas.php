<?php
include 'conexion.php';

// Consulta para mostrar todas las ofertas
$query = "SELECT o.id_oferta, o.porcentaje_descuento, p.nombre_producto
          FROM oferta o
          JOIN producto p ON o.id_producto = p.id_producto";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    echo "<table border='1'>
                <tr>
                    <th>ID Oferta</th>
                    <th>Producto</th>
                    <th>Porcentaje de Descuento</th>
                    <th>Acciones</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id_oferta"] . "</td>
                    <td>" . $row["nombre_producto"] . "</td>
                    <td>" . $row["porcentaje_descuento"] . "</td>
                    <td>
                        <form action='borrar_oferta.php' method='post' style='display:inline;'>
                            <input type='hidden' name='id_oferta' value='" . $row["id_oferta"] . "'>
                            <input type='submit' name='accion' value='Eliminar'>
                         </form>
                        <a href='editar_oferta.php?id_oferta=" . $row["id_oferta"] . "'>Editar</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    echo "<a href='agregar_oferta.php'>Agregar nueva oferta</a>";
} else {
    echo "No hay ofertas disponibles. <br>";
    echo "<a href='agregar_oferta.php'>Agregar nueva oferta</a>";
}
?>
