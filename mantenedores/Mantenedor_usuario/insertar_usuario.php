

<?php
include '../conexion.php';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_usuario'];
    $apellido = $_POST['apellido_usuario'];
    $run = $_POST['run_usuario'];
    $correo = $_POST['correo_usuario'];
    $numero = $_POST['numero_usuario'];
    $contrasenia = password_hash($_POST['contrasenia_usuario'], PASSWORD_BCRYPT);
    $direccion = $_POST['direccion_usuario'];
    $tipo = $_POST['tipo_usuario'];
    $puntos_totales = 0;

    $sql = "INSERT INTO usuario (nombre_usuario, apellido_usuario, run_usuario, correo_usuario, numero_usuario, contrasenia_usuario, direccion_usuario, tipo_usuario, puntos_totales)
            VALUES ('$nombre', '$apellido', '$run', '$correo', '$numero', '$contrasenia', '$direccion', '$tipo', $puntos_totales)";

    if ($conn->query($sql) === TRUE) {
        $mensaje = "Nuevo usuario creado exitosamente";
    } else {
        $mensaje = "Error: " . $sql . "<br>" . $conn->error;
    }
}
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

                <h1 class="text-center pb-4">Agregar Usuario</h1>

                <?php if ($mensaje != ''): ?>
                    <p class="text-center"><?php echo $mensaje; ?></p>
                <?php endif; ?>


                <form action="insertar_usuario.php" method="post">
                    Nombre: <input class="form-control" type="text" name="nombre_usuario"><br>

                    Apellido: <input class="form-control" type="text" name="apellido_usuario"><br>

                    RUN: <input class="form-control" type="text" name="run_usuario"><br>

                    Correo: <input class="form-control" type="email" name="correo_usuario"><br>

                    Teléfono: <input class="form-control" type="text" name="numero_usuario"><br>

                    Contraseña: <input class="form-control" type="password" name="contrasenia_usuario"><br>

                    Dirección: <input class="form-control" type="text" name="direccion_usuario"><br>

                    Tipo de Usuario:
                    <select class="form-control" name="tipo_usuario">
                        <option value="Administrador">Administrador</option>
                        <option value="Registrado">Registrado</option>
                    </select><br>

                    <input class="form-control btn btn-primary d-block" type="submit" value="Crear Usuario">
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

