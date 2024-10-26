<?php
    include '../conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <?php
        require('conexion.php');

        if (isset($_REQUEST['correo'])){
            $nombre = stripslashes($_REQUEST['nombre']);
            $nombre = mysqli_real_escape_string($conn,$nombre);

            $apellido = stripslashes($_REQUEST['apellido']);
            $apellido = mysqli_real_escape_string($conn,$apellido);

            $run = stripslashes($_REQUEST['run']);
            $run = mysqli_real_escape_string($conn,$run);

            $numero = stripslashes($_REQUEST['numero']);
            $numero = mysqli_real_escape_string($conn,$numero);
            
            $correo = stripslashes($_REQUEST['correo']);
            $correo = mysqli_real_escape_string($conn,$correo);
            
            $contrasenia = stripslashes($_REQUEST['contrasenia']);
            $contrasenia = mysqli_real_escape_string($conn,$contrasenia);

            $query = "INSERT INTO usuario (nombre_usuario, apellido_usuario, run_usuario, correo_usuario, numero_usuario, contrasenia_usuario, direccion_usuario, tipo_usuario, puntos_totales, id_divisa)
            VALUES ('$nombre', '$apellido', '$run', '$correo', '$numero', '".md5("$contrasenia")."', 'AQUÍ VA DIRECCIÓN', 'Registrado', '0', '1')";
            
            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "<div class='form'><h3>Te has registrado correctamente!</h3><br/>Haz click aquí para <a href='login.php'>Iniciar sesión</a></div>";
            }
        }
            else {
                ?>
                <div class="form">
                    <h1>Registrate aquí</h1>
                    <form name="registro" action="" method="post"> 
                        <input type="text" name="nombre" placeholder="Nombre" required/>
                        <input type="text" name="apellido" placeholder="Apellido" required/>
                        <input type="text" name="run" placeholder="12.345.678-9" required/>
                        <input type="text" name="numero" placeholder="+569" required/>
                        <input type="correo" name="correo" placeholder="micorreo@gmail.com" required/>
                        <input type="password" name="contrasenia" placeholder="Contraseña" required/>
                        <input type="submit" name="submit" value="Registrarse"/>
                    </form>                 
                </div><?php
            }
    ?>
</body>
</html>
