<?php

require("../config/conexion.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_r = $_POST["nombre_e"];
    $apellido_r = $_POST["apellido_e"];
    $numero_r = $_POST["numero_e"];
    $direccion_r = $_POST["direccion_e"];
    $id_r=$_POST["id_e"];

    $consulta = "UPDATE usuario 
    SET nombre_usuario = '$nombre_r', apellido_usuario = '$apellido_r', numero_usuario = '$numero_r', direccion_usuario = '$direccion_r' 
    WHERE id_usuario = '$id_r';";
    $resultado = mysqli_query($conn,$consulta);

    if ($conn->query($consulta)===TRUE) {
        $_SESSION['nombre_usuario'] = $nombre_r;
        $_SESSION['apellido_usuario'] = $apellido_r;
        $_SESSION['numero_usuario'] = $numero_r;
        $_SESSION['direccion_usuario'] = $direccion_r;
    
    ?>
        <div class="alert alert-success text-center alert-dismissible fade show" role="alert">
            Datos actualizados correctamente
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }else { ?>
        <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
            Error al actualizar los datos
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php }

    header("Location: perfil.php");
    exit();
}
?>