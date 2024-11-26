<?php
    require '../../config/conexion.php';
    $contraseña = $_POST['new_pass'];   
    $id = $_POST['id'];   

    if (strlen($contraseña) >= 8 && strlen($contrasenia) <= 15 && !preg_match('/\s/', $contrasenia)) {
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
                <a href=localhost/TIS-1/IKAT/views/menu_registro/change_pass.php?id=$id class='btn btn-dark mt-3'>Volver a Intentar</a>
            </div>
        </div>";
    }
