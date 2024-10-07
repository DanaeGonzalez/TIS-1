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
                    if (isset($_GET['id_oferta'])) {
                        $id_oferta = $_GET['id_oferta'];
                        $query = "SELECT * FROM oferta WHERE id_oferta = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("i", $id_oferta);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $oferta = $result->fetch_assoc();
                    }
                ?>

                <h1 class="text-center pb-4">Editar Oferta</h1>

                <form action="actualizar_oferta.php" method="post">
                    <input type="hidden" name="id_oferta" value="<?php echo $oferta['id_oferta']; ?>">

                    ID Producto: <input class="form-control" type="text" name="id_producto" value="<?php echo $oferta['id_producto']; ?>" disabled><br>

                    Porcentaje de Descuento (0 a 1): <input class="form-control" type="number" step="0.01" min="0" max="1" name="porcentaje_descuento" value="<?php echo $oferta['porcentaje_descuento']; ?>" required><br>

                    <input class="form-control btn btn-primary d-block" type="submit" value="Actualizar Descuento">
                    <a href="mostrar_oferta.php" class='btn btn-primary mt-3 d-block'>Volver</a>
                </form>
            </div>

            <div class="col-lg-6">
                <img src="../ikat.jpg" width="100%" alt="Imagen de Ikat">
            </div>
        </div>
    </div>
    
</body>
</html>

