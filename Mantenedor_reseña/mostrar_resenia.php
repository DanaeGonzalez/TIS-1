<?php
include 'conexion.php'; 

$sql = "SELECT * FROM resenia";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Calificación</th>
                <th>Comentario</th>
                <th>ID Usuario</th>
                <th>ID Producto</th>
                <th>Acciones</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_resenia"] . "</td>
                <td>" . $row["calificacion"] . "</td>
                <td>" . $row["comentario"] . "</td>
                <td>" . $row["id_usuario"] . "</td>
                <td>" . $row["id_producto"] . "</td>
                <td>
                    <a href='editar_resenia.php?id=" . $row["id_resenia"] . "'>Editar</a> |
                    <a href='borrar_resenia.php?id=" . $row["id_resenia"] . "'>Borrar</a>
                </td>
              </tr>";
    }
    echo "</table>";
    echo "<a href='insertar_resenia.php'>Agregar Reseña</a>";
} else {
    echo "No hay reseñas registradas. <br>";
    echo "<a href='insertar_resenia.php'>Agregar Reseña</a>";
}
?>
