<?php
function obtenerReseniasProducto($conn, $idProducto)
{
    $sql = "SELECT r.calificacion, r.comentario, u.nombre_usuario, r.id_usuario
            FROM resenia r
            JOIN usuario u ON r.id_usuario = u.id_usuario
            WHERE r.id_producto = ? AND r.activo = 1";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $idProducto);
    $stmt->execute();

    $result = $stmt->get_result();
    if (!$result) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    }

    $resenias = [];
    while ($resenia = $result->fetch_assoc()) {
        $resenias[] = $resenia;
    }

    $stmt->close();
    return $resenias;
}


function obtenerReseniasPendientes($conn, $idUsuario)
{
    // Consulta para obtener productos que no han sido reseñados
    $sql = "SELECT DISTINCT 
                p.id_producto, 
                p.nombre_producto, 
                p.foto_producto, 
                MIN(c.fecha_compra) AS fecha_compra
            FROM 
                producto p
            JOIN 
                compra_producto cp ON p.id_producto = cp.id_producto
            JOIN 
                compra c ON cp.id_compra = c.id_compra
            LEFT JOIN 
                resenia r ON r.id_producto = p.id_producto AND r.id_usuario = c.id_usuario
            WHERE 
                c.id_usuario = ?  -- Productos comprados por el usuario
                AND r.id_resenia IS NULL  -- Solo los productos sin reseña
                AND cp.tipo_estado = 'entregado'  
            GROUP BY 
                p.id_producto, 
                p.nombre_producto, 
                p.foto_producto;
            ";  // Agrupar por producto para evitar duplicados

    // Preparar la consulta 
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);  // Error en la preparación de la consulta
    }

    // Asociar parámetros con la consulta preparada
    $stmt->bind_param("i", $idUsuario);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el resultado de la consulta
    $result = $stmt->get_result();
    if (!$result) {
        die("Error al ejecutar la consulta: " . $stmt->error);  // Error al ejecutar la consulta
    }

    // Crear un array para almacenar los productos pendientes
    $pendientes = [];
    while ($producto = $result->fetch_assoc()) {
        $pendientes[] = $producto;  // Almacenar cada producto en el array
    }

    // Cerrar la declaración y la conexión
    $stmt->close();

    // Devolver los productos pendientes
    return $pendientes;
}



function obtenerReseniasRealizadas($conn, $idUsuario)
{
    $sql = "SELECT p.id_producto, p.nombre_producto, r.fecha_resenia, r.calificacion, r.comentario, p.foto_producto, r.id_resenia
            FROM resenia r
            JOIN producto p ON r.id_producto = p.id_producto
            WHERE r.id_usuario = ? AND r.activo = 1";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();

    $result = $stmt->get_result();
    if (!$result) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    }

    $realizadas = [];
    while ($resenia = $result->fetch_assoc()) {
        $realizadas[] = $resenia;
    }

    $stmt->close();
    return $realizadas;
}
