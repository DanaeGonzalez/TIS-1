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
                <h1 class="text-center p-4">Mantenedor de Categorías</h1>

                <div class="table-responsive">
                    <?php
                        $sql = "SELECT * FROM categoria";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo "<table class='table table-bordered table-striped'>
                                    <thead class='thead-dark'>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row["id_categoria"] . "</td>
                                        <td>" . $row["nombre_categoria"] . "</td>
                                        <td>
                                            <a href='editar_categoria.php?id=" . $row["id_categoria"] . "' class='btn btn-warning btn-sm'>Editar</a> |
                                            <a href='borrar_categoria.php?id=" . $row["id_categoria"] . "' class='btn btn-danger btn-sm'>Borrar</a>
                                        </td>
                                      </tr>";
                            }
                            echo "</tbody></table>";
                            echo "<a href='insert_categoria.php' class='btn btn-primary mt-3 d-block'>Agregar categoría</a>";
                            echo "<a href='../menu/menu.html' class='btn btn-primary mt-3 d-block'>Volver al menu</a>";
                        } else {
                            echo "<p class='text-center'>No hay categorías registradas.</p>";
                            echo "<a href='insert_categoria.php' class='btn btn-primary mt-3 d-block'>Agregar categoría</a>";
                            echo "<a href='../menu/menu.html' class='btn btn-primary mt-3 d-block'>Volver al menu</a>";
                        }
                    ?>
                </div>
            </div>

            <div class="col-lg-6">
                <img src="../ikat.jpg" width="100%" alt="Imagen de Ikat">
            </div>
        </div>
    </div>
    
</body>
</html>
