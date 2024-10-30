<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['mensaje'] = ''; // Inicializar el mensaje de sesión
    
    // Validación y asignación de variables
    $id_producto = $_POST['id_producto'] ?? null;
    $categoria = $_POST['categoria'] ?? null;
    $color = $_POST['color'] ?? null;
    $material = $_POST['material'] ?? null;
    $ambiente = $_POST['ambiente'] ?? null;
    $subcategoria = $_POST['subcategoria'] ?? null;
    
    // Comprobar que todos los campos obligatorios estén presentes
    if (!$id_producto || !$categoria || !$color || !$material || !$ambiente || !$subcategoria) {
        $_SESSION['mensaje'] = "Error: Todos los campos son obligatorios.";
        header('Location: mostrar_producto.php');
        exit();
    }

    // Obtener IDs correspondientes de subcategoría, color, material y ambiente
    $id_subcategoria = $conn->query("SELECT id_subcategoria FROM subcategoria WHERE nombre_subcategoria = '$subcategoria'")->fetch_assoc()['id_subcategoria'] ?? null;
    $id_color = $conn->query("SELECT id_color FROM color WHERE nombre_color = '$color'")->fetch_assoc()['id_color'] ?? null;
    $id_material = $conn->query("SELECT id_material FROM material WHERE nombre_material = '$material'")->fetch_assoc()['id_material'] ?? null;
    $id_ambiente = $conn->query("SELECT id_ambiente FROM ambiente WHERE nombre_ambiente = '$ambiente'")->fetch_assoc()['id_ambiente'] ?? null;

    // Verificar que se hayan obtenido los IDs correspondientes
    if (!$id_subcategoria || !$id_color || !$id_material || !$id_ambiente) {
        $_SESSION['mensaje'] .= "Error: No se pudieron obtener todos los IDs necesarios para realizar la inserción.<br>";
        header('Location: mostrar_producto.php');
        exit();
    }

    // Preparar consultas de inserción
    $sql_subcategoria = "INSERT INTO producto (id_subcategoria) VALUES ($id_subcategoria)";
    $sql_color = "INSERT INTO producto_color (id_producto, id_color) VALUES ($id_producto, $id_color)";
    $sql_material = "INSERT INTO producto_material (id_producto, id_material) VALUES ($id_producto, $id_material)";
    $sql_ambiente = "INSERT INTO producto_ambiente (id_producto, id_ambiente) VALUES ($id_producto, $id_ambiente)";

    // Ejecutar consultas según la categoría
    switch($categoria) {
        case 'silla':
            // Insertar en producto
            if ($conn->query($sql_subcategoria) === TRUE) {
                $_SESSION['mensaje'] .= "Registro en 'producto' insertado correctamente.<br>";
            } else {
                $_SESSION['mensaje'] .= "Error en 'producto': " . $conn->error . "<br>";
            }

            // Insertar en producto_color
            if ($conn->query($sql_color) === TRUE) {
                $_SESSION['mensaje'] .= "Registro en 'producto_color' insertado correctamente.<br>";
            } else {
                $_SESSION['mensaje'] .= "Error en 'producto_color': " . $conn->error . "<br>";
            }

            // Insertar en producto_material
            if ($conn->query($sql_material) === TRUE) {
                $_SESSION['mensaje'] .= "Registro en 'producto_material' insertado correctamente.<br>";
            } else {
                $_SESSION['mensaje'] .= "Error en 'producto_material': " . $conn->error . "<br>";
            }

            // Insertar en producto_ambiente
            if ($conn->query($sql_ambiente) === TRUE) {
                $_SESSION['mensaje'] .= "Registro en 'producto_ambiente' insertado correctamente.<br>";
            } else {
                $_SESSION['mensaje'] .= "Error en 'producto_ambiente': " . $conn->error . "<br>";
            }
            break;

        default:
            $_SESSION['mensaje'] .= "Error: Tipo de producto no reconocido.";
            header('Location: mostrar_producto.php');
            exit();
    }

    // Cerrar conexión y redirigir
    $conn->close();
    header('Location: mostrar_producto.php');
    exit();
}
?>
