<?php
include '../conexion.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mantenedor de Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../menu/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&display=swap" rel="stylesheet">
</head>
<body>
        <div class="content-area flex-grow-1 p-5">
            <div class="row">
                <div class="col-12 p-4 d-flex flex-column justify-content-center align-items-center">

                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $id_categoria = $_POST['id_metodo'];
                        $nombre_categoria = $_POST['nombre_metodo'];

                        $sql = "UPDATE metodo_pago SET nombre_metodo='$nombre_categoria' WHERE id_metodo=$id_categoria";

                        if ($conn->query($sql) === TRUE) {
                            echo "Método de pago actualizado exitosamente <br>";
                            echo "<a href='mostrar_metodo_pago.php' class='btn btn-primary mt-3 d-block'>Volver</a>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>
</html>
