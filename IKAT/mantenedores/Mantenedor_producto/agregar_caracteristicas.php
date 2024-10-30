<?php
// Conectar a la base de datos
require_once 'conexion.php';

// Obtener ID del producto y categoría del producto
$id_producto = $_POST['id_producto'];
$categoria = $_POST['categoria'];

// Características comunes
$color = $_POST['color'];
$material = $_POST['material'];
$ambiente = $_POST['ambiente'];
$subcategoria = $_POST['subcategoria'];

// Función para insertar en tabla intermedia
function insertarCaracteristica($conn, $tabla, $id_producto, $id_caracteristica, $valor) {
    $query = "INSERT INTO $tabla (id_producto, $id_caracteristica) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $id_producto, $valor);
    $stmt->execute();
    $stmt->close();
}

// Insertar características comunes
insertarCaracteristica($conn, 'producto_color', 'id_color', $id_producto, $color);
insertarCaracteristica($conn, 'producto_material', 'id_material', $id_producto, $material);
insertarCaracteristica($conn, 'producto_ambiente', 'id_ambiente', $id_producto, $ambiente);
insertarCaracteristica($conn, 'producto_subcategoria', 'id_subcategoria', $id_producto, $subcategoria);

// Validar características adicionales según la categoría
if ($categoria == 'Silla') {
    // Características específicas de Silla
    // Aquí puedes agregar otros atributos específicos para Silla si existen
} elseif ($categoria == 'Mesa') {
    $n_asientos = $_POST['n_asientos'];
    $forma = $_POST['forma'];
    
    // Guardar características de Mesa
    insertarCaracteristica($conn, 'producto_n_asientos', 'id_asiento', $id_producto, $n_asientos);
    insertarCaracteristica($conn, 'producto_forma', 'id_forma', $id_producto, $forma);
} elseif ($categoria == 'Sillon') {
    $n_asientos = $_POST['n_asientos'];
    $forma = $_POST['forma'];
    $firmeza = $_POST['firmeza'];
    
    // Guardar características de Sillón
    insertarCaracteristica($conn, 'producto_n_asientos', 'id_asiento', $id_producto, $n_asientos);
    insertarCaracteristica($conn, 'producto_forma', 'id_forma', $id_producto, $forma);
    insertarCaracteristica($conn, 'producto_firmeza', 'id_firmeza', $id_producto, $firmeza);
} elseif ($categoria == 'Cama') {
    $n_plazas = $_POST['n_plazas'];
    
    // Guardar características de Cama
    insertarCaracteristica($conn, 'producto_n_plazas', 'id_plaza', $id_producto, $n_plazas);
} elseif ($categoria == 'Almacenamiento/Organización') {
    $n_cajones = $_POST['n_cajones'];
    
    // Guardar características de Almacenamiento/Organización
    insertarCaracteristica($conn, 'producto_n_cajones', 'id_cajon', $id_producto, $n_cajones);
}

// Redirigir o mostrar mensaje de éxito
header("Location: productos.php?mensaje=caracteristicas_guardadas");
exit();
?>
