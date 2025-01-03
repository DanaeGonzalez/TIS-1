<?php
include '../../config/conexion.php';
session_start();

$mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
unset($_SESSION['mensaje']);

$sqlCategorias = "SELECT * FROM categoria";
$resultCategorias = $conn->query($sqlCategorias);

$categorias = [];
if ($resultCategorias->num_rows > 0) {
    while ($rowCategoria = $resultCategorias->fetch_assoc()) {
        $categorias[] = $rowCategoria;
    }
}

$opcionesCategoria = "";
foreach ($categorias as $categoria) {
    $opcionesCategoria .= "<option value='" . $categoria['id_categoria'] . "'>" . $categoria['nombre_categoria'] . "</option>";
}


$sqlColores = "SELECT * FROM color";
$resultColores = $conn->query($sqlColores);

$colores = [];
if ($resultColores->num_rows > 0) {
    while ($rowColor = $resultColores->fetch_assoc()) {
        $colores[] = $rowColor;
    }
}

$opcionesColor = "";
foreach ($colores as $color) {
    $opcionesColor .= "<option value='" . $color['id_color'] . "'>" . $color['nombre_color'] . "</option>";
}


$sqlMateriales = "SELECT * FROM material";
$resultMateriales = $conn->query($sqlMateriales);

$materiales = [];
if ($resultMateriales->num_rows > 0) {
    while ($rowMaterial = $resultMateriales->fetch_assoc()) {
        $materiales[] = $rowMaterial;
    }
}

$opcionesMaterial = "";
foreach ($materiales as $material) {
    $opcionesMaterial .= "<option value='" . $material['id_material'] . "'>" . $material['nombre_material'] . "</option>";
}


$sqlAmbiente = "SELECT * FROM ambiente";
$resultAmbientes = $conn->query($sqlAmbiente);

$ambientes = [];
if ($resultAmbientes->num_rows > 0) {
    while ($rowAmbiente = $resultAmbientes->fetch_assoc()) {
        $ambientes[] = $rowAmbiente;
    }
}

$opcionesAmbiente = "";
foreach ($ambientes as $ambiente) {
    $opcionesAmbiente .= "<option value='" . $ambiente['id_ambiente'] . "'>" . $ambiente['nombre_ambiente'] . "</option>";
}


$sqlSubcategoria = "SELECT id_subcategoria, nombre_subcategoria FROM subcategoria";
$resultSubcategorias = $conn->query($sqlSubcategoria);

$subcategorias = [];
if ($resultSubcategorias->num_rows > 0) {
    while ($rowSubcategoria = $resultSubcategorias->fetch_assoc()) {
        $subcategorias[] = $rowSubcategoria;
    }
}

$opcionesSubcategoria = "";
foreach ($subcategorias as $subcategoria) {
    $opcionesSubcategoria .= "<option value='" . $subcategoria['id_subcategoria'] . "'>" . $subcategoria['nombre_subcategoria'] . "</option>";
}


$sqlAsientos = "SELECT * FROM n_asientos";
$resultAsientos = $conn->query($sqlAsientos);

$asientos = [];
if ($resultAsientos->num_rows > 0) {
    while ($rowAsiento = $resultAsientos->fetch_assoc()) {
        $asientos[] = $rowAsiento;
    }
}

$opcionesAsiento = "";
foreach ($asientos as $asiento) {
    $opcionesAsiento .= "<option value='" . $asiento['id_n_asientos'] . "'>" . $asiento['cantidad_asientos'] . "</option>";
}


$sqlPlazas = "SELECT * FROM n_plazas";
$resultPlazas = $conn->query($sqlPlazas);

$plazas = [];
if ($resultPlazas->num_rows > 0) {
    while ($rowPlaza = $resultPlazas->fetch_assoc()) {
        $plazas[] = $rowPlaza;
    }
}

$opcionesPlaza = "";
foreach ($plazas as $plaza) {
    $opcionesPlaza .= "<option value='" . $plaza['id_n_plazas'] . "'>" . $plaza['tamaño_plaza'] . "</option>";
}


$sqlCajones = "SELECT * FROM n_cajones";
$resultCajones = $conn->query($sqlCajones);

$cajones = [];
if ($resultCajones->num_rows > 0) {
    while ($rowCajon = $resultCajones->fetch_assoc()) {
        $cajones[] = $rowCajon;
    }
}

$opcionesCajon = "";
foreach ($cajones as $cajon) {
    $opcionesCajon .= "<option value='" . $cajon['id_n_cajones'] . "'>" . $cajon['cantidad_cajones'] . "</option>";
}

$sqlFirmeza = "SELECT * FROM firmeza";
$resultFirmeza = $conn->query($sqlFirmeza);

$firmezas = [];
if ($resultFirmeza->num_rows > 0) {
    while ($rowFirmeza = $resultFirmeza->fetch_assoc()) {
        $firmezas[] = $rowFirmeza;
    }
}

$opcionesFirmeza = "";
foreach ($firmezas as $firmeza) {
    $opcionesFirmeza .= "<option value='" . $firmeza['id_firmeza'] . "'>" . $firmeza['nivel_firmeza'] . "</option>";
}


$sqlForma = "SELECT * FROM forma";
$resultForma = $conn->query($sqlForma);

$formas = [];
if ($resultForma->num_rows > 0) {
    while ($rowForma = $resultForma->fetch_assoc()) {
        $formas[] = $rowForma;
    }
}

$opcionesForma = "";
foreach ($formas as $forma) {
    $opcionesForma .= "<option value='" . $forma['id_forma'] . "'>" . $forma['nombre_forma'] . "</option>";
}

$sqlProducto = "SELECT id_producto, nombre_producto FROM producto";
$resultProductos = $conn->query($sqlProducto);

$productos = [];
if ($resultProductos->num_rows > 0) {
    while ($rowProducto = $resultProductos->fetch_assoc()) {
        $productos[] = $rowProducto;
    }
}

$opcionesProducto = "";
foreach ($productos as $producto) {
    $opcionesProducto .= "<option value='" . $producto['id_producto'] . "'>" . $producto['nombre_producto'] . "</option>";
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKAT - Mantenedor de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="..\..\assets\css\styles.css">
</head>

<body>
    <!-- Header -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/xampp/TIS-1/IKAT/templates/header.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-3 p-0">
                <?php include '../sidebar-mantenedores.php'; ?>
            </div>

            <!-- Main Content Area -->
            <div class="col-md-9 col-lg-9 col-12 content-area px-3">
                <?php if ($mensaje): ?>
                    <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                        <?php echo $mensaje; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <h1 class="text-center py-3">Mantenedor de Productos</h1>

                <div class="d-flex justify-content-end mb-3">
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#agregarProductoModal">
                        <i class="bi bi-file-earmark-plus"></i>
                    </a>
                </div>

                <div class="table-responsive">
                    <?php
                    $sql = "SELECT * FROM producto";
                    $result = $conn->query($sql);

                    if ($result) {
                        if ($result->num_rows > 0) {
                            echo "<table class='table table-bordered table-striped'>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>
                                                <th>Stock</th>
                                                <th>Descripción</th>
                                                <th>Foto</th>
                                                <th>Cantidad Vendida</th>
                                                <th>Top Venta</th>
                                                <th>Activo</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                            <td>" . $row["id_producto"] . "</td>
                                            <td class='text-truncate' style='max-width: 150px;'>" . htmlspecialchars($row["nombre_producto"]) . "</td>
                                            <td>" . $row["precio_unitario"] . "</td>
                                            <td>" . $row["stock_producto"] . "</td>
                                            <td class='text-truncate' style='max-width: 200px;' title='" . htmlspecialchars($row["descripcion_producto"]) . "'>
                                                " . htmlspecialchars($row["descripcion_producto"]) . "
                                            </td>
                                            <td><img src='" . $row["foto_producto"] . "' alt='Foto del producto' class='img-fluid' style='max-width: 50px;'></td>
                                            <td>" . $row["cantidad_vendida"] . "</td>
                                            <td>" . ($row["top_venta"] ? "Sí" : "No") . "</td>
                                            <td>" . ($row["activo"] ? "Sí" : "No") . "</td>
                                            <td>
                                                <div class='d-flex justify-content-center flex-wrap gap-1'>
                                                    <div class='btn-group d-block d-sm-none'> <!-- Dropdown para pantallas pequeñas -->
                                                        <button type='button' class='btn btn-secondary btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-expanded='false'>
                                                            <i class='bi bi-gear'></i>
                                                        </button>
                                                        <ul class='dropdown-menu'>
                                                            <li><a class='dropdown-item' data-bs-toggle='modal' data-bs-target='#editarProductoModal" . $row["id_producto"] . "'>
                                                                <i class='bi bi-pen'></i> Editar
                                                            </a></li>
                                                            <li><a class='dropdown-item' data-bs-toggle='modal' data-bs-target='#agregarCaracteristicasModal" . $row["id_producto"] . "'>
                                                                <i class='bi bi-database-add'></i> Agregar características
                                                            </a></li>
                                                            <li><a class='dropdown-item' data-bs-toggle='modal' data-bs-target='#modificarProductoStockModal" . $row["id_producto"] . "'>
                                                                <i class='bi bi-plus-circle'></i> Modificar stock
                                                            </a></li>
                                                            <li><a class='dropdown-item' href='historial_producto.php?id_producto=" . $row["id_producto"] . "'>
                                                                <i class='bi bi-clock-history'></i> Historial
                                                            </a></li>
                                                            <li><a class='dropdown-item' href='cambiar_estado_producto.php?id=" . $row["id_producto"] . "'>
                                                                <i class='bi bi-trash3'></i> Cambiar estado
                                                            </a></li>
                                                        </ul>
                                                    </div>
                                                    <div class='d-none d-sm-flex flex-wrap gap-1'> <!-- Botones normales para pantallas grandes -->
                                                        <a class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editarProductoModal" . $row["id_producto"] . "'>
                                                            <i class='bi bi-pen'></i>
                                                        </a>
                                                        <a class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#agregarCaracteristicasModal" . $row["id_producto"] . "'>
                                                            <i class='bi bi-database-add'></i>
                                                        </a>
                                                        <a class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modificarProductoStockModal" . $row["id_producto"] . "'>
                                                            <i class='bi bi-plus-circle'></i>
                                                        </a>
                                                        <a class='btn btn-secondary btn-sm' href='historial_producto.php?id_producto=" . $row["id_producto"] . "'>
                                                            <i class='bi bi-clock-history'></i>
                                                        </a>
                                                        <a class='btn btn-danger btn-sm' href='cambiar_estado_producto.php?id=" . $row["id_producto"] . "'>
                                                            <i class='bi bi-trash3'></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>";

                                echo "
                                    <div class='modal fade' id='editarProductoModal" . $row["id_producto"] . "' tabindex='-1' aria-labelledby='editarProductoModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='editarProductoModalLabel'>Editar Producto</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    <form action='actualizar_producto.php' method='post'>
                                                        <input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>
                
                                                        Nombre del Producto: <input class='form-control' type='text' name='nombre_producto' value='" . $row['nombre_producto'] . "' required><br>
                
                                                        Precio Unitario: <input class='form-control' type='number' name='precio_unitario' value='" . $row['precio_unitario'] . "' required><br>
                
                                                        Descripción: <textarea class='form-control' required name='descripcion_producto'>" . $row['descripcion_producto'] . "</textarea><br>
                                
                                                        Foto del Producto (URL): <input class='form-control' required type='text' name='foto_producto' value='" . $row['foto_producto'] . "'><br>
                
                                                        <button type='submit' class='btn btn-primary'>Actualizar Producto</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";

                                echo "
                                    <div class='modal fade' id='modificarProductoStockModal" . $row["id_producto"] . "' tabindex='-1' aria-labelledby='modificarProductoStockModalLabel" . $row["id_producto"] . "' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='modificarProductoStockModalLabel" . $row["id_producto"] . "'>Agregar Producto</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    <form action='actualizar_stock.php' method='POST'>
                                                        <input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>
                                                        <div class='mb-3'>
                                                            <label for='cantidad' class='form-label'>Cantidad</label>
                                                            <input type='number' class='form-control' id='cantidad' name='cantidad' required>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='motivo' class='form-label'>Motivo</label>
                                                            <select class='form-select' id='motivo' name='motivo' required>
                                                                <option value='' disabled selected>Seleccione el motivo</option>
                                                                <option value='Ingreso'>Ingreso</option>
                                                                <option value='Salida'>Salida</option>
                                                            </select>
                                                        </div>
                                                        <div class='mb-3'>
                                                            <label for='explicacion' class='form-label'>Explicación</label>
                                                            <textarea class='form-control' id='explicacion' name='explicacion' rows='3' required></textarea>
                                                        </div>
                                                        <button type='submit' class='btn btn-primary'>Guardar Cambio de Stock</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";


                                echo "
                                    <div class='modal fade' id='agregarCaracteristicasModal" . $row["id_producto"] . "' tabindex='-1' aria-labelledby='agregarCaracteristicasModalLabel" . $row["id_producto"] . "' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='agregarCaracteristicasModalLabel" . $row["id_producto"] . "'>Agregar Características al Producto</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    <form action='agregar_caracteristicas.php' method='post'>
                                                        <!-- Campo oculto para el ID del producto -->
                                                        <input type='hidden' name='id_producto' value='" . $row['id_producto'] . "'>
                                                            
                                                        <!-- Selección de tipo de producto -->  
                                                        <label for='tipoProducto'>Tipo de Producto:</label>
    
                                                        <select class='form-select' id='tipoProducto" . $row["id_producto"] . "' name='categoria' required onchange='mostrarCaracteristicas(\"" . $row["id_producto"] . "\")'>
                                                            <option value=''>Seleccione el tipo de producto</option>
                                                            $opcionesCategoria
                                                        </select>
                                                            
                                                        <!-- Formulario de Características para Sillas -->
                                                        <div id='caracteristicasSilla" . $row["id_producto"] . "' style='display: none;'>
                                                            <h6 class='mt-3'>Características de Silla</h6>
                                                            
                                                            <!-- Lista desplegable para el color -->
                                                            <label for='color'>Color:</label>
                                                            <select class='form-select' name='color' required>
                                                                <option value=''>Seleccione un color</option>
                                                                $opcionesColor
                                                            </select><br>

                                                            <!-- Lista desplegable para materiales -->
                                                            <label for='material'>Material:</label>
                                                            <select class='form-select' name='material' required>
                                                                <option value=''>Seleccione un material</option>
                                                                $opcionesMaterial
                                                            </select><br>

                                                            <!-- Lista desplegable para ambientes -->
                                                            <label for='ambiente'>Ambiente:</label>
                                                            <select class='form-select' name='ambiente' required>
                                                                <option value=''>Seleccione un ambiente</option>
                                                                $opcionesAmbiente
                                                            </select><br>

                                                            <!-- Lista desplegable para subcategorias -->
                                                            <label for='subcategoria'>Subcategoria:</label>
                                                            <select class='form-select' name='subcategoria' required>
                                                                <option value=''>Seleccione una subcategoria</option>
                                                                $opcionesSubcategoria
                                                            </select><br>

                                                            </div>
                                                            
                                                        <!-- Formulario de Características para Mesas -->
                                                        <div id='caracteristicasMesa" . $row["id_producto"] . "' style='display: none;'>
                                                            <h6 class='mt-3'>Características de Mesa</h6>

                                                            <!-- Lista desplegable para el color -->
                                                            <label for='color'>Color:</label>
                                                            <select class='form-select' name='color' required>
                                                                <option value=''>Seleccione un color</option>
                                                                $opcionesColor
                                                            </select><br>

                                                            <!-- Lista desplegable para materiales -->
                                                            <label for='material'>Material:</label>
                                                            <select class='form-select' name='material' required>
                                                                <option value=''>Seleccione un material</option>
                                                                $opcionesMaterial
                                                            </select><br>

                                                            <!-- Lista desplegable para ambientes -->
                                                            <label for='ambiente'>Ambiente:</label>
                                                            <select class='form-select' name='ambiente' required>
                                                                <option value=''>Seleccione un ambiente</option>
                                                                $opcionesAmbiente
                                                            </select><br>

                                                            <!-- Lista desplegable para subcategorias -->
                                                            <label for='subcategoria'>Subcategoria:</label>
                                                            <select class='form-select' name='subcategoria' required>
                                                                <option value=''>Seleccione una subcategoria</option>
                                                                $opcionesSubcategoria
                                                            </select><br>

                                                            <!-- Lista desplegable para n_asientos -->
                                                            <label for='n_asientos'>N°Asientos:</label>
                                                            <select class='form-select' name='n_asientos' required>
                                                                <option value=''>Seleccione un numero de asientos</option>
                                                                $opcionesAsiento
                                                            </select><br>

                                                            <!-- Lista desplegable para forma -->
                                                            <label for='forma'>Forma:</label>
                                                            <select class='form-select' name='forma' required>
                                                                <option value=''>Seleccione una forma</option>
                                                                $opcionesForma
                                                            </select><br>

                                                        </div>

                                                        <!-- Formulario de Características para Sillones -->
                                                        <div id='caracteristicasSillon" . $row["id_producto"] . "' style='display: none;'>
                                                            <h6 class='mt-3'>Características de Sillon</h6>

                                                            <!-- Lista desplegable para el color -->
                                                            <label for='color'>Color:</label>
                                                            <select class='form-select' name='color' required>
                                                                <option value=''>Seleccione un color</option>
                                                                $opcionesColor
                                                            </select><br>

                                                            <!-- Lista desplegable para materiales -->
                                                            <label for='material'>Material:</label>
                                                            <select class='form-select' name='material' required>
                                                                <option value=''>Seleccione un material</option>
                                                                $opcionesMaterial
                                                            </select><br>

                                                            <!-- Lista desplegable para ambientes -->
                                                            <label for='ambiente'>Ambiente:</label>
                                                            <select class='form-select' name='ambiente' required>
                                                                <option value=''>Seleccione un ambiente</option>
                                                                $opcionesAmbiente
                                                            </select><br>

                                                            <!-- Lista desplegable para subcategorias -->
                                                            <label for='subcategoria'>Subcategoria:</label>
                                                            <select class='form-select' name='subcategoria' required>
                                                                <option value=''>Seleccione una subcategoria</option>
                                                                $opcionesSubcategoria
                                                            </select><br>


                                                            <!-- Lista desplegable para n_asientos -->
                                                            <label for='n_asientos'>N°Asientos:</label>
                                                            <select class='form-select' name='n_asientos' required>
                                                                <option value=''>Seleccione un numero de asientos</option>
                                                                $opcionesAsiento
                                                            </select><br>

                                                            <!-- Lista desplegable para forma -->
                                                            <label for='forma'>Forma:</label>
                                                            <select class='form-select' name='forma' required>
                                                                <option value=''>Seleccione una forma</option>
                                                                $opcionesForma
                                                            </select><br>

                                                            <!-- Lista desplegable para firmeza -->
                                                            <label for='firmeza'>Firmeza:</label>
                                                            <select class='form-select' name='firmeza' required>
                                                                <option value=''>Seleccione una firmeza</option>
                                                                $opcionesFirmeza
                                                            </select><br>

                                                        </div>

                                                        <!-- Formulario de Características para Camas -->
                                                        <div id='caracteristicasCama" . $row["id_producto"] . "' style='display: none;'>
                                                            <h6 class='mt-3'>Características de Cama</h6>

                                                            <!-- Lista desplegable para el color -->
                                                            <label for='color'>Color:</label>
                                                            <select class='form-select' name='color' required>
                                                                <option value=''>Seleccione un color</option>
                                                                $opcionesColor
                                                            </select><br>

                                                            <!-- Lista desplegable para materiales -->
                                                            <label for='material'>Material:</label>
                                                            <select class='form-select' name='material' required>
                                                                <option value=''>Seleccione un material</option>
                                                                $opcionesMaterial
                                                            </select><br>

                                                            <!-- Lista desplegable para ambientes -->
                                                            <label for='ambiente'>Ambiente:</label>
                                                            <select class='form-select' name='ambiente' required>
                                                                <option value=''>Seleccione un ambiente</option>
                                                                $opcionesAmbiente
                                                            </select><br>

                                                            <!-- Lista desplegable para subcategorias -->
                                                            <label for='subcategoria'>Subcategoria:</label>
                                                            <select class='form-select' name='subcategoria' required>
                                                                <option value=''>Seleccione una subcategoria</option>
                                                                $opcionesSubcategoria
                                                            </select><br>

                                                            <!-- Lista desplegable para n_plazas -->
                                                            <label for='n_plazas'>N°Plazas:</label>
                                                            <select class='form-select' name='n_plazas' required>
                                                                <option value=''>Seleccione un numero de plazas</option>
                                                                $opcionesPlaza
                                                            </select><br>

                                                        </div>

                                                        <!-- Formulario de Características para el otro -->
                                                        <div id='caracteristicasA/O" . $row["id_producto"] . "' style='display: none;'>
                                                            <h6 class='mt-3'>Características de Almacenamiento/organizacion</h6>

                                                            <!-- Lista desplegable para el color -->
                                                            <label for='color'>Color:</label>
                                                            <select class='form-select' name='color' required>
                                                                <option value=''>Seleccione un color</option>
                                                                $opcionesColor
                                                            </select><br>

                                                            <!-- Lista desplegable para materiales -->
                                                            <label for='material'>Material:</label>
                                                            <select class='form-select' name='material' required>
                                                                <option value=''>Seleccione un material</option>
                                                                $opcionesMaterial
                                                            </select><br>

                                                            <!-- Lista desplegable para ambientes -->
                                                            <label for='ambiente'>Ambiente:</label>
                                                            <select class='form-select' name='ambiente' required>
                                                                <option value=''>Seleccione un ambiente</option>
                                                                $opcionesAmbiente
                                                            </select><br>

                                                            <!-- Lista desplegable para subcategorias -->
                                                            <label for='subcategoria'>Subcategoria:</label>
                                                            <select class='form-select' name='subcategoria' required>
                                                                <option value=''>Seleccione una subcategoria</option>
                                                                $opcionesSubcategoria
                                                            </select><br>

                                                            <!-- Lista desplegable para n_cajones -->
                                                            <label for='n_cajones'>N°Cajones:</label>
                                                            <select class='form-select' name='n_cajones' required>
                                                                <option value=''>Seleccione un numero de cajones</option>
                                                                $opcionesCajon
                                                            </select><br>

                                                        </div> 
                                                            
                                                        <button type='submit' class='btn btn-primary mt-3'>Guardar Características</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                            }
                            echo "</tbody></table>";
                        } else {
                            echo "<p class='text-center'>No hay productos registrados.</p>";
                        }
                    } else {
                        echo "<p class='text-danger'>Error en la consulta: " . $conn->error . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="agregarProductoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarProductoModalLabel">Agregar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="insertar_producto.php" method="POST" enctype="multipart/form-data">
                        Nombre del Producto: <input class="form-control" type="text" name="nombre_producto"
                            id="nombre_producto" required><br>
                        Precio Unitario: <input class="form-control" type="number" name="precio_unitario"
                            id="precio_unitario" required><br>
                        Descripción: <textarea class="form-control" name="descripcion_producto"
                            id="descripcion_producto" required></textarea><br>
                        Imagen (Tipos de archivo aceptados: .gif .jpeg .jpg .png): <input class="form-control"
                            type="file" name="foto_producto" id="foto_producto" accept="image/*" required><br>
                        <button type="submit" class="btn btn-primary">Guardar Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modificarProductoStockModal" tabindex="-1"
        aria-labelledby="modificarProductoStockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modificarProductoStockModalLabel">Agregar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="actualizar_stock.php" method="POST">
                        <div class="mb-3">
                            <label for="id_producto" class="form-label">Selecciona el producto</label>
                            <select class="form-select" name="id_producto" required>
                                <option value="" disabled selected>Selecciona un producto</option>
                                <?php
                                echo $opcionesProducto;
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                        </div>
                        <div class="mb-3">
                            <label for="motivo" class="form-label">Motivo</label>
                            <select class="form-select" id="motivo" name="motivo" required>
                                <option value="" disabled selected>Seleccione el motivo</option>
                                <option value="Ingreso">Ingreso</option>
                                <option value="Salida">Salida</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="explicacion" class="form-label">Explicación</label>
                            <textarea class="form-control" id="explicacion" name="explicacion" rows="3"
                                required></textarea>
                        </div>
                        <button type="submit" class='btn btn-primary'>Guardar Cambio de Stock</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function mostrarCaracteristicas(idProducto) {
            const tipoProducto = document.getElementById('tipoProducto' + idProducto).value;
            const formularios = ['caracteristicasSilla', 'caracteristicasMesa', 'caracteristicasSillon', 'caracteristicasCama', 'caracteristicasA/O'];
            const valores = ['5', '6', '7', '8', '9'];
            formularios.forEach(form => {
                const elemento = document.getElementById(form + idProducto);
                if (elemento) {
                    elemento.style.display = 'none';
                    Array.from(elemento.querySelectorAll("[required]")).forEach(input => {
                        input.disabled = true;
                    });
                }
            });

            const index = valores.indexOf(tipoProducto);
            if (index !== -1) {
                const formSeleccionado = document.getElementById(formularios[index] + idProducto);
                if (formSeleccionado) {
                    formSeleccionado.style.display = 'block';
                    Array.from(formSeleccionado.querySelectorAll("select")).forEach(input => {
                        input.disabled = false;
                        input.setAttribute("required", "required");
                    });
                }
            }
        }
    </script>
</body>

</html>