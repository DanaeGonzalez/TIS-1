<?php
include '../../config/conexion.php';

$id_categoria = $_GET['id_categoria'] ?? null;

if (!$id_categoria) {
    echo "<p>Error: Categoría no especificada.</p>";
    exit;
}

// Consultar las subcategorías asociadas a la categoría
$subcategoriasQuery = "SELECT id_subcategoria, nombre_subcategoria FROM subcategoria WHERE id_categoria = ?";
$stmt = $conn->prepare($subcategoriasQuery);
$stmt->bind_param("i", $id_categoria);
$stmt->execute();
$subcategorias = $stmt->get_result();

// Iniciar un contenedor para organizar los filtros horizontalmente
echo "<div class='d-flex justify-content-center gap-3 mt-5'>";

// Generar el dropdown para subcategorías
if ($subcategorias && $subcategorias->num_rows > 0) {
    echo "<div class='dropdown'>";
    echo "<button class='btn btn-light border dropdown-toggle rounded-pill' type='button' id='dropdownSubcategorias' data-bs-toggle='dropdown' aria-expanded='false'>Subcategoría</button>";
    echo "<ul class='dropdown-menu' aria-labelledby='dropdownSubcategorias'>";
    while ($subcat = $subcategorias->fetch_assoc()) {
        echo "<li><label class='dropdown-item'><input type='checkbox' name='subcategoria' value='" . $subcat['id_subcategoria'] . "'> " . $subcat['nombre_subcategoria'] . "</label></li>";
    }
    echo "</ul></div>";
}

// Características según la categoría
$caracteristicas = [
    'color' => 'Todos', // Aplica a todas las categorías
    'material' => 'Todos', // Aplica a todas las categorías
    'n_asientos' => [6, 7], // Mesa, Sillón
    'n_plazas' => [8], // Cama
    'forma' => [6, 7], // Mesa, Sillón
    'ambiente' => [6, 5, 7, 9], // Mesa, Silla, Sillón, Almacenamiento/Organización
    'firmeza' => [7], // Sillón
    'n_cajones' => [9] // Almacenamiento/Organización
];

foreach ($caracteristicas as $tabla => $categorias) {
    if ($categorias === 'Todos' || in_array($id_categoria, $categorias)) {
        // Consulta para obtener los datos de cada tabla de características
        $query = "SELECT * FROM $tabla";
        $result = $conn->query($query);

        echo "<div class='dropdown'>";
        echo "<button class='btn btn-light border dropdown-toggle rounded-pill' type='button' id='dropdown" . ucfirst($tabla) . "' data-bs-toggle='dropdown' aria-expanded='false'>" . ucfirst($tabla) . "</button>";
        echo "<ul class='dropdown-menu' aria-labelledby='dropdown" . ucfirst($tabla) . "'>";

        if ($result && $result->num_rows > 0) {
            while ($fila = $result->fetch_assoc()) {
                $id = $fila['id_' . $tabla] ?? null;
                $nombre = $fila['nombre_' . $tabla] ?? null;

                if ($id && $nombre) {
                    echo "<li><label class='dropdown-item'><input type='checkbox' name='$tabla' value='$id'> $nombre</label></li>";
                }
            }
        } else {
            echo "<li><span class='dropdown-item text-muted'>No hay opciones disponibles</span></li>";
        }

        echo "</ul></div>";
    }
}

// Cerrar el contenedor de filtros
echo "</div>";
?>
