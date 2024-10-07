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
            <div class="col-lg-6 p-5 d-flex flex-column justify-content-center align-items-center">

                <?php

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $id_oferta = $_POST['id_oferta'];
                        $porcentaje_descuento = $_POST['porcentaje_descuento'];
                    
                        $query = "UPDATE oferta SET porcentaje_descuento = ? WHERE id_oferta = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("di", $porcentaje_descuento, $id_oferta);
                    
                        if ($stmt->execute()) {
                            echo "Oferta actualizada con éxito.";
                            echo "<a href='mostrar_ofertas.php' class='btn btn-primary mt-3 d-block'>Volver</a>";
                        } else {
                            echo "Error al actualizar la oferta.";
                            echo "<a href='mostrar_ofertas.php' class='btn btn-primary mt-3 d-block'>Volver</a>";
                        }
                    }
                ?>
            </div>

            <div class="col-lg-6">
                <img src="../ikat.jpg" width="100%" alt="Imagen de Ikat">
            </div>
        </div>
    </div>
    
</body>
</html>

