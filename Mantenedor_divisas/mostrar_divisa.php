<?php
include 'conexion.php';

$sql = "SELECT * FROM divisa";
$result = $conn->query($sql);

if ($result) {
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id_divisa"] . "</td>
                    <td>" . $row["codigo_divisa"] . "</td>
                    <td>" . $row["nombre_divisa"] . "</td>
                    <td>
                        <a href='editar_divisa.php?id=" . $row["id_divisa"] . "'>Editar</a> |
                        <a href='borrar_divisa.php?id=" . $row["id_divisa"] . "'>Borrar</a>
                    </td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No hay divisas registradas. <br>";
    }
} else {
    echo "Error en la consulta: " . $conn->error;
}
echo "<a href='insertar_divisa.php'>Agregar Divisa</a>";
?>
