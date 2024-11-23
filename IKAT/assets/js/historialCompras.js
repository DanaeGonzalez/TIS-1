// mostrarHistorial.js
document.addEventListener('DOMContentLoaded', function () {
    const idUsuario = 1; // Reemplazar con el ID del usuario autenticado.

    fetch('../php/mostrarHistorial.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id_usuario: idUsuario }),
    })
        .then(response => response.json())
        .then(data => {
            const contenedor = document.querySelector('.list-group');
            contenedor.innerHTML = ''; // Limpiar contenido previo

            data.forEach(compra => {
                const productoHTML = `
                    <div class="list-group-item d-flex justify-content-between align-items-center bg-light border mb-4 rounded shadow-sm p-3">
                        <div class="d-flex align-items-center">
                            <a href="producto.php?id=${compra.id_producto}">
                                <img src="${compra.imagen}" alt="${compra.nombre}" class="me-3 rounded" style="width: 170px;">
                            </a>
                            <div>
                                <h4 class="mb-1 text-dark">${compra.nombre}</h4>
                                <h6 class="text-dark">$${compra.precio}</h6>
                                <p class="mb-0 text-muted">${new Date(compra.fecha).toLocaleDateString()}</p>
                            </div>
                        </div>
                        <p class="mb-0 fw-bold fs-5 text-dark">Cantidad: ${compra.cantidad}</p>
                    </div>`;
                contenedor.insertAdjacentHTML('beforeend', productoHTML);
            });
        })
        .catch(error => console.error('Error al cargar el historial:', error));
});
