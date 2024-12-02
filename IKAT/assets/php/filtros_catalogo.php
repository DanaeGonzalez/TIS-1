<?php
session_start();
include 'generar_carta_producto.php';
include '../../config/conexion.php';
include 'calcular_top_ventas.php'; 

// Obtener el top de ventas
$topVentas = obtenerTopVentas($conn);

// Verificar si hay una categoría seleccionada en la sesión
$id_categoria = $_SESSION['id_categoria'] ?? null;

$filtros = $_POST;
$criterios = [];

// Aplicar filtro de categoría si existe
if ($id_categoria) {
    $criterios[] = "subcategoria.id_categoria = $id_categoria";
}

// Filtrar por subcategoría
if (!empty($filtros['subcategoria'])) {
    $subcategorias = implode(",", array_map('intval', (array) $filtros['subcategoria']));
    $criterios[] = "producto.id_subcategoria IN ($subcategorias)";
}

// Filtrar por color
if (!empty($filtros['color'])) {
    $colores = implode(",", array_map('intval', (array) $filtros['color']));
    $criterios[] = "producto_color.id_color IN ($colores)";
}

// Filtrar por material
if (!empty($filtros['material'])) {
    $materiales = implode(",", array_map('intval', (array) $filtros['material']));
    $criterios[] = "producto_material.id_material IN ($materiales)";
}

// Filtrar por número de asientos (aplica a mesa, sillón)
if (!empty($filtros['n_asientos'])) {
    $asientos = implode(",", array_map('intval', (array) $filtros['n_asientos']));
    $criterios[] = "producto_n_asientos.id_n_asientos IN ($asientos)";
}

// Filtrar por número de plazas (aplica a cama)
if (!empty($filtros['n_plazas'])) {
    $plazas = implode(",", array_map('intval', (array) $filtros['n_plazas']));
    $criterios[] = "producto_n_plazas.id_n_plazas IN ($plazas)";
}

// Filtrar por forma (aplica a mesa, sillón)
if (!empty($filtros['forma'])) {
    $formas = implode(",", array_map('intval', (array) $filtros['forma']));
    $criterios[] = "producto_forma.id_forma IN ($formas)";
}

// Filtrar por ambiente (aplica a mesa, silla, sillón, almacenamiento/organización)
if (!empty($filtros['ambiente'])) {
    $ambientes = implode(",", array_map('intval', (array) $filtros['ambiente']));
    $criterios[] = "producto_ambiente.id_ambiente IN ($ambientes)";
}

// Filtrar por firmeza (aplica a sillón)
if (!empty($filtros['firmeza'])) {
    $firmezas = implode(",", array_map('intval', (array) $filtros['firmeza']));
    $criterios[] = "producto_firmeza.id_firmeza IN ($firmezas)";
}

// Filtrar por número de cajones (aplica a almacenamiento/organización)
if (!empty($filtros['n_cajones'])) {
    $cajones = implode(",", array_map('intval', (array) $filtros['n_cajones']));
    $criterios[] = "producto_n_cajones.id_n_cajones IN ($cajones)";
}

// Construir la consulta
$query = "
    SELECT producto.*, subcategoria.id_categoria 
    FROM producto
    INNER JOIN subcategoria ON producto.id_subcategoria = subcategoria.id_subcategoria
    LEFT JOIN producto_color ON producto.id_producto = producto_color.id_producto
    LEFT JOIN producto_material ON producto.id_producto = producto_material.id_producto
    LEFT JOIN producto_n_asientos ON producto.id_producto = producto_n_asientos.id_producto
    LEFT JOIN producto_n_plazas ON producto.id_producto = producto_n_plazas.id_producto
    LEFT JOIN producto_forma ON producto.id_producto = producto_forma.id_producto
    LEFT JOIN producto_ambiente ON producto.id_producto = producto_ambiente.id_producto
    LEFT JOIN producto_firmeza ON producto.id_producto = producto_firmeza.id_producto
    LEFT JOIN producto_n_cajones ON producto.id_producto = producto_n_cajones.id_producto
    WHERE producto.activo = 1
";

if (!empty($criterios)) {
    $query .= " AND " . implode(" AND ", $criterios);
}

//echo "<pre>Consulta generada: $query</pre>";

// Ejecutar la consulta y generar las cartas
$result = $conn->query($query);
if ($result && $result->num_rows > 0) {
    while ($producto = $result->fetch_assoc()) {
        $id_producto = $producto['id_producto'];
        $esTopVenta = in_array($id_producto, $topVentas);

        echo generarCartaProducto($id_producto, $producto, $esTopVenta);
    }
} else {
    echo '<p>No se encontraron productos.</p>';
}
?>
