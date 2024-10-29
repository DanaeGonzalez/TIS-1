<?php
// Conexión a la base de datos
include 'conexion.php';

// Obtener el tipo de producto y el ID del producto
$id_producto = $_POST['id_producto'];
$tipo_producto = $_POST['tipo_producto'];

// Variables generales que estarán presentes en todas las tablas
$color = $_POST['color'];
$material = $_POST['material'];
$ambiente = $_POST['ambiente'];
$subcategoria = $_POST['subcategoria'];

// Inserción basada en el tipo de producto
switch($tipo_producto) {
    case 'silla':
        $sql = "INSERT INTO caracteristicas_silla (id_producto, color, material, ambiente, subcategoria) VALUES ('$id_producto', '$color', '$material', '$ambiente', '$subcategoria')";
        break;
    
    case 'mesa':
        $n_asientos = $_POST['n_asientos'];
        $forma = $_POST['forma'];
        $sql = "INSERT INTO caracteristicas_mesa (id_producto, color, material, ambiente, subcategoria, n_asientos, forma) VALUES ('$id_producto', '$color', '$material', '$ambiente', '$subcategoria', '$n_asientos', '$forma')";
        break;

    case 'sillon':
        $n_asientos = $_POST['n_asientos'];
        $forma = $_POST['forma'];
        $firmeza = $_POST['firmeza'];
        $sql = "INSERT INTO caracteristicas_sillon (id_producto, color, material, ambiente, subcategoria, n_asientos, forma, firmeza) VALUES ('$id_producto', '$color', '$material', '$ambiente', '$subcategoria', '$n_asientos', '$forma', '$firmeza')";
        break;

    case 'cama':
        $n_plazas = $_POST['n_plazas'];
        $sql = "INSERT INTO caracteristicas_cama (id_producto, color, material, ambiente, subcategoria, n_plazas) VALUES ('$id_producto', '$color', '$material', '$ambiente', '$subcategoria', '$n_plazas')";
        break;

    case 'almacenamiento/organizacion':
        $n_cajones = $_POST['n_cajones'];
        $sql = "INSERT INTO caracteristicas_almacenamiento (id_producto, color, material, ambiente, subcategoria, n_cajones) VALUES ('$id_producto', '$color', '$material', '$ambiente', '$subcategoria', '$n_cajones')";
        break;

    default:
        die("Tipo de producto no reconocido.");
}

// Ejecutar la consulta y verificar el resultado
if (mysqli_query($conexion, $sql)) {
    echo "Características agregadas correctamente.";
} else {
    echo "Error: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
