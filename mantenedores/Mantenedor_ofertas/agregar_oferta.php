<?php
include '../conexion.php';
$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST["id_producto"];
    $porcentaje_descuento = $_POST["porcentaje_descuento"];

    $query = "INSERT INTO oferta (id_producto, porcentaje_descuento) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("id", $id_producto, $porcentaje_descuento);
    
    if ($stmt->execute()) {
        $mensaje = "Oferta agregada con éxito.";
    } else {
        $mensaje = "Error al agregar la oferta.";
    }
}

$query = "SELECT id_producto, nombre_producto FROM producto";
$result = $conn->query($query);
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

                <h1 class="text-center pb-4">Agregar Oferta</h1>

                <?php if ($mensaje != ''): ?>
                    <p class="text-center"><?php echo $mensaje; ?></p>
                <?php endif; ?>

                <form method="post" action="">
                    Selecciona el producto por ID: <input class="form-control" type="number" name="id_producto" required><br>

                    Porcentaje de descuento (0 a 1): <input class="form-control" type="number" step="0.01" min="0" max="1" name="porcentaje_descuento" required><br>

                    <button class="form-control btn btn-primary d-block" type="submit">Agregar Oferta</button>
                    <a href="mostrar_ofertas.php" class='btn btn-primary mt-3 d-block'>Volver</a>
                </form>
            </div>

            <div class="col-lg-6">
                <img src="../ikat.jpg" width="100%" alt="Imagen de Ikat">
            </div>
        </div>
    </div>
    
</body>
</html>
