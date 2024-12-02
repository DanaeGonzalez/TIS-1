<?php
    include '../../config/conexion.php';
    session_start();

    $mensaje = '';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_usuario = $_POST['id_usuario'];
        $cantidad_modificar = $_POST['cantidad_modificar'];
        $sql = "SELECT puntos_totales FROM usuario WHERE id_usuario = $id_usuario";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $puntos_actual = $row['puntos_totales'];
            $nueva_cantidad = $puntos_actual + $cantidad_modificar;
            if ($nueva_cantidad < 0) {
                $mensaje = "Error: No se puede tener puntos negativos.";
            } else {
                $sql_update = "UPDATE usuario SET puntos_totales = $nueva_cantidad WHERE id_usuario = $id_usuario";
                if ($conn->query($sql_update) === TRUE) {
                    $mensaje = "Puntos actualizados exitosamente.";
                } else {
                    $mensaje = "Error al actualizar los puntos: " . $conn->error;
                }
            }
        } else {
            $mensaje = "Error: Usuario no encontrado.";
        }
        header('Location: mostrar_usuario.php');
        exit();
    }
?>
