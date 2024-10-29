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
        require('../conexion.php');
        session_start();
        if (isset($_POST['identificador'])) {
            $identificador = stripslashes($_REQUEST['identificador']);
            $identificador = mysqli_real_escape_string($conn, $identificador);
            
            $contrasenia = stripslashes($_REQUEST['contrasenia']);
            $contrasenia = mysqli_real_escape_string($conn, $contrasenia);

            $query = "SELECT * FROM usuario WHERE correo_usuario='$identificador' OR run_usuario='$identificador'";
            $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
            
            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                if (password_verify($contrasenia, $user['contrasenia_usuario'])) {
                    $_SESSION['identificador'] = $identificador;
                    $_SESSION['tipo_usuario'] = $user['tipo_usuario'];
                    
                    if ($_SESSION['tipo_usuario'] == 'Registrado') {
                        header("Location: ../menu/menu_reg.php");
                    } else if ($_SESSION['tipo_usuario'] == 'Administrador') {
                        header("Location: ../menu/menu_adm.php");
                    }
                } else {
                    echo "<div class='form'><h3> Usuario/Contraseña incorrectos</h3><br> Haz click aquí para <a href='login.php'>Iniciar sesión</a>.</div>";
                }
            } else {
                echo "<div class='form'><h3> Usuario/Contraseña incorrectos</h3><br> Haz click aquí para <a href='login.php'>Iniciar sesión</a>.</div>";
            }
            
        } else {
            ?>
            <div class="form">
                <h1>Iniciar Sesión</h1>
                <form name="login" action="" method="post"> 
                    <input type="text" name="identificador" placeholder="Correo o RUN" required/>
                    <input type="password" name="contrasenia" placeholder="Contraseña" required/>
                    <input type="submit" name="submit" value="Entrar"/>
                </form>                 
                <p>No estás registrado aún? <a href="registro.php"> Registrate aquí</a></p>
            </div><?php
        }
    ?>
</body>
</html>
