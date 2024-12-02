<?php
include 'generar_carta_producto.php';
include '../../config/conexion.php';
include 'calcular_top_ventas.php'; 

// Obtener el top de ventas
$topVentas = obtenerTopVentas($conn);

$filtros = $_GET;

if (!empty($filtros)) {
    $queryParts = [];
    foreach ($filtros as $key => $value) {
        $queryParts[] = "$key = '$value'";
    }
    $query = implode(' AND ', $queryParts);

    $sql = "SELECT * FROM producto WHERE $query AND activo = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($producto = $result->fetch_assoc()) {
            $id_producto = $producto['id_producto'];
            $esTopVenta = in_array($id_producto, $topVentas);

            $sqlOferta = "SELECT porcentaje_descuento FROM oferta WHERE id_producto = $id_producto";
            $resultadoOferta = $conn->query($sqlOferta);
            $tieneOferta = $resultadoOferta->num_rows > 0;
            $precioOriginal = $producto['precio_unitario'];
            $precioConDescuento = $precioOriginal;

            if ($tieneOferta) {
                $oferta = $resultadoOferta->fetch_assoc();
                $porcentajeDescuento = $oferta['porcentaje_descuento'];
                $precioConDescuento = $precioOriginal - ($precioOriginal * $porcentajeDescuento / 100);
            }

            echo generarCartaProducto($producto, $esTopVenta, $tieneOferta, $precioOriginal, $precioConDescuento, $id_producto);
        }
    } else {
        echo '<p>No se encontraron productos.</p>';
    }
}
?>
