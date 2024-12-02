<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'generar_carta_producto.php';
include '../../config/conexion.php';
include 'calcular_top_ventas.php';

// Obtener el término de búsqueda
$buscar = $_GET['buscar'] ?? '';
$topVentas = obtenerTopVentas($conn);

if (!empty($buscar)) {
    // Ajustar los criterios para que sean seguros
    $buscarTermino = '%' . str_replace(' ', '%', $buscar) . '%';
    $stmt = $conn->prepare("SELECT * FROM producto WHERE nombre_producto LIKE ? AND activo = 1");
    $stmt->bind_param("s", $buscarTermino);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($producto = $result->fetch_assoc()) {
            $id_producto = $producto['id_producto'];
            $esTopVenta = in_array($id_producto, $topVentas);

            $sqlOferta = "SELECT porcentaje_descuento FROM oferta WHERE id_producto = $id_producto";
            $resultadoOferta = $conn->query($sqlOferta);
            $tieneOferta = $resultadoOferta && $resultadoOferta->num_rows > 0;
            $precioOriginal = $producto['precio_unitario'];
            $precioConDescuento = $precioOriginal;

            if ($tieneOferta) {
                $oferta = $resultadoOferta->fetch_assoc();
                $porcentajeDescuento = $oferta['porcentaje_descuento'];
                $precioConDescuento = $precioOriginal - ($precioOriginal * $porcentajeDescuento / 100);
            }

            echo generarCartaProducto($id_producto, $producto, $esTopVenta, $tieneOferta, $precioOriginal, $precioConDescuento);
        }
    } else {
        echo '<p>No se encontraron productos.</p>';
    }
} else {
    echo '<p>No se ingresó un término de búsqueda.</p>';
}
?>
