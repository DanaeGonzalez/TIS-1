<?php
include_once '../config/conexion.php';

if (!isset($_GET['productos'])) {
    echo "No hay productos para comparar.";
    exit;
}

$ids = explode(',', $_GET['productos']);
$ids = array_map('intval', $ids); // Convertir a enteros para evitar inyección SQL

// Consulta para obtener los datos de los productos
$sql = "SELECT * FROM producto WHERE id_producto IN (" . implode(',', $ids) . ")";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0):
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparar Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Comparación de productos</h1>
        <div class="table-responsive mt-4">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Categoría</th>
                        <th>Material</th>
                        <th>Color</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($producto = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <img src="<?= str_replace('../../', '../', $producto['foto_producto']) ?>" alt="Imagen del producto" style="width: 100px; height: auto;">
                            <p><?= htmlspecialchars($producto['nombre_producto']) ?></p>
                        </td>
                        <td>$<?= number_format($producto['precio_unitario'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($producto['categoria']) ?></td>
                        <td><?= htmlspecialchars($producto['material']) ?></td>
                        <td><?= htmlspecialchars($producto['color']) ?></td>
                        <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <a href="catalogo.php" class="btn btn-secondary mt-3">Volver al catálogo</a>
        </div>
    </div>
</body>
</html>
<?php
else:
    echo "No se encontraron productos.";
endif;
$conn->close();
?>
