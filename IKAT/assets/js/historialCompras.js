document.addEventListener("DOMContentLoaded", () => {
    const historialContenedor = document.getElementById("historial-compras");

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
            return response.json();  //Respuesta esperada en formato JSON
        })
        .then((data) => {
            if (data.error) {
                throw new Error(data.error);  //Si la respuesta contiene un error
            }

            if (data.length === 0) {
                // Si no hay compras, muestra un mensaje
                historialContenedor.innerHTML = `<p class="text-muted text-center">No hay productos en el historial de compras.</p>`;
            } else {
                // Renderiza el historial de compras si hay productos
                historialContenedor.innerHTML = data
                    .map(
                        (compra) => `
                            <div class="list-group-item d-flex justify-content-between align-items-center bg-light border mb-4 rounded shadow-sm p-3">
                                <div class="d-flex align-items-center">
                                    <a href="producto.php?id=${compra.id_producto}">
                                        <img src="${compra.foto_producto}" alt="${compra.nombre_producto}" class="me-3 rounded" style="width: 170px;">
                                    </a>
                                    <div>
                                        <h4 class="mb-1 text-dark">${compra.nombre_producto}</h4>
                                        <h6 class="text-dark">$${new Intl.NumberFormat('es-CL').format(compra.precio_unitario)}</h6>
                                        <p class="mb-0 text-muted fw-bold">Cantidad: <span class="text-dark">${compra.cantidad}</span></p>
                                        <p class="mb-0 text-muted">${compra.fecha_compra}</p>
                                    </div>
                                </div>
                                <p class="mb-0 fw-bold fs-5 text-dark">$${new Intl.NumberFormat('es-CL').format(compra.precio_unitario * compra.cantidad)}</p>
                            </div>`
                    )
                    .join("");
            }
        })
        .catch((error) => {
            console.error("Error al cargar el historial:", error);
            historialContenedor.innerHTML = `<p class="text-danger">Error al cargar el historial. Inténtalo más tarde.</p>`;
        });
});
