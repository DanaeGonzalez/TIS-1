<?php
include '../../config/conexion.php';
include '../../views/menu_registro/auth.php';

if (isset($_SESSION['id_usuario'])) {
    $id_usuario = $_SESSION['id_usuario']; // Obtener el id_usuario desde la sesión

    // Caso 1: Añadir productos enviados como un array
    if (isset($_POST['productos']) && is_array($_POST['productos'])) {
        $productos = $_POST['productos']; // Array con los id_producto
        manejarProductos($conn, $id_usuario, $productos);
    }

    // Caso 2: Añadir un único producto (si se envía individualmente)
    if (isset($_POST['id_producto'])) {
        $id_producto = $_POST['id_producto'];
        manejarProductos($conn, $id_usuario, [$id_producto]); // Convertimos en array
    }

    // Redirigir a la lista de deseos
    header("Location: ../../views/deseados.php");
    exit();
}

function manejarProductos($conn, $id_usuario, $productos)
{
    foreach ($productos as $id_producto) {
        // Inicializamos stock como -1 (valor predeterminado para indicar error)
        $stock_disponible = -1;

        // Verificar el stock del producto
        $consulta_stock = $conn->prepare("SELECT stock_producto FROM producto WHERE id_producto = ?");
        $consulta_stock->bind_param("i", $id_producto);
        $consulta_stock->execute();
        $consulta_stock->bind_result($stock_disponible);
        $consulta_stock->fetch();
        $consulta_stock->close();

        // Validación: si no hay stock o producto no encontrado, saltar al siguiente
        if ($stock_disponible <= 0) {
            continue; // Producto no puede ser procesado si no hay stock
        }

        // Verificar si el producto ya está en el carrito
        $cantidad_actual = 0; // Por defecto, asumimos que el producto no está en el carrito
        $consulta_carrito = $conn->prepare("SELECT cantidad FROM carrito WHERE id_usuario = ? AND id_producto = ?");
        $consulta_carrito->bind_param("ii", $id_usuario, $id_producto);
        $consulta_carrito->execute();
        $consulta_carrito->bind_result($cantidad_actual);
        $consulta_carrito->fetch();
        $consulta_carrito->close();

        // Calcular la nueva cantidad
        $nueva_cantidad = $cantidad_actual + 1;

        // Asegurarse de no superar el stock disponible
        if ($nueva_cantidad > $stock_disponible) {
            $nueva_cantidad = $stock_disponible;
        }

        if ($cantidad_actual > 0) {
            // Actualizar la cantidad en el carrito
            $actualizar_carrito = $conn->prepare("
                UPDATE carrito 
                SET cantidad = ? 
                WHERE id_usuario = ? AND id_producto = ?
            ");
            $actualizar_carrito->bind_param("iii", $nueva_cantidad, $id_usuario, $id_producto);
            $actualizar_carrito->execute();
            $actualizar_carrito->close();
        } else {
            // Agregar el producto al carrito
            $agregar_carrito = $conn->prepare("
                INSERT INTO carrito (id_usuario, id_producto, cantidad) 
                VALUES (?, ?, ?)
            ");
            $agregar_carrito->bind_param("iii", $id_usuario, $id_producto, $nueva_cantidad);
            $agregar_carrito->execute();
            $agregar_carrito->close();
        }

        // Eliminar el producto de la lista de deseos
        $eliminar_producto_lista = $conn->prepare("
            DELETE FROM lista_deseos_producto 
            WHERE id_producto = ? AND id_lista_deseos = (
                SELECT id_lista_deseos 
                FROM lista_de_deseos 
                WHERE id_usuario = ?
            )
        ");
        $eliminar_producto_lista->bind_param("ii", $id_producto, $id_usuario);
        $eliminar_producto_lista->execute();
        $eliminar_producto_lista->close();
    }
}

?>
