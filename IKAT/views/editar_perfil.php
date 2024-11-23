<?php

require("../config/conexion.php");
$nombre_r = $_POST["nombre_e"];
$apellido_r = $_POST["apellido_e"];
$numero_r = $_POST["numero_e"];
$direccion_r = $_POST["direccion_e"];
$id_r=$_POST["id_e"];

$consulta = "UPDATE usuario 
SET nombre_usuario = '$nombre_r', apellido_usuario = '$apellido_r', numero_usuario = '$numero_r', direccion_usuario = '$direccion_r' 
WHERE id_usuario = '$id_r';";
$resultado = mysqli_query($conn,$consulta);
header("Location: perfil.php");
?>