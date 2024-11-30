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
