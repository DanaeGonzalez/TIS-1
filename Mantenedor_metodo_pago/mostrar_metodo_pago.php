<?php
include 'conexion.php'; // Archivo de conexión a la base de datos

$sql = "SELECT * FROM metodo_pago";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre del Método</th>
                <th>Acciones</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_metodo"] . "</td>
                <td>" . $row["nombre_metodo"] . "</td>
                <td>
                    <a href='editar_metodo_pago.php?id=" . $row["id_metodo"] . "'>Editar</a> |
                    <a href='borrar_metodo_pago.php?id=" . $row["id_metodo"] . "'>Borrar</a>
                </td>
              </tr>";
    }
    echo "</table>";
    echo "<a href='insertar_metodo_pago.php'>Agregar Método de Pago</a>";
} else {
    echo "No hay métodos de pago registrados. <br>";
    echo "<a href='insertar_metodo_pago.php'>Agregar Método de Pago</a>";
}
?>
