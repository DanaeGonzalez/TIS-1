<?php
    header('Content-Type: application/json');
    include '../../config/conexion.php';
    // Obtener valores de los filtros de la URL (GET) o por otro método
    $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
    $color = isset($_GET['color']) ? $_GET['color'] : '';
    $material = isset($_GET['material']) ? $_GET['material'] : '';
    $ambiente = isset($_GET['ambiente']) ? $_GET['ambiente'] : '';
    $forma = isset($_GET['forma']) ? $_GET['forma'] : '';
    $firmeza = isset($_GET['firmeza']) ? $_GET['firmeza'] : '';
    $n_asientos = isset($_GET['n_asientos']) ? $_GET['n_asientos'] : '';
    $n_cajones = isset($_GET['n_cajones']) ? $_GET['n_cajones'] : '';
    $n_plazas = isset($_GET['n_plazas']) ? $_GET['n_plazas'] : '';
    $subcategoria = isset($_GET['subcategoria']) ? $_GET['subcategoria'] : '';
    // Construir la consulta SQL con los filtros aplicados
    $sql = "SELECT * FROM producto WHERE activo = 1";
    // Aplicar filtros si están seleccionados
    if (!empty($categoria)) {
        $sql .= " AND id_subcategoria IN (SELECT id_subcategoria FROM subcategoria JOIN categoria USING (id_categoria) WHERE nombre_categoria = '$categoria')";
    }
    if (!empty($color)) {
        $sql .= " AND id_producto IN (SELECT id_producto FROM producto_color JOIN color USING (id_color) WHERE nombre_color = '$color')";
    }
    if (!empty($material)) {
        $sql .= " AND id_producto IN (SELECT id_producto FROM producto_material JOIN material USING (id_material) WHERE nombre_material = '$material')";
    }
    if (!empty($ambiente)) {
        $sql .= " AND id_producto IN (SELECT id_producto FROM producto_ambiente JOIN ambiente USING (id_ambiente) WHERE nombre_ambiente = '$ambiente')";
    }
    if (!empty($forma)) {
        $sql .= " AND id_producto IN (SELECT id_producto FROM producto_forma JOIN forma USING (id_forma) WHERE nombre_forma = '$forma')";
    }
    if (!empty($firmeza)) {
        $sql .= " AND id_producto IN (SELECT id_producto FROM producto_firmeza JOIN firmeza USING (id_firmeza) WHERE nombre_firmeza = '$firmeza')";
    }
    if (!empty($n_asientos)) {
        $sql .= " AND id_producto IN (SELECT id_producto FROM producto_n_asientos JOIN n_asientos USING (id_n_asientos) WHERE nombre_n_asientos = '$n_asientos')";
    }
    if (!empty($n_cajones)) {
        $sql .= " AND id_producto IN (SELECT id_producto FROM producto_n_cajones JOIN n_cajones USING (id_n_cajones) WHERE nombre_n_cajones = '$n_cajones')";
    }
    if (!empty($n_plazas)) {
        $sql .= " AND id_producto IN (SELECT id_producto FROM producto_n_plazas JOIN n_plazas USING (id_n_plazas) WHERE nombre_n_plazas = '$n_plazas')";
    }
    if (!empty($subcategoria)) {
        $sql .= " AND id_subcategoria IN (SELECT id_subcategoria FROM subcategoria WHERE nombre_subcategoria = '$subcategoria')";
    }
    // Ejecutar la consulta
    $result = $conn->query($sql);

    $productos = [];
    if ($result->num_rows > 0) {
        while ($producto = $result->fetch_assoc()) {
            $productos[] = $producto;
        }
    }
    echo json_encode($productos);

?>