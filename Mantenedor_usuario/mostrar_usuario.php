<?php
include 'conexion.php'; // Archivo de conexión a la base de datos

$sql = "SELECT * FROM usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>RUN</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Tipo</th>
                <th>Puntos</th>
                <th>Acciones</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id_usuario"] . "</td>
                <td>" . $row["nombre_usuario"] . "</td>
                <td>" . $row["apellido_usuario"] . "</td>
                <td>" . $row["run_usuario"] . "</td>
                <td>" . $row["correo_usuario"] . "</td>
                <td>" . $row["numero_usuario"] . "</td>
                <td>" . $row["direccion_usuario"] . "</td>
                <td>" . $row["tipo_usuario"] . "</td>
                <td>" . $row["puntos_totales"] . "</td>
                <td>
                    <a href='editar_usuario.php?id=" . $row["id_usuario"] . "'>Editar</a> |
                    <a href='borrar_usuario.php?id=" . $row["id_usuario"] . "'>Borrar</a>
                </td>
              </tr>";
    }
    echo "</table>";
    echo "<a href='insertar_usuario.php'>Agregar Usuario</a>";
} else {
    echo "No hay usuarios registrados.";
}
?>
