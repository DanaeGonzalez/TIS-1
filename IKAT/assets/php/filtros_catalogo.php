<?php
    include '../../config/conexion.php';
    // Obtener valores de los filtros de la URL (GET) o por otro método
    $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
    $color = isset($_GET['color']) ? $_GET['color'] : '';
    $material = isset($_GET['material']) ? $_GET['material'] : '';
    // Construir la consulta SQL con los filtros aplicados
    $sql = "SELECT * FROM producto WHERE activo = 1";
    // Aplicar filtros si están seleccionados
    if (!empty($categoria)) {
        $sql .= " AND id_subcategoria IN (SELECT id_subcategoria FROM subcategoria WHERE id_categoria = '$categoria')";
    }
    if (!empty($color)) {
        $sql .= " AND id_producto IN (SELECT id_producto FROM producto_color JOIN color USING (id_color) WHERE nombre_color = '$color')";
    }
    if (!empty($material)) {
        $sql .= " AND id_producto IN (SELECT id_producto FROM producto_material JOIN material USING (id material) WHERE nombre_material = '$material')";
    }
    // Ejecutar la consulta
    $result = $conn->query($sql);


?>