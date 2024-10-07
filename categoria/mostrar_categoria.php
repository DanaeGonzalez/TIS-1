<?php
    include 'conexion.php';


$sql = "SELECT * FROM categoria";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_categoria"] . "</td>
                <td>" . $row["nombre_categoria"] . "</td>
                <td>
                    <a href='editar_categoria.php?id=" . $row["id_categoria"] . "'>Editar</a> |
                    <a href='borrar_categoria.php?id=" . $row["id_categoria"] . "'>Borrar</a>
                </td>
              </tr>";
    }
    echo "</table>";
    echo "<a href='insert_categoria.php'>Agregar categoria</a>";
} else {
    echo "No hay categoria registrados.";
}
?>