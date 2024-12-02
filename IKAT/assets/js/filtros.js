function buscarProductos() {
    const buscarInput = document.getElementById('buscarInputMain');
    const productContainer = document.getElementById("product-container");

    if (!buscarInput) {
        console.error("Campo de búsqueda no encontrado.");
        return;
    }

    const realizarBusqueda = () => {
        const buscar = buscarInput.value.trim();

        if (!buscar) {
            console.warn("No se ingresó ningún término de búsqueda.");
            return;
        }

        // Mostrar un mensaje de carga mientras se obtienen los datos
        productContainer.innerHTML = "<p>Buscando productos...</p>";

        fetch(`../assets/php/busqueda_catalogo.php?buscar=${encodeURIComponent(buscar)}`)
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text(); // Recibimos HTML directamente
            })
            .then((html) => {
                productContainer.innerHTML = html; // Reemplazar contenido del contenedor con el HTML recibido
                
                // Cargar las estrellas dinámicamente después de renderizar las cartas
                const productContainers = document.querySelectorAll('[id^="stars-container-"]');
                productContainers.forEach(container => {
                    const idProducto = container.id.split('-')[2]; // Obtener el ID del producto
                    cargarEstrellas(idProducto);
                });
            })
            .catch((error) => {
                productContainer.innerHTML = "<p>Error al realizar la búsqueda. Intenta nuevamente.</p>";
                console.error('Error en la búsqueda:', error);
            });
    };

    // Evento al presionar Enter
    buscarInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault(); // Evitar el envío automático del formulario
            realizarBusqueda();
        }
    });

    // Evento al hacer clic en el botón de búsqueda
    const buscarButton = document.getElementById('buscarButton');
    if (buscarButton) {
        buscarButton.addEventListener('click', realizarBusqueda);
    }
}




function filtrarProductos() {
    const form = document.getElementById("form-filtros");

    if (!form) {
        console.error("Formulario de filtros no encontrado.");
        return;
    }

    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(form);
        const queryString = new URLSearchParams(formData).toString();
        const productContainer = document.getElementById("product-container");

        // Mostrar un mensaje de carga mientras se obtienen los datos
        productContainer.innerHTML = "<p>Filtrando productos...</p>";

        fetch(`../assets/php/filtros_catalogo.php?${queryString}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error en la respuesta del servidor");
                }
                return response.text(); // Recibe HTML directamente
            })
            .then(html => {
                productContainer.innerHTML = html; // Inserta el HTML recibido en el contenedor
            })
            .catch(error => {
                productContainer.innerHTML = "<p>Error al filtrar los productos. Intenta nuevamente.</p>";
                console.error('Error al filtrar:', error);
            });
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
            listaResultados.innerHTML = '<li class="list-group-item text-muted">Buscando...</li>'; // Mostrar un mensaje temporal
            listaResultados.classList.remove('d-none'); // Asegurar que la lista sea visible
        }

        fetch(`../assets/php/barra_busqueda.php?buscar=${encodeURIComponent(buscar)}`)
            .then(response => response.json())
            .then(data => {
                listaResultados.innerHTML = ''; // Limpia resultados previos

                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(producto => {
                        const item = document.createElement('li');
                        item.classList.add('list-group-item', 'sugerencia-item');
                        item.innerHTML = `
                            <a href="producto.php?id=${producto.id_producto}" class="d-flex align-items-center" style="text-decoration: none;">
                                <img src="${producto.foto_producto}" alt="${producto.nombre_producto}" class="sugerencia-img me-2">
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



