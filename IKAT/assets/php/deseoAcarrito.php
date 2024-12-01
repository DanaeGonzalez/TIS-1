<?php
include '../../config/conexion.php';
include '../../views/menu_registro/auth.php';

if (isset($_POST['productos']) && is_array($_POST['productos'])) {
    $id_usuario = $_SESSION['id_usuario']; // Obtener el id_usuario desde la sesión
    $productos = $_POST['productos']; // Array de productos enviados desde el formulario

    // Obtener la lista de deseos del usuario
    $consulta_lista = $conn->prepare("SELECT id_lista_deseos FROM lista_de_deseos WHERE id_usuario = ?");
    $consulta_lista->bind_param("i", $id_usuario);
    $consulta_lista->execute();
    $resultado_lista = $consulta_lista->get_result();
    $fila_lista = $resultado_lista->fetch_assoc();
    $id_lista_deseos = $fila_lista['id_lista_deseos'];

    foreach ($productos as $id_producto) {
        // Eliminar el producto de la lista de deseos
        $eliminar_producto_lista = $conn->prepare("DELETE FROM lista_deseos_producto WHERE id_lista_deseos = ? AND id_producto = ?");
        $eliminar_producto_lista->bind_param("ii", $id_lista_deseos, $id_producto);
        $eliminar_producto_lista->execute();

        // Verificar si el producto ya está en el carrito
        $consulta_carrito = $conn->prepare("SELECT cantidad FROM carrito WHERE id_usuario = ? AND id_producto = ?");
        $consulta_carrito->bind_param("ii", $id_usuario, $id_producto);
        $consulta_carrito->execute();
        $resultado_carrito = $consulta_carrito->get_result();

        if ($resultado_carrito->num_rows > 0) {
            // Si el producto ya está en el carrito, incrementamos la cantidad
            $actualizar_carrito = $conn->prepare("UPDATE carrito SET cantidad = cantidad + 1 WHERE id_usuario = ? AND id_producto = ?");
            $actualizar_carrito->bind_param("ii", $id_usuario, $id_producto);
            $actualizar_carrito->execute();
        } else {
            // Si el producto no está en el carrito, lo agregamos con cantidad 1
            $agregar_carrito = $conn->prepare("INSERT INTO carrito (id_usuario, id_producto, cantidad) VALUES (?, ?, 1)");
            $agregar_carrito->bind_param("ii", $id_usuario, $id_producto);
            $agregar_carrito->execute();
        }
    }

    // Redirigir al usuario de nuevo a la página de la lista de deseos
    header("Location: ../../views/deseados.php");
    exit();
}
?>
