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
                        $sql = "SELECT * FROM divisa WHERE id_divisa = $id";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                    }
                ?>

                <h1 class="text-center pb-4">Editar Divisa</h1>

                <form action="actualizar_divisa.php" method="post">
                    <input type="hidden" name="id_divisa" value="<?php echo $row['id_divisa']; ?>">

                    Código de la Divisa: <input class="form-control" type="text" name="codigo_divisa" value="<?php echo $row['codigo_divisa']; ?>" required><br>

                    Nombre de la Divisa: <input class="form-control" type="text" name="nombre_divisa" value="<?php echo $row['nombre_divisa']; ?>" required><br>

                    <input class="form-control btn btn-primary d-block" type="submit" value="Actualizar Divisa">
                    <a href="mostrar_divisa.php" class='btn btn-primary mt-3 d-block'>Volver</a>
                </form>
            </div>

            <div class="col-lg-6">
                <img src="../ikat.jpg" width="100%" alt="Imagen de Ikat">
            </div>
        </div>
    </div>
    
</body>
</html>
