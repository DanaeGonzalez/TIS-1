
<?php
    include '../conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenedor de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container border mt-5" style="font-family: 'Newsreader', serif;">
        <div class="row">
            <div class="col-lg-6 p-5">

                <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM producto WHERE id_producto = $id";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                    }
                ?>

                <h1 class="text-center pb-4">Editar Producto</h1>

                <form action="actualizar_producto.php" method="post">
                    <input type="hidden" name="id_producto" value="<?php echo $row['id_producto']; ?>">

                    Nombre del Producto: <input class="form-control" type="text" name="nombre_producto" value="<?php echo $row['nombre_producto']; ?>" required><br>

                    Precio Unitario: <input class="form-control" type="number" name="precio_unitario" value="<?php echo $row['precio_unitario']; ?>" required><br>

                    Descripción: <textarea class="form-control" name="descripcion_producto"><?php echo $row['descripcion_producto']; ?></textarea><br>

                    Características: <textarea class="form-control" name="caracteristicas_producto"><?php echo $row['caracteristicas_producto']; ?></textarea><br>

                    Foto del Producto (URL): <input class="form-control" type="text" name="foto_producto" value="<?php echo $row['foto_producto']; ?>"><br>

                    <input class="form-control btn btn-primary d-block" type="submit" value="Actualizar Producto">
                    <a href="mostrar_producto.php" class='btn btn-primary mt-3 d-block'>Volver</a>
                </form>
            </div>

            <div class="col-lg-6">
                <img src="../ikat.jpg" width="100%" alt="Imagen de Ikat">
            </div>
        </div>
    </div>
    
</body>
</html>
