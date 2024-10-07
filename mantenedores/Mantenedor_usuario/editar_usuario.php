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
                        $sql = "SELECT * FROM usuario WHERE id_usuario = $id";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                    }
                ?>

                <h1 class="text-center pb-4">Editar Usuario</h1>

                <form action="actualizar_usuario.php" method="post">
                    <input type="hidden" name="id_usuario" value="<?php echo $row['id_usuario']; ?>">

                    Nombre: <input class="form-control" type="text" name="nombre_usuario" value="<?php echo $row['nombre_usuario']; ?>"><br>

                    Apellido: <input class="form-control" type="text" name="apellido_usuario" value="<?php echo $row['apellido_usuario']; ?>"><br>

                    RUN: <input class="form-control" type="text" name="run_usuario" value="<?php echo $row['run_usuario']; ?>"><br>

                    Correo: <input class="form-control" type="email" name="correo_usuario" value="<?php echo $row['correo_usuario']; ?>"><br>

                    Teléfono: <input class="form-control" type="text" name="numero_usuario" value="<?php echo $row['numero_usuario']; ?>"><br>

                    Dirección: <input class="form-control" type="text" name="direccion_usuario" value="<?php echo $row['direccion_usuario']; ?>"><br>

                    Tipo de Usuario:
                    <select name="tipo_usuario" class="form-control">
                        <option value="Administrador" <?php if ($row['tipo_usuario'] == 'Administrador') echo 'selected'; ?>>Administrador</option>
                        <option value="Registrado" <?php if ($row['tipo_usuario'] == 'Registrado') echo 'selected'; ?>>Registrado</option>
                    </select><br>

                    <input class="form-control btn btn-primary d-block" type="submit" value="Actualizar Usuario">
                    <a href="mostrar_usuario.php" class='btn btn-primary mt-3 d-block'>Volver</a>
                </form>
            </div>

            <div class="col-lg-6">
                <img src="../ikat.jpg" width="100%" alt="Imagen de Ikat">
            </div>
        </div>
    </div>
    
</body>
</html>
