<?php
// Función para generar la carta de producto
function generarCartaProducto($id_producto, $producto, $esTopVenta = false, $tieneOferta = false, $precioOriginal = 0, $precioConDescuento = 0) {
    // Verificar que $producto sea un array válido
    if (!is_array($producto)) {
        return '<p>Error: Datos del producto inválidos.</p>';
    }

    // Ajustar la ruta de la imagen
    $ruta_original = $producto['foto_producto'] ?? '';
    $ruta_ajustada = str_replace("../../", "../", $ruta_original);

    // Generar HTML de la carta
    ob_start(); // Iniciar el buffer de salida
    ?>
    <div class="col-6 col-md-4 mb-4">
        <div class="card d-flex flex-column h-100">
            <a href="producto.php?id=<?= $id_producto ?>" class="text-decoration-none">
                <div class="card-img-container position-relative d-flex justify-content-center align-items-center">
                    <img src="<?= $ruta_ajustada ?>" class="card-img-top img-fluid h-100" alt="Imagen del producto" style="object-fit: cover; width: 100%; height: auto;" id="product-image-<?= $id_producto ?>">
                    
                    <?php if ($esTopVenta): ?>
                        <!-- Indicador de Top Ventas -->
                        <span class="badge bg-danger position-absolute top-0 start-0 m-2">Top Ventas</span>
                    <?php endif; ?>
                </div>
            </a>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title text-truncate"><?= htmlspecialchars($producto['nombre_producto'] ?? 'Producto sin nombre') ?></h5>
                <div class="mb-3">
                    <?php if ($tieneOferta): ?>
                        <span class="text-muted text-decoration-line-through" style="font-size: 0.9rem;">
                            $<?= number_format($precioOriginal, 0, ',', '.') ?>
                        </span>
                        <span class="text-danger fw-bold" style="font-size: 1.2rem;">
                            $<?= number_format($precioConDescuento, 0, ',', '.') ?>
                        </span>
                    <?php else: ?>
                        <h6 class="card-text mb-3">$<?= number_format($precioOriginal, 0, ',', '.') ?></h6>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-between align-items-center pe-3">
                    <div class="mt-auto d-flex align-items-center">
                        <button type="button" class="btn btn-secondary me-2 carrito-btn" onclick="agregarAlCarrito(<?= $id_producto ?>)">
                            <i class="bi bi-cart-plus"></i>
                        </button>
                        <button type="button" class="btn btn-secondary lista-deseos-btn" onclick="agregarAListaDeDeseos(<?= $id_producto ?>)">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>
                    <!-- Estrellitas dinámicas -->
                    <div id="stars-container-<?= $id_producto ?>" class="d-flex align-items-center gap-1">
                        <span>Cargando estrellas...</span> <!-- Placeholder mientras se carga con AJAX -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean(); // Obtener y limpiar el buffer de salida
}
?>
