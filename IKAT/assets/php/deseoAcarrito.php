<?php
include '../../config/conexion.php';
include '../../views/menu_registro/auth.php';

if (isset($_POST['id_producto'])) {
    $id_usuario = $_SESSION['id_usuario']; // Obtener el id_usuario desde la sesión
    $id_producto = $_POST['id_producto'];

    // Obtener el id_carrito del usuario
    $consulta_carrito_usuario = $conn->prepare("SELECT id_carrito FROM usuario WHERE id_usuario = ?");
    $consulta_carrito_usuario->bind_param("i", $id_usuario);
    $consulta_carrito_usuario->execute();
    $resultado_carrito_usuario = $consulta_carrito_usuario->get_result();
    
    if ($resultado_carrito_usuario->num_rows > 0) {
        $fila_carrito = $resultado_carrito_usuario->fetch_assoc();
        $id_carrito = $fila_carrito['id_carrito']; // Obtener el id_carrito asociado al usuario

        // Obtener la lista de deseos del usuario
        $consulta_lista = $conn->prepare("SELECT id_lista_deseos FROM lista_de_deseos WHERE id_usuario = ?");
        $consulta_lista->bind_param("i", $id_usuario);
        $consulta_lista->execute();
        $resultado_lista = $consulta_lista->get_result();
        $fila_lista = $resultado_lista->fetch_assoc();
        $id_lista_deseos = $fila_lista['id_lista_deseos'];

        // Eliminar el producto de la lista de deseos
        $eliminar_producto_lista = $conn->prepare("DELETE FROM lista_deseos_producto WHERE id_lista_deseos = ? AND id_producto = ?");
        $eliminar_producto_lista->bind_param("ii", $id_lista_deseos, $id_producto);
        $eliminar_producto_lista->execute();

        // Verificar si el producto ya está en el carrito
        $consulta_carrito_producto = $conn->prepare("SELECT id_carrito FROM carrito_producto WHERE id_carrito = ? AND id_producto = ?");
        $consulta_carrito_producto->bind_param("ii", $id_carrito, $id_producto);
        $consulta_carrito_producto->execute();
        $resultado_carrito_producto = $consulta_carrito_producto->get_result();

        if ($resultado_carrito_producto->num_rows > 0) {
            // Si el producto ya está en el carrito, solo incrementamos la cantidad
            $actualizar_carrito = $conn->prepare("UPDATE carrito_producto SET cantidad_producto = cantidad_producto + 1 WHERE id_carrito = ? AND id_producto = ?");
            $actualizar_carrito->bind_param("ii", $id_carrito, $id_producto);
            $actualizar_carrito->execute();
        } else {
            // Si el producto no está en el carrito, lo agregamos con cantidad 1
            $agregar_carrito = $conn->prepare("INSERT INTO carrito_producto (id_carrito, id_producto, cantidad_producto) VALUES (?, ?, 1)");
            $agregar_carrito->bind_param("ii", $id_carrito, $id_producto);
            $agregar_carrito->execute();
        }

        // Redirigir al usuario de nuevo a la página de la lista de deseos
        header("Location: ../../views/deseados.php");
        exit();
    } else {
        // Manejar el caso si no se encuentra el id_carrito para el usuario
        echo "No se encontró el carrito para este usuario.";
    }
}
?>
