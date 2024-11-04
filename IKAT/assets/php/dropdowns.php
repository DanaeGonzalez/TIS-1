<?php
include_once '../config/conexion.php';

function generarDropdown($nombreDropdown, $nombreTabla, $columnaId, $columnaNombre) {
    global $conn;

    if (!$conn) {
        echo "<span class='dropdown-item text-danger'>Error de conexión</span>";
        return;
    }

    $sql = "SELECT $columnaId, $columnaNombre FROM $nombreTabla";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($fila = $result->fetch_assoc()) {
            echo "<label class='dropdown-item'><input type='checkbox' name='{$nombreDropdown}[]' value='" . $fila[$columnaId] . "'> " . $fila[$columnaNombre] . "</label>";
        }
    } else {
        echo "<span class='dropdown-item text-muted'>No hay opciones disponibles o hubo un error en la consulta</span>";
    }
}
?>
