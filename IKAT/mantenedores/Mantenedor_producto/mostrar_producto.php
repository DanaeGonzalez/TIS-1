    <?php
    include '../../config/conexion.php';
    session_start();

    $mensaje = isset($_SESSION['mensaje']) ? $_SESSION['mensaje'] : '';
    unset($_SESSION['mensaje']);

    $sqlCategorias = "SELECT * FROM categoria";
    $resultCategorias = $conn->query($sqlCategorias);

    $categorias = [];
    if ($resultCategorias->num_rows > 0) {
        while($rowCategoria = $resultCategorias->fetch_assoc()) {
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
        while($rowColor = $resultColores->fetch_assoc()) {
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
        while($rowMaterial = $resultMateriales->fetch_assoc()) {
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
        while($rowAmbiente = $resultAmbientes->fetch_assoc()) {
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
        while($rowSubcategoria = $resultSubcategorias->fetch_assoc()) {
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
    
    
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mantenedor de Productos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../menu/styles.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="btn btn-outline border d-lg-none" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
            <span class="navbar-toggler-icon"></span>
            </button>
            <img width="180px" height="auto" src="../ikat.png" alt="">

            <button class="navbar-toggler border" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://as2.ftcdn.net/v2/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg" 
                                alt="User Image" class="user-avatar me-2"> 
                            Usuario
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Configuraciones</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="d-flex">
            <div id="sidebar" class="collapse d-lg-block">
                <div class="accordion" id="accordionSidebar">
                    <div class="accordion-item">
                        <h4 class="accordion-header" id="headingMantenedores">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#mantenedoresLinks" aria-expanded="true" aria-controls="mantenedoresLinks">
                                Mantenedores
                            </button>
                        </h4>
                        <div id="mantenedoresLinks" class="accordion-collapse collapse show" aria-labelledby="headingMantenedores"
                            data-bs-parent="#accordionSidebar">
                            <div class="accordion-body p-0">
                            <a href="../categoria/mostrar_categoria.php" class="sidebar-link">Categorías</a>
                            <a href="../Mantenedor_subcategorias/mostrar_subcategoria.php" class="sidebar-link">Subcategorías</a>
                            <a href="../Mantenedor_metodo_pago/mostrar_metodo_pago.php" class="sidebar-link">Métodos de pago</a>
                            <a href="../Mantenedor_producto/mostrar_producto.php" class="sidebar-link">Productos</a>
                            <a href="../Mantenedor_reseña/mostrar_resenia.php" class="sidebar-link">Reseñas</a>
                            <a href="../Mantenedor_top_ventas/mostrar_top_ventas.php" class="sidebar-link">Ventas</a>
                            <a href="../Mantenedor_usuario/mostrar_usuario.php" class="sidebar-link">Usuarios</a>
                            <a href="../Mantenedor_n_asientos/mostrar_n_asientos.php" class="sidebar-link">N°Asientos</a>
                            <a href="../Mantenedor_n_cajones/mostrar_n_cajones.php" class="sidebar-link">N°Cajones</a>
                            <a href="../Mantenedor_n_plazas/mostrar_n_plazas.php" class="sidebar-link">N°Plazas</a>
                            <a href="../Mantenedor_colores/mostrar_color.php" class="sidebar-link">Colores</a>
                            <a href="../Mantenedor_firmezas/mostrar_firmeza.php" class="sidebar-link">Firmeza</a>
                            <a href="../Mantenedor_materiales/mostrar_material.php" class="sidebar-link">Materiales</a>
                            <a href="../Mantenedor_ambientes/mostrar_ambiente.php" class="sidebar-link">Ambientes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-area flex-grow-1 p-5 col-4 col-md-10">

            <?php if ($mensaje): ?>
                <div class="alert alert-info alert-dismissible fade show text-center" role="alert">
                    <?php echo $mensaje; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

                <h1 class="text-center p-4">Mantenedor de Productos</h1>

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
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td>" . $row["id_producto"] . "</td>
                                            <td>" . $row["nombre_producto"] . "</td>
                                            <td>" . $row["precio_unitario"] . "</td>
                                            <td>" . $row["stock_producto"] . "</td>
                                            <td>" . $row["descripcion_producto"] . "</td>
                                            <td><img src='" . $row["foto_producto"] . "' alt='Foto del producto' width='50'></td>
                                            <td>" . $row["cantidad_vendida"] . "</td>
                                            <td>" . ($row["top_venta"] ? "Sí" : "No") . "</td>
                                            <td>" . ($row["activo"] ? "Sí" : "No") . "</td>
                                            <td>
                                                <a class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editarProductoModal" . $row["id_producto"] . "'>Editar</a> |
                                                <a class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#agregarCaracteristicasModal" . $row["id_producto"] . "'>Agregar Características</a> |
                                                <a href='borrar_producto.php?id=" . $row["id_producto"] . "' class='btn btn-danger btn-sm'>Borrar</a>
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
                                echo "<a class='btn btn-primary mt-3 d-block' data-bs-toggle='modal' data-bs-target='#agregarProductoModal'>Agregar Producto</a>";
                                echo "<a href='../Mantenedor_stock/modificar_stock_producto.php' class='btn btn-primary mt-3 d-block'>Mantenedor Stock</a>";
                                echo "<a href='../Mantenedor_ofertas/mostrar_ofertas.php' class='btn btn-primary mt-3 d-block'>Mantenedor Ofertas</a>";
                            } else {
                                echo "<p class='text-center'>No hay productos registrados.</p>";
                                echo "<a class='btn btn-primary mt-3 d-block' data-bs-toggle='modal' data-bs-target='#agregarProductoModal'>Agregar Producto</a>";
                            }
                        } else {
                            echo "<p class='text-danger'>Error en la consulta: " . $conn->error . "</p>";
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="agregarProductoModalLabel">Agregar Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="insertar_producto.php" method="post">
                            Nombre del Producto: <input class="form-control" type="text" name="nombre_producto" required><br>

                            Precio Unitario: <input class="form-control" type="number" name="precio_unitario" required><br>

                            Descripción: <textarea class="form-control" name="descripcion_producto" required></textarea><br>

                            Foto (URL): <input class="form-control" type="text" name="foto_producto" required><br>

                            <button type="submit" class="btn btn-primary">Guardar Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Función para mostrar las características específicas de cada producto
            function mostrarCaracteristicas(idProducto) {
                const tipoProducto = document.getElementById('tipoProducto' + idProducto).value;
            
                document.getElementById('caracteristicasSilla' + idProducto).style.display = tipoProducto === '5' ? 'block' : 'none';
                document.getElementById('caracteristicasMesa' + idProducto).style.display = tipoProducto === '6' ? 'block' : 'none';
                document.getElementById('caracteristicasSillon' + idProducto).style.display = tipoProducto === '7' ? 'block' : 'none';
                document.getElementById('caracteristicasCama' + idProducto).style.display = tipoProducto === '8' ? 'block' : 'none';
                document.getElementById('caracteristicasA/O' + idProducto).style.display = tipoProducto === '9' ? 'block' : 'none';
            }
        </script>



    </body>
    </html>


