function barraBusquedaIndex() {
    const buscarInputIndex = document.getElementById('buscarInputIndex');
    const listaResultadosIndex = document.getElementById('listaIndex');

    if (!buscarInputIndex || !listaResultadosIndex) {
        console.error("Elementos de búsqueda del índice no encontrados.");
        return;
    }

    // Función para realizar la búsqueda
    function realizarBusquedaIndex(buscar = '') {
        if (listaResultadosIndex) {
            listaResultadosIndex.innerHTML = '<li class="list-group-item text-muted">Buscando...</li>';
            listaResultadosIndex.classList.remove('d-none');
        }

        fetch(`../../assets/php/barra_busqueda.php?buscar=${encodeURIComponent(buscar)}`)
            .then(response => response.json())
            .then(data => {
                listaResultadosIndex.innerHTML = '';

                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(producto => {
                        const item = document.createElement('li');
                        const rutaAjustada = producto.foto_producto;
                        item.classList.add('list-group-item', 'sugerencia-item');
                        item.innerHTML = `
                            <a href="../producto.php?id=${producto.id_producto}" class="d-flex align-items-center" style="text-decoration: none;">
                                <img src="${rutaAjustada}" alt="${producto.nombre_producto}" class="sugerencia-img me-2">
                                <span>${producto.nombre_producto}</span>
                            </a>`;
                        listaResultadosIndex.appendChild(item);
                    });
                } else {
                    listaResultadosIndex.innerHTML = '<li class="list-group-item text-muted">No se encontraron productos.</li>';
                }
            })
            .catch(error => {
                console.error('Error en la búsqueda:', error);
                listaResultadosIndex.innerHTML = '<li class="list-group-item text-danger">Error al cargar los productos.</li>';
            });
    }

    buscarInputIndex.addEventListener('input', () => realizarBusquedaIndex(buscarInputIndex.value));

    document.addEventListener('click', (event) => {
        if (!listaResultadosIndex.contains(event.target) && !buscarInputIndex.contains(event.target)) {
            listaResultadosIndex.classList.add('d-none');
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            listaResultadosIndex.classList.add('d-none');
        }
    });
}

function buscarProductosIndex() {
    const buscarInputIndex = document.getElementById('buscarInputIndex');

    if (!buscarInputIndex) {
        console.error("No se encontró el campo de búsqueda.");
        return;
    }

    const buscar = buscarInputIndex.value.trim();

    if (!buscar) {
        alert("Por favor, ingresa un término de búsqueda.");
        return;
    }

    window.location.href = `../catalogo.php?buscar=${encodeURIComponent(buscar)}`;
}


