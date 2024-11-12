function buscarProductos() {
    // Intentar capturar el input del modal o de la barra principal
    const buscarInputModal = document.getElementById('buscarInputModal');
    const buscarInputMain = document.getElementById('buscarInputMain');

    // Determinar cuál input usar en base a su disponibilidad
    const buscarInput = buscarInputModal && buscarInputModal.value ? buscarInputModal : buscarInputMain;

    // Verificar si el campo de entrada fue encontrado
    if (!buscarInput) {
        console.error("Campo de búsqueda no encontrado.");
        return false;
    }

    const buscar = buscarInput.value; // Obtener el valor del input
    console.log("Valor de búsqueda:", buscar); // Mensaje de depuración

    const resultadosDiv = document.getElementById('resultadosBusqueda');
    if (resultadosDiv) {
        resultadosDiv.innerHTML = 'Buscando...';
    }

    const productContainer = document.getElementById("product-container");
    productContainer.innerHTML = ""; // Limpia solo el área de productos, manteniendo la barra de filtros

    // Hacer la solicitud fetch
    fetch(`../assets/php/busqueda_catalogo.php?buscar=${encodeURIComponent(buscar)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            console.log("Datos recibidos:", data); // Mensaje de depuración

            if (resultadosDiv) {
                resultadosDiv.innerHTML = ''; // Limpiar los resultados previos
            }

            if (Array.isArray(data) && data.length > 0) {
                data.forEach(producto => {
                    const item = document.createElement('div');
                    item.classList.add('producto-item');
                    productContainer.innerHTML += `
                       <div class="col-6 col-md-4 mb-4">
                           <a href="producto.php?id=${producto.id_producto}" class="text-decoration-none">
                               <div class="card" style="width: 100%;">
                                   <img src="${producto.foto_producto}" class="card-img-top" alt="${producto.nombre_producto}">
                                   <div class="card-body">
                                       <h5 class="card-title">${producto.nombre_producto}</h5>
                                       <h6 class="card-text">$${new Intl.NumberFormat().format(producto.precio_unitario)}</h6>
                                       <div class="d-flex align-items-center">
                                           <div>
                                               <button type="button" class="btn btn-outline-secondary">
                                                   <i class="bi bi-cart-plus"></i>
                                               </button>
                                               <button type="button" class="btn btn-outline-secondary">
                                                   <i class="bi bi-heart"></i>
                                               </button>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </a>
                       </div>`;
                    resultadosDiv.appendChild(item);
                });
            } else {
                if (resultadosDiv) {
                    resultadosDiv.innerHTML = '<p style="color: #555; font-size: 16px;">No se encontraron productos.</p>';
                }
            }
        })
        .catch(error => {
            if (resultadosDiv) {
                resultadosDiv.innerHTML = '<p style="color: red; font-size: 16px;">Error en la búsqueda. Intenta nuevamente.</p>';
            }
            console.error('Error en la búsqueda:', error);
        });

    return false; // Evita el envío del formulario
}

function filtrarProductos() {
    document.getElementById("form-filtros").addEventListener("submit", function (event) {
        event.preventDefault(); // Evita el envío tradicional del formulario

        const formData = new FormData(this);
        const queryString = new URLSearchParams(formData).toString();

        fetch(`../assets/php/filtros_catalogo.php?${queryString}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error en la respuesta del servidor");
                }
                return response.json();
            })
            .then(data => {
                // Selecciona solo el contenedor de los productos
                const productContainer = document.getElementById("product-container");
                productContainer.innerHTML = ""; // Limpia solo el área de productos, manteniendo la barra de filtros

                if (data.length === 0) {
                    productContainer.innerHTML = "<p>No se encontraron productos.</p>";
                } else {
                    data.forEach(producto => {
                        productContainer.innerHTML += `
                           <div class="col-6 col-md-4 mb-4">
                               <a href="producto.php?id=${producto.id_producto}" class="text-decoration-none">
                                   <div class="card" style="width: 100%;">
                                       <img src="${producto.foto_producto}" class="card-img-top" alt="${producto.nombre_producto}">
                                       <div class="card-body">
                                           <h5 class="card-title">${producto.nombre_producto}</h5>
                                           <h6 class="card-text">$${new Intl.NumberFormat().format(producto.precio_unitario)}</h6>
                                           <div class="d-flex align-items-center">
                                               <div>
                                                   <button type="button" class="btn btn-outline-secondary">
                                                       <i class="bi bi-cart-plus"></i>
                                                   </button>
                                                   <button type="button" class="btn btn-outline-secondary">
                                                       <i class="bi bi-heart"></i>
                                                   </button>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </a>
                           </div>`;
                    });
                }
            })
    });
}