<?php
    require '../../config/conexion.php';
    $contraseña = $_POST['new_pass'];   
    $id = $_POST['id'];   

    $query = "UPDATE usuario SET contrasenia_usuario = '$contraseña' WHERE id_usuario = '$id'";
    $result = mysqli_query($conn,$query);

    header("Location: ../../views/menu_registro/login.php?msg=success_pass");
    exit();