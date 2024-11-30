document.addEventListener("DOMContentLoaded", () => {
    const historialContenedor = document.getElementById("historial-compras");
    const totalComprasSpan = document.querySelector(".text-secondary");

    // Fetch para obtener las compras del usuario
    fetch("/xampp/TIS-1/IKAT/assets/php/mostrarHistorial.php", {
        method: "POST",
        body: new URLSearchParams({
            id_usuario: idUsuario
        })
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then((data) => {
            if (data.error) {
                throw new Error(data.error);
            }

            // Verificar si no hay compras
            if (data.length === 0) {
                historialContenedor.innerHTML = `<p class="text-muted text-center">No hay productos en el historial de compras.</p>`;
                updateTotalCompras(0);
            } else {
                // Renderizar compras
                historialContenedor.innerHTML = data
                    .map((compra) => {
                        const productosHTML = compra.productos
                            .map((producto, index) => {
                                const rutaAjustada = producto.foto_producto.replace("../../", "../");
                                const borderClass = index !== 0 ? "border-top pt-3 mt-3" : "";

                                return `
                                    <div class="d-flex justify-content-between align-items-center ${borderClass}">
                                        <div class="d-flex align-items-center">
                                            <img src="${rutaAjustada}" alt="${producto.nombre_producto}" class="me-3 rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                            <div>
                                                <h6 class="mb-1 text-dark">${producto.nombre_producto}</h6>
                                                <p class="mb-0 text-muted fw-bold">Cantidad: <span class="text-dark">${producto.cantidad}</span></p>
                                                <p class="mb-0 text-muted">Precio unitario: $${new Intl.NumberFormat('es-CL').format(producto.precio_unitario)}</p>
                                                <p class="mb-0 fw-bold text-dark">Precio total: $${new Intl.NumberFormat('es-CL').format(producto.precio_unitario * producto.cantidad)}</p>
                                            </div>
                                        </div>
                                        <button class="btn btn-outline-primary btn-sm" onclick="agregarAlCarrito(${producto.id_producto}, ${producto.cantidad})">Volver a comprar</button>
                                    </div>
                                `;
                            })
                            .join("");

                        return `
                            <div class="list-group-item p-4 bg-light mb-4 rounded shadow-sm">
                                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                    <h5 class="mb-0">Fecha de compra: ${compra.fecha_compra}</h5>
                                    <a href="#" class="text-primary fw-bold text-decoration-none" onclick="agregarTodaLaCompraAlCarrito(${compra.id_compra})">Agregar todo al carrito</a>
                                </div>
                                ${productosHTML}
                            </div>
                        `;
                    })
                    .join("");

                // Actualizar el total de compras
                updateTotalCompras(data.length);
            }
        })
        .catch((error) => {
            console.error("Error al cargar el historial:", error);
            historialContenedor.innerHTML = `<p class="text-danger">Error al cargar el historial. Inténtalo más tarde.</p>`;
            updateTotalCompras(0); // Si hay un error, aseguramos que se actualice a 0
        });
});

/**
 * Actualiza el span del total de compras
 * @param {number} total - Número total de compras
 */
function updateTotalCompras(total) {
    const totalComprasSpan = document.getElementById("total-compras"); // Usar ID único
    if (totalComprasSpan) {
        totalComprasSpan.textContent = `${total} ${total === 1 ? "compra" : "compras"}`;
    } else {
        console.error("No se encontró el elemento para mostrar el total de compras.");
    }
}

