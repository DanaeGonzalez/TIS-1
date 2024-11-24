<!-- sidebar.php -->
<div id="sidebar" class="collapse show d-lg-block bg-light" style="width: 250px;">
    <div class="accordion" id="accordionSidebar">
        <!-- Botón Básico -->
        <div class="accordion-item">
            <h4 class="accordion-header" id="headingBasico">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#basicoLinks" aria-expanded="false" aria-controls="basicoLinks">
                    Básico
                </button>
            </h4>
            <div id="basicoLinks" class="accordion-collapse collapse" aria-labelledby="headingBasico" data-bs-parent="#accordionSidebar">
                <div class="accordion-body p-0">
                    <ul class="list-unstyled">
                        <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_ambientes/mostrar_ambiente.php" class="sidebar-link d-block py-2 px-3">Ambientes</a></li>    
                        <li><a href="/xampp/TIS-1/IKAT/mantenedores/categoria/mostrar_categoria.php" class="sidebar-link d-block py-2 px-3">Categorías</a></li>
                        <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_colores/mostrar_color.php" class="sidebar-link d-block py-2 px-3">Colores</a></li>
                        <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_firmezas/mostrar_firmeza.php" class="sidebar-link d-block py-2 px-3">Firmeza</a></li>
                        <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_materiales/mostrar_material.php" class="sidebar-link d-block py-2 px-3">Materiales</a></li>
                        <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_metodo_pago/mostrar_metodo_pago.php" class="sidebar-link d-block py-2 px-3">Métodos de Pago</a></li>
                        <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_n_asientos/mostrar_n_asientos.php" class="sidebar-link d-block py-2 px-3">N° Asientos</a></li>
                        <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_n_cajones/mostrar_n_cajones.php" class="sidebar-link d-block py-2 px-3">N° Cajones</a></li>
                        <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_n_plazas/mostrar_n_plazas.php" class="sidebar-link d-block py-2 px-3">N° Plazas</a></li>
                        <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_subcategorias/mostrar_subcategoria.php" class="sidebar-link d-block py-2 px-3">Subcategorías</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Botón Producto -->
        <div class="accordion-item">
            <h4 class="accordion-header" id="headingProducto">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#productoLinks" aria-expanded="false" aria-controls="productoLinks">
                    Producto
                </button>
            </h4>
            <div id="productoLinks" class="accordion-collapse collapse" aria-labelledby="headingProducto" data-bs-parent="#accordionSidebar">
                <div class="accordion-body p-0">
                    <ul class="list-unstyled">
                        <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_producto/mostrar_producto.php" class="sidebar-link d-block py-2 px-3">Productos</a></li>
                        <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_reseña/mostrar_resenia.php" class="sidebar-link d-block py-2 px-3">Reseñas</a></li>
                        <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_top_ventas/mostrar_top_ventas.php" class="sidebar-link d-block py-2 px-3">Ventas</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Botón Usuario -->
        <?php if ($_SESSION['tipo_usuario'] == 'Superadmin'): ?>
        <div class="accordion-item">
            <h4 class="accordion-header" id="headingUsuario">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#usuarioLinks" aria-expanded="false" aria-controls="usuarioLinks">
                    Usuario
                </button>
            </h4>
            <div id="usuarioLinks" class="accordion-collapse collapse" aria-labelledby="headingUsuario" data-bs-parent="#accordionSidebar">
                <div class="accordion-body p-0">
                    <ul class="list-unstyled">
                        
                            <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_compra/mostrar_compra.php" class="sidebar-link d-block py-2 px-3">Compras</a></li>
                            <li><a href="/xampp/TIS-1/IKAT/mantenedores/Mantenedor_usuario/mostrar_usuario.php" class="sidebar-link d-block py-2 px-3">Usuarios</a></li>
                        
                    </ul>
                </div>
            </div>
        </div><?php endif; ?>
    </div>
</div>
