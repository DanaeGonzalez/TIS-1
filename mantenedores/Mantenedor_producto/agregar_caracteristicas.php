<?php
    session_start();
    include '../conexion.php';

    #print_r($_POST); // depuracion

    $id_producto = $_POST['id_producto'] ?? null;
    $categoria = $_POST['categoria'] ?? null;
    $color = $_POST['color'] ?? null;
    $material = $_POST['material'] ?? null;
    $ambiente = $_POST['ambiente'] ?? null;
    $subcategoria = $_POST['subcategoria'] ?? null;

    function verificarExistencia($conn, $tabla, $columna, $valor) {
        $sql = "SELECT COUNT(*) FROM $tabla WHERE $columna = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta de verificación: " . $conn->error);
        }

        $stmt->bind_param("i", $valor);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close(); 
        return $count > 0;
    }

    function insertarCaracteristica($conn, $id_producto, $nombre_tabla, $nombre_columna, $valor, $nombre_caracteristica) {
        if (!verificarExistencia($conn, substr($nombre_tabla, 9), $nombre_columna, $valor)) {
            throw new Exception("El valor de $nombre_caracteristica ($valor) no existe en la tabla correspondiente.");
        }

        $sql = "INSERT INTO $nombre_tabla (id_producto, $nombre_columna) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta para $nombre_caracteristica: " . $conn->error);
        }

        $stmt->bind_param("ii", $id_producto, $valor);
        if (!$stmt->execute()) {
            throw new Exception("Error al insertar en $nombre_tabla para $nombre_caracteristica: " . $stmt->error);
        }
        $stmt->close();
    }

    try {
        $conn->autocommit(false);

        $sql = "UPDATE producto SET id_subcategoria = ? WHERE id_producto = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error en la preparación de la consulta de actualización de subcategoría: " . $conn->error);
        }

        $stmt->bind_param("ii", $subcategoria, $id_producto);
        $stmt->execute();
        $stmt->close();

        insertarCaracteristica($conn, $id_producto, 'producto_color', 'id_color', $color, 'color');
        insertarCaracteristica($conn, $id_producto, 'producto_material', 'id_material', $material, 'material');
        insertarCaracteristica($conn, $id_producto, 'producto_ambiente', 'id_ambiente', $ambiente, 'ambiente');

        switch ($categoria) {
            case '5':
                break;

            case '6':
                $n_asientos = $_POST['n_asientos'] ?? null;
                $forma = $_POST['forma'] ?? null;
                insertarCaracteristica($conn, $id_producto, 'producto_n_asientos', 'id_n_asientos', $n_asientos, 'n_asientos');
                insertarCaracteristica($conn, $id_producto, 'producto_forma', 'id_forma', $forma, 'forma');
                break;

            case '7':
                $n_asientos = $_POST['n_asientos'] ?? null;
                $forma = $_POST['forma'] ?? null;
                $firmeza = $_POST['firmeza'] ?? null;
                insertarCaracteristica($conn, $id_producto, 'producto_n_asientos', 'id_n_asientos', $n_asientos, 'n_asientos');
                insertarCaracteristica($conn, $id_producto, 'producto_forma', 'id_forma', $forma, 'forma');
                insertarCaracteristica($conn, $id_producto, 'producto_firmeza', 'id_firmeza', $firmeza, 'firmeza');
                break;

            case '8':
                $n_plazas = $_POST['n_plazas'] ?? null;
                insertarCaracteristica($conn, $id_producto, 'producto_n_plazas', 'id_n_plazas', $n_plazas, 'n_plazas');
                break;

            case '9':
                $n_cajones = $_POST['n_cajones'] ?? null;
                insertarCaracteristica($conn, $id_producto, 'producto_n_cajones', 'id_n_cajones', $n_cajones, 'n_cajones');
                break;

            default:
                throw new Exception("Categoría no válida: " . htmlspecialchars($categoria));
        }

        $conn->commit();
        $_SESSION['mensaje'] = "Características agregadas exitosamente.";

    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['mensaje'] = "Error al agregar características: " . $e->getMessage();

    } finally {
        $conn->autocommit(true);

    }

    header('Location: mostrar_producto.php');
    exit();

?>
