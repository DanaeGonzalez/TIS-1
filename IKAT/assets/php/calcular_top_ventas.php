<?php
function obtenerTopVentas($conn) {
    $topVentas = [];
    $sqlTopVentas = "SELECT id_producto FROM producto WHERE activo = 1 ORDER BY cantidad_vendida DESC LIMIT 3";
    $resultTopVentas = $conn->query($sqlTopVentas);

    if ($resultTopVentas && $resultTopVentas->num_rows > 0) {
        while ($row = $resultTopVentas->fetch_assoc()) {
            $topVentas[] = $row['id_producto'];
        }
    }

    return $topVentas;
}
?>
