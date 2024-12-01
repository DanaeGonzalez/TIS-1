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


function obtenerReseniasPendientes($conn, $idUsuario) {
    $sql = "SELECT DISTINCT p.id_producto, p.nombre_producto, p.foto_producto, MIN(c.fecha_compra) AS fecha_compra
            FROM producto p
            JOIN compra_producto cp ON p.id_producto = cp.id_producto
            JOIN compra c ON cp.id_compra = c.id_compra
            LEFT JOIN resenia r ON r.id_producto = p.id_producto AND r.id_usuario = ?
            WHERE c.id_usuario = ? AND r.id_resenia IS NULL
            GROUP BY p.id_producto, p.nombre_producto, p.foto_producto";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ii", $idUsuario, $idUsuario);
    $stmt->execute();

    $result = $stmt->get_result();
    if (!$result) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    }

    $pendientes = [];
    while ($producto = $result->fetch_assoc()) {
        $pendientes[] = $producto;
    }

    $stmt->close();
    return $pendientes;
}



function obtenerReseniasRealizadas($conn, $idUsuario) {
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
?>
