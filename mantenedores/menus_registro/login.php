<?php
    include '../conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
        require('conexion.php');
        session_start();
        if (isset($_POST['identificador']) OR isset($_POST['run'])) {
            $identificador = stripslashes($_REQUEST['identificador']);
            $identificador = mysqli_real_escape_string($conn,$identificador);
            
            $contrasenia = stripslashes($_REQUEST['contrasenia']);
            $contrasenia = mysqli_real_escape_string($conn,$contrasenia);

            if (filter_var($identificador, FILTER_VALIDATE_EMAIL)) {
                $query = "SELECT * FROM usuario WHERE correo_usuario = ? AND contrasenia_usuario='".md5($contrasenia)."'";
            } else {
                $query = "SELECT * FROM usuario WHERE run_usuario = ? AND contrasenia_usuario='".md5($contrasenia)."'";
            }

            // $query = "SELECT * FROM usuario WHERE correo_usuario='$identificador' OR run_usuario='$run' AND contrasenia_usuario='".md5($contrasenia)."'";
            $result = mysqli_query($conn, $query) or die(mysql_error());

            $rows = mysqli_num_rows($result);
            if ($rows==1) {
                $_SESSION['identificador'] = $identificador;
                header("Location: confirm.php");
            }else {
                echo "<div class='form'><h3> Usuario/Contraseña incorrecto</h3><br> Haz click aquí para <a href='login.php'>Iniciar sesión</a>.</div>";    
            }
        }else {
            ?>
            <div class="form">
                <h1>Inicia Sesión</h1>
                <form name="login" action="" method="post"> 
                    <input type="text" name="identificador" placeholder="micorreo@gmail.com" required/>
                    <input type="password" name="contrasenia" placeholder="Contraseña" required/>
                    <input type="submit" name="submit" value="Entrar"/>
                </form>                 
                <p>No estás registrado aún? <a href="registro.php"> Registrate aquí</a></p>
            </div><?php
        }
    ?>
</body>
</html>