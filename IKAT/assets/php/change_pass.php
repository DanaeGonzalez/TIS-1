<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ikat - Error en Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="..\..\assets\css\styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

<?php
    require '../../config/conexion.php';
    $contraseña = $_POST['new_pass'];   
    $id = $_POST['id'];   

    if (strlen($contraseña) >= 8 && strlen($contraseña) <= 15 && !preg_match('/\s/', $contraseña)) {
        $contraseña = password_hash($contraseña, PASSWORD_BCRYPT);
        $query = "UPDATE usuario SET contrasenia_usuario = '$contraseña' WHERE id_usuario = '$id'";
        $result = mysqli_query($conn,$query);
    
        header("Location: ../../views/menu_registro/login.php?msg=success_pass");
        exit();
    }else {
        echo "
        <div class='container-fluid d-flex justify-content-center align-items-center bg-light' style='height: 100vh;'>
            <div class='alert alert-danger text-center shadow-lg p-5 rounded-3' role='alert' style='max-width: 500px;'>
                <h3>Error en la contraseña</h3>
                <p>La nueva contraseña debe tener entre 8 y 15 caracteres y no contener espacios.</p>
                <a href=http://localhost/xampp/TIS-1/IKAT/views/menu_registro/change_pass.php?id='$id' class='btn btn-dark mt-3'>Volver a Intentar</a>
            </div>
        </div>";
    }
    ?>

</body>
</html>