<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar - Usuario</title>
</head>
<body>
    <form action="insertar_usuario.php" method="post">
        Nombre: <input type="text" name="nombre_usuario"><br>
        Apellido: <input type="text" name="apellido_usuario"><br>
        RUN: <input type="text" name="run_usuario"><br>
        Correo: <input type="email" name="correo_usuario"><br>
        Teléfono: <input type="text" name="numero_usuario"><br>
        Contraseña: <input type="password" name="contrasenia_usuario"><br>
        Dirección: <input type="text" name="direccion_usuario"><br>
        Tipo de Usuario:
        <select name="tipo_usuario">
            <option value="Administrador">Administrador</option>
            <option value="Registrado">Registrado</option>
        </select><br>
        <input type="submit" value="Crear Usuario">
        <a href="mostrar_usuario.php">Volver</a>
    </form>

</body>
</html>


<?php
include 'conexion.php'; // Archivo que contiene la conexión a la base de datos.

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
        echo "Nuevo usuario creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
