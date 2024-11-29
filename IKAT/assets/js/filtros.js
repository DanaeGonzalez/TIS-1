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
    fetch(`../assets/php/barra_busqueda.php?buscar=${encodeURIComponent(buscar)}`)
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
                                <div class="card d-flex flex-column h-100">
                                    <a href="producto.php?id=${producto.id_producto}" class="text-decoration-none">
                                        <div class="card-img-container d-flex justify-content-center align-items-center">
                                            <img src="${producto.foto_producto}" class="card-img-top img-fluid h-100" alt="${producto.nombre_producto}" style="object-fit: cover; width: 100%; height: auto;" 
                                                 id="product-image-${producto.id_producto}">
                                        </div>
                                    </a>
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title text-truncate">${producto.nombre_producto}</h5>
                                        <h6 class="card-text">$${new Intl.NumberFormat().format(producto.precio_unitario)}</h6>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <button type="button" class="btn btn-secondary carrito-btn"
                                                    ${!usuarioAutenticado ? 'disabled' : ''}
                                                    onclick="agregarAlCarrito(${producto.id_producto})">
                                                    <i class="bi bi-cart-plus"></i>
                                                </button>

                                                <button type="button" class="btn btn-secondary lista-deseos-btn"
                                                    ${!usuarioAutenticado ? 'disabled' : ''}
                                                    onclick="agregarAListaDeDeseos(${producto.id_producto})">
                                                    <i class="bi bi-heart"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                }
            })
    });
}

function barraBusqueda() {
    const buscarInputMain = document.getElementById('buscarInputMain');
    const listaResultados = document.getElementById('lista');

    if (!buscarInputMain || !listaResultados) {
        console.error("Elementos de búsqueda no encontrados.");
        return;
    }

    // Función para mostrar resultados
    function realizarBusqueda(buscar = '') {
        if (listaResultados) {
            listaResultados.innerHTML = 'Buscando...'; // Mostrar un mensaje temporal
            listaResultados.classList.remove('d-none'); // Asegurar que la lista sea visible
        }

        fetch(`../assets/php/barra_busqueda.php?buscar=${encodeURIComponent(buscar)}`)
            .then(response => response.json())
            .then(data => {
                listaResultados.innerHTML = ''; // Limpia resultados previos

                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(producto => {
                        const rutaAjustada = producto.foto_producto.replace("../../", "../");
                        const item = document.createElement('li');
                        item.classList.add('list-group-item', 'sugerencia-item');
                        item.innerHTML = `
                            <a href="producto.php?id=${producto.id_producto}" class="d-flex align-items-center" style="text-decoration: none;">
                                <img src="${rutaAjustada}" alt="${producto.nombre_producto}" class="sugerencia-img me-2">
                                <span>${producto.nombre_producto}</span>
                            </a>`;
                        listaResultados.appendChild(item);
                    });
                } else {
                    listaResultados.innerHTML = '<li class="list-group-item text-muted">No se encontraron productos.</li>';
                }

                listaResultados.classList.remove('d-none');
            })
            .catch(error => {
                console.error('Error en la búsqueda:', error);
                listaResultados.innerHTML = '<li class="list-group-item text-danger">Error al cargar los productos.</li>';
            });
    }

    // Evento al enfocar el input
    buscarInputMain.addEventListener('focus', () => realizarBusqueda());

    // Evento al escribir en el input
    buscarInputMain.addEventListener('input', () => {
        const buscar = buscarInputMain.value;
        realizarBusqueda(buscar);
    });

    // Evento ocultar resultados al hacer clic fuera
    document.addEventListener('click', (event) => {
        if (!listaResultados.contains(event.target) && !buscarInputMain.contains(event.target)) {
            listaResultados.classList.add('d-none');
        }
    });

    // Evento ocultar resultados al presionar "Escape"
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            listaResultados.classList.add('d-none');
        }
    });
}


