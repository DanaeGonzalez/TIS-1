const nombresFiltros = {
    categoria: {
        5: "Silla",
        6: "Mesa",
        7: "Sillón",
        8: "Cama",
        9: "Almacenamiento y organización"
    },
    // Otros filtros...
};

//------------------------------------------------------------------------------------------------------------------------

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

// Agregar evento de cambio a los filtros
document.addEventListener("change", event => {
    if (event.target.closest("#form-filtros")) {
        filtrarProductos();
    }
});

//------------------------------------------------------------------------------------------------------------------------

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

//------------------------------------------------------------------------------------------------------------------------

function cargarFiltrosPorCategoria(idCategoria) {
    console.log("Cargando filtros para la categoría:", idCategoria); // Depuración
    const filtrosContainer = document.getElementById("form-filtros");

    if (!filtrosContainer) {
        console.error("Contenedor de filtros no encontrado.");
        return;
    }

    filtrosContainer.innerHTML = "<p>Cargando filtros...</p>";

    fetch(`../assets/php/cargar_filtros.php?id_categoria=${idCategoria}`)
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al cargar los filtros.");
            }
            return response.text(); // Recibe HTML de los nuevos filtros
        })
        .then(html => {
            //console.log("HTML recibido:", html); // Depuración
            filtrosContainer.innerHTML = html;

            // Inicializar dropdowns de Bootstrap
            const dropdowns = document.querySelectorAll('.dropdown-toggle');
            dropdowns.forEach(dropdown => {
                new bootstrap.Dropdown(dropdown);
            });
        })
        .catch(error => {
            console.error("Error al cargar los filtros:", error);
            filtrosContainer.innerHTML = "<p>Error al cargar los filtros. Intenta nuevamente.</p>";
        });
}

//------------------------------------------------------------------------------------------------------------------------

function cargarFiltrosYProductosPorCategoria(idCategoria) {
    cargarFiltrosPorCategoria(idCategoria); // Llama a la función existente para cargar los filtros

    const productContainer = document.getElementById("product-container");

    if (!productContainer) {
        console.error("Contenedor de productos no encontrado.");
        return;
    }

    // Mostrar un mensaje de carga mientras se obtienen los productos
    productContainer.innerHTML = "<p>Cargando productos...</p>";

    // Realizar la llamada para filtrar productos por categoría
    fetch(`../assets/php/filtros_catalogo.php`, {
        method: "POST",
        body: new URLSearchParams({ categoria: idCategoria }),
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al cargar los productos.");
            }
            return response.text(); // Recibe el HTML de los productos
        })
        .then(html => {
            productContainer.innerHTML = html; // Actualiza el contenedor con los productos filtrados
            cargarEstrellasDinamicamente(); // Llamar la función para cargar estrellas
        })
        .catch(error => {
            console.error("Error al cargar los productos:", error);
            productContainer.innerHTML = "<p>Error al cargar los productos. Intenta nuevamente.</p>";
        });
}

//------------------------------------------------------------------------------------------------------------------------

function seleccionarCategoria(idCategoria) {
    console.log("Seleccionando categoría:", idCategoria);

    fetch('../assets/php/seleccionar_categoria.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `id_categoria=${idCategoria}`
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);

        // Recargar filtros y productos con la nueva categoría
        cargarFiltrosYProductosPorCategoria(idCategoria);

        // Crear etiqueta para la categoría
        const appliedFilters = document.getElementById("applied-filters");

        // Limpia cualquier etiqueta de categoría anterior
        const categoriaTag = appliedFilters.querySelector("[data-filter='categoria']");
        if (categoriaTag) categoriaTag.remove();

        const nombreCategoria = nombresFiltros.categoria[idCategoria] || "Categoría desconocida";

        const tag = document.createElement("span");
        tag.className = "badge bg-primary p-2 d-flex align-items-center";
        tag.setAttribute("data-filter", "categoria");
        tag.setAttribute("data-id", idCategoria);

        tag.innerHTML = `
            Categoría: ${nombreCategoria}
            <button type="button" class="btn-close ms-2" aria-label="Eliminar"></button>
        `;

        // Evento para eliminar la categoría seleccionada
        tag.querySelector(".btn-close").addEventListener("click", () => {
            eliminarCategoria();
        });

        appliedFilters.appendChild(tag);
    })
    .catch(error => {
        console.error("Error al seleccionar la categoría:", error);
    });
}

//------------------------------------------------------------------------------------------------------------------------

function cargarEstrellasDinamicamente() {
    const productContainers = document.querySelectorAll('[id^="stars-container-"]');
    productContainers.forEach(container => {
        const idProducto = container.id.split('-')[2]; // Obtener el ID del producto
        cargarEstrellas(idProducto);
    });
}

//------------------------------------------------------------------------------------------------------------------------

function actualizarEtiquetasFiltros(formData) {
    const appliedFilters = document.getElementById("applied-filters");

    if (!appliedFilters) {
        console.error("Contenedor de etiquetas de filtros no encontrado.");
        return;
    }

    // Mantener la etiqueta de categoría si existe
    const categoriaTag = document.querySelector("[data-filter='categoria']");
    const categoriaEtiquetaHTML = categoriaTag ? categoriaTag.outerHTML : null;

    // Limpia las etiquetas excepto la de categoría
    appliedFilters.innerHTML = categoriaEtiquetaHTML || "";

    // Regenerar evento para eliminar categoría
    if (categoriaTag) {
        const closeButton = categoriaTag.querySelector(".btn-close");
        if (closeButton) {
            closeButton.addEventListener("click", eliminarCategoria);
        }
    }

    // Generar etiquetas para otros filtros
    formData.forEach((value, key) => {
        if (key === "categoria") return; // Ignorar categoría, ya está manejada

        const tag = document.createElement("span");
        tag.className = "badge bg-secondary p-2 d-flex align-items-center";
        tag.innerHTML = `
            ${key}: ${nombresFiltros[key]?.[value] || value}
            <button type="button" class="btn-close ms-2" aria-label="Eliminar"></button>
        `;

        // Evento para eliminar el filtro asociado
        tag.querySelector(".btn-close").addEventListener("click", () => {
            eliminarFiltro(key, value);
        });

        appliedFilters.appendChild(tag);
    });
}

//------------------------------------------------------------------------------------------------------------------------

function eliminarFiltro(key, value) {
    const form = document.getElementById("form-filtros");

    if (!form) {
        console.error("Formulario no encontrado.");
        return;
    }

    // Actualizar el formulario eliminando el filtro
    const elements = form.querySelectorAll(`[name="${key}"]`);
    elements.forEach(element => {
        if (element.type === "checkbox" && element.value === value) {
            element.checked = false; // Deseleccionar
        }
    });

    // Reaplicar los filtros sin el filtro eliminado
    filtrarProductos();
}

//------------------------------------------------------------------------------------------------------------------------

function filtrarProductos() {
    const form = document.getElementById("form-filtros");
    const productContainer = document.getElementById("product-container");

    if (!form || !productContainer) {
        console.error("Formulario o contenedor de productos no encontrado.");
        return;
    }

    const formData = new FormData(form);

    // Agregar categoría si existe
    const categoriaTag = document.querySelector("[data-filter='categoria']");
    if (categoriaTag) {
        const categoriaId = categoriaTag.getAttribute("data-id");
        if (categoriaId) {
            formData.append("categoria", categoriaId);
        }
    } else {
        formData.delete("categoria"); // Asegurar que la categoría no esté presente
    }

    // Actualizar etiquetas de filtros aplicados
    actualizarEtiquetasFiltros(formData);

    console.log("Filtros enviados:");
    formData.forEach((value, key) => {
        console.log(`${key}: ${value}`);
    });

    productContainer.innerHTML = "<p>Cargando productos...</p>";

    fetch(`../assets/php/filtros_catalogo.php`, {
        method: "POST",
        body: formData,
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al filtrar los productos.");
            }
            return response.text();
        })
        .then(html => {
            productContainer.innerHTML = html;
            cargarEstrellasDinamicamente(); // Asegura que las estrellas se carguen
        })
        .catch(error => {
            console.error("Error al filtrar los productos:", error);
            productContainer.innerHTML = "<p>Error al cargar los productos. Intenta nuevamente.</p>";
        });
}

//------------------------------------------------------------------------------------------------------------------------

function eliminarCategoria() {
    console.log("Eliminando categoría...");

    fetch('../assets/php/seleccionar_categoria.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id_categoria=' // Vacía la categoría
    })
    .then(response => response.text())
    .then(data => {
        console.log("Categoría eliminada:", data);

        // Eliminar etiqueta de categoría
        const categoriaTag = document.querySelector("[data-filter='categoria']");
        if (categoriaTag) categoriaTag.remove();

        // Recargar filtros para permitir elegir una nueva categoría
        const filtrosContainer = document.getElementById("form-filtros");
        if (filtrosContainer) {
            filtrosContainer.innerHTML = `
                <div class="dropdown d-flex justify-content-center mt-3">
                    <button class="btn btn-light border dropdown-toggle rounded-pill" type="button" id="dropdownCategory" data-bs-toggle="dropdown" aria-expanded="false">
                        Selecciona una categoría
                    </button>
                    <div class="dropdown-menu p-2" aria-labelledby="dropdownCategory">
                        ${Object.entries(nombresFiltros.categoria).map(([id, nombre]) => `
                            <button class="dropdown-item" onclick="seleccionarCategoria(${id})">${nombre}</button>
                        `).join('')}
                    </div>
                </div>
            `;
        }

        // Recargar productos sin categoría seleccionada
        filtrarProductos();
    })
    .catch(error => {
        console.error("Error al eliminar la categoría:", error);
    });
}

function cambiarPagina(pagina) {
    const form = document.getElementById("form-filtros");
    const productContainer = document.getElementById("product-container");

    if (!form || !productContainer) {
        console.error("Formulario o contenedor de productos no encontrado.");
        return;
    }

    const formData = new FormData(form);
    formData.append("pagina", pagina); // Añadir el número de página

    console.log("Filtros enviados:");
    formData.forEach((value, key) => {
        console.log(`${key}: ${value}`);
    });

    productContainer.innerHTML = "<p>Cargando productos...</p>";

    fetch(`../assets/php/filtros_catalogo.php`, {
        method: "POST",
        body: formData,
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Error al cargar los productos.");
            }
            return response.text();
        })
        .then(html => {
            productContainer.innerHTML = html;
            cargarEstrellasDinamicamente(); // Cargar las estrellas
        })
        .catch(error => {
            console.error("Error al cargar los productos:", error);
            productContainer.innerHTML = "<p>Error al cargar los productos. Intenta nuevamente.</p>";
        });
}





