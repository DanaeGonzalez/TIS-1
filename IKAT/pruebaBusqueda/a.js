function buscarProductos() {
    // Capturar el input principal con el ID correcto
    const buscarInput = document.getElementById('campo');

    // Verificar si el campo de entrada fue encontrado
    if (!buscarInput) {
        console.error("Campo de búsqueda no encontrado.");
        return false;
    }

    const buscar = buscarInput.value; // Obtener el valor del input
    console.log("Valor de búsqueda:", buscar); // Mensaje de depuración

    const listaResultados = document.getElementById('lista'); // Contenedor de la lista
    if (listaResultados) {
        listaResultados.innerHTML = 'Buscando...'; // Limpia y muestra un mensaje temporal
    }

    // Hacer la solicitud fetch
    fetch(`b.php?buscar=${encodeURIComponent(buscar)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        })
        .then(data => {
            console.log("Datos recibidos:", data); // Mensaje de depuración

            if (listaResultados) {
                listaResultados.innerHTML = ''; // Limpiar los resultados previos
            }

            if (Array.isArray(data) && data.length > 0) {
                data.forEach(producto => {
                    const item = document.createElement('li');
                    item.classList.add('list-group-item', 'sugerencia-item');
                    item.innerHTML = `
                        <img src="${producto.foto_producto}" alt="${producto.nombre_producto}" class="sugerencia-img">
                        <span>${producto.nombre_producto}</span>
                    `;
                    listaResultados.appendChild(item);
                });
            } else {
                if (listaResultados) {
                    listaResultados.innerHTML = '<li class="list-group-item text-muted">No se encontraron productos.</li>';
                }
            }
        })
        .catch(error => {
            if (listaResultados) {
                listaResultados.innerHTML = '<li class="list-group-item text-danger">Error en la búsqueda. Intenta nuevamente.</li>';
            }
            console.error('Error en la búsqueda:', error);
        });

    return false; // Evita el envío del formulario
}
