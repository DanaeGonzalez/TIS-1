    
<?php
    include '../../config/conexion.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenedor de Stock</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..\..\assets\css\styles.css">

</head>
<body>
        <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/xampp/TIS-1/IKAT/templates/header.php';?>

    <div class="d-flex">
        <!-- Sidebar -->
        <?php include '../sidebar-mantenedores.php';?>
        
        <div class="content-area flex-grow-1 p-5">
        <h1 class="text-center p-4">Modificar Stock de un Producto</h1>
        <div class="row">
            <div class="col-12">

                <?php
                    $mensaje = '';
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $id_producto = $_POST['id_producto'];
                        $cantidad_modificar = $_POST['cantidad_modificar'];
                    
                        $sql = "SELECT stock_producto FROM producto WHERE id_producto = $id_producto";
                        $result = $conn->query($sql);
                    
                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $stock_actual = $row['stock_producto'];
                    
                            $nuevo_stock = $stock_actual + $cantidad_modificar;
                    
                            if ($nuevo_stock < 0) {
                                $mensaje = "Error: No se puede tener stock negativo.";
                            } else {
                                
                                $sql_update = "UPDATE producto SET stock_producto = $nuevo_stock WHERE id_producto = $id_producto";
                    
                                if ($conn->query($sql_update) === TRUE) {
                                    $mensaje = "Stock actualizado exitosamente.";
                                } else {
                                    $mensaje = "Error al actualizar el stock: " . $conn->error;
                                }
                            }
                        } else {
                            $mensaje = "Error: Producto no encontrado.";
                        }
                    }
                ?>

                <?php if ($mensaje != ''): ?>
                    <p class="text-center"><?php echo $mensaje; ?></p>
                <?php endif; ?>


                <form action="modificar_stock_producto.php" method="post">

                    <label for="id_producto" class="form-label">Selecciona el producto</label>
                    <select class="form-select" name="id_producto" required>
                        <option value="" disabled selected>Selecciona un producto</option>
                        <?php
                            $sqlProducto = "SELECT id_producto, nombre_producto FROM producto";
                            $resultProducto = $conn->query($sqlProducto);
                            while($producto = $resultProducto->fetch_assoc()) {
                                echo "<option value='" . $producto['id_producto'] . "'>" . $producto['nombre_producto'] . "</option>";
                            }
                        ?>
                    </select>

                    <label for="stock" class="form-label mt-3">Cantidad a modificar (Negativo para descontar):</label>
                    <input class="form-control" type="number" name="cantidad_modificar" required><br><br>

                    <input class="form-control btn btn-primary d-block" type="submit" value="Modificar Stock">
                    <a href="../Mantenedor_producto/mostrar_producto.php" class='btn btn-primary mt-3 d-block'>Volver</a>
                </form>

            </div>
        </div>
    </div>
    
</body>
</html>
