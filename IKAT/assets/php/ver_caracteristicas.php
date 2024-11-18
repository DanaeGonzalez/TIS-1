<?php
function obtenerCaracteristicasProducto($conn, $idProducto) {
    $caracteristicas = [];

    // Consulta para el color
    $consultaColor = "SELECT c.nombre_color FROM color c INNER JOIN producto_color pc ON c.id_color = pc.id_color WHERE pc.id_producto = ?";
    $stmtColor = $conn->prepare($consultaColor);
    $stmtColor->bind_param("i", $idProducto);
    if ($stmtColor->execute()) {
        $result = $stmtColor->get_result();
        while ($row = $result->fetch_assoc()) {
            $caracteristicas[] = "Color: " . $row['nombre_color'];
        }
    }
    $stmtColor->close();

    // Consulta para el material
    $consultaMaterial = "SELECT m.nombre_material FROM material m INNER JOIN producto_material pm ON m.id_material = pm.id_material WHERE pm.id_producto = ?";
    $stmtMaterial = $conn->prepare($consultaMaterial);
    $stmtMaterial->bind_param("i", $idProducto);
    if ($stmtMaterial->execute()) {
        $result = $stmtMaterial->get_result();
        while ($row = $result->fetch_assoc()) {
            $caracteristicas[] = "Material: " . $row['nombre_material'];
        }
    }
    $stmtMaterial->close();

    // Consulta para el ambiente
    $consultaAmbiente = "SELECT a.nombre_ambiente FROM ambiente a INNER JOIN producto_ambiente pa ON a.id_ambiente = pa.id_ambiente WHERE pa.id_producto = ?";
    $stmtAmbiente = $conn->prepare($consultaAmbiente);
    $stmtAmbiente->bind_param("i", $idProducto);
    if ($stmtAmbiente->execute()) {
        $result = $stmtAmbiente->get_result();
        while ($row = $result->fetch_assoc()) {
            $caracteristicas[] = "Ambiente: " . $row['nombre_ambiente'];
        }
    }
    $stmtAmbiente->close();

    // Consulta para la firmeza
    $consultaFirmeza = "SELECT f.nivel_firmeza FROM firmeza f INNER JOIN producto_firmeza pf ON f.id_firmeza = pf.id_firmeza WHERE pf.id_producto = ?";
    $stmtFirmeza = $conn->prepare($consultaFirmeza);
    $stmtFirmeza->bind_param("i", $idProducto);
    if ($stmtFirmeza->execute()) {
        $result = $stmtFirmeza->get_result();
        while ($row = $result->fetch_assoc()) {
            $caracteristicas[] = "Firmeza: " . $row['nivel_firmeza'];
        }
    }
    $stmtFirmeza->close();

    // Consulta para la forma
    $consultaForma = "SELECT fo.nombre_forma FROM forma fo INNER JOIN producto_forma pf ON fo.id_forma = pf.id_forma WHERE pf.id_producto = ?";
    $stmtForma = $conn->prepare($consultaForma);
    $stmtForma->bind_param("i", $idProducto);
    if ($stmtForma->execute()) {
        $result = $stmtForma->get_result();
        while ($row = $result->fetch_assoc()) {
            $caracteristicas[] = "Forma: " . $row['nombre_forma'];
        }
    }
    $stmtForma->close();

    // Consulta para el número de asientos
    $consultaAsientos = "SELECT na.cantidad_asientos FROM n_asientos na INNER JOIN producto_n_asientos pna ON na.id_n_asientos = pna.id_n_asientos WHERE pna.id_producto = ?";
    $stmtAsientos = $conn->prepare($consultaAsientos);
    $stmtAsientos->bind_param("i", $idProducto);
    if ($stmtAsientos->execute()) {
        $result = $stmtAsientos->get_result();
        while ($row = $result->fetch_assoc()) {
            $caracteristicas[] = "N° de asientos: " . $row['cantidad_asientos'];
        }
    }
    $stmtAsientos->close();

    // Consulta para el número de cajones
    $consultaCajones = "SELECT nc.cantidad_cajones FROM n_cajones nc INNER JOIN producto_n_cajones pnc ON nc.id_n_cajones = pnc.id_n_cajones WHERE pnc.id_producto = ?";
    $stmtCajones = $conn->prepare($consultaCajones);
    $stmtCajones->bind_param("i", $idProducto);
    if ($stmtCajones->execute()) {
        $result = $stmtCajones->get_result();
        while ($row = $result->fetch_assoc()) {
            $caracteristicas[] = "N° de cajones: " . $row['cantidad_cajones'];
        }
    }
    $stmtCajones->close();

    // Consulta para el número de plazas
    $consultaPlazas = "SELECT np.tamaño_plaza FROM n_plazas np INNER JOIN producto_n_plazas pnp ON np.id_n_plazas = pnp.id_n_plazas WHERE pnp.id_producto = ?";
    $stmtPlazas = $conn->prepare($consultaPlazas);
    $stmtPlazas->bind_param("i", $idProducto);
    if ($stmtPlazas->execute()) {
        $result = $stmtPlazas->get_result();
        while ($row = $result->fetch_assoc()) {
            $caracteristicas[] = "N° de plazas: " . $row['tamaño_plaza'];
        }
    }
    $stmtPlazas->close();

    // Consulta para la subcategoría
    $consultaSubcategoria = "SELECT sc.nombre_subcategoria FROM subcategoria sc INNER JOIN producto p ON sc.id_subcategoria = p.id_subcategoria WHERE p.id_producto = ?";
    $stmtSubcategoria = $conn->prepare($consultaSubcategoria);
    $stmtSubcategoria->bind_param("i", $idProducto);
    if ($stmtSubcategoria->execute()) {
        $result = $stmtSubcategoria->get_result();
        if ($row = $result->fetch_assoc()) {
            $caracteristicas[] = "Subcategoría: " . $row['nombre_subcategoria'];
        }
    }
    $stmtSubcategoria->close();

    return $caracteristicas;
}
