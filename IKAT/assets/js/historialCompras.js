document.addEventListener("DOMContentLoaded", () => {
  const historialContenedor = document.getElementById("historial-compras");
  const searchBar = document.getElementById("search-bar");
  const searchIcon = document.getElementById("search-icon");
  const totalComprasSpan = document.getElementById("total-compras");
  let comprasOriginales = []; // Guardar el historial original para filtrar

  // Fetch para obtener las compras del usuario
  fetch("/xampp/TIS-1/IKAT/assets/php/mostrarHistorial.php", {
    method: "POST",
    body: new URLSearchParams({
      id_usuario: idUsuario,
    }),
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

      comprasOriginales = data; // Guardar el historial original

      if (data.length === 0) {
        historialContenedor.innerHTML = `<p class="text-muted text-center">No hay productos en el historial de compras.</p>`;
        updateTotalCompras(0);
      } else {
        renderHistorial(data);
        updateTotalCompras(data.length);
      }
    })
    .catch((error) => {
      console.error("Error al cargar el historial:", error);
      historialContenedor.innerHTML = `<p class="text-danger">Error al cargar el historial. Inténtalo más tarde.</p>`;
      updateTotalCompras(0);
    });

  // Evento de búsqueda al escribir
  searchBar.addEventListener("input", handleSearch);

  // Evento de búsqueda al presionar Enter
  searchBar.addEventListener("keypress", (e) => {
    if (e.key === "Enter") {
      handleSearch();
    }
  });

  // Evento de búsqueda al hacer clic en el ícono de lupa
  searchIcon.addEventListener("click", handleSearch);

  /**
   * Maneja la lógica de búsqueda
   */
  function handleSearch() {
    const searchText = searchBar.value.toLowerCase();
    const filteredCompras = filterHistorialBySearch(
      comprasOriginales,
      searchText
    );
    renderHistorial(filteredCompras);
    updateTotalCompras(filteredCompras.length);
  }
});

/**
 * Filtra el historial por el texto ingresado en la barra de búsqueda.
 * @param {Array} compras - Lista completa de compras.
 * @param {string} searchText - Texto ingresado en la barra de búsqueda.
 * @returns {Array} - Lista filtrada de compras.
 */
function filterHistorialBySearch(compras, searchText) {
  return compras
    .map((compra) => {
      const productosFiltrados = compra.productos.filter((producto) =>
        producto.nombre_producto.toLowerCase().includes(searchText)
      );
      return productosFiltrados.length > 0
        ? { ...compra, productos: productosFiltrados }
        : null;
    })
    .filter((compra) => compra !== null);
}

/**
 * Renderiza el historial de compras en el contenedor.
 * @param {Array} compras - Lista de compras a renderizar.
 */
function renderHistorial(compras) {
  const historialContenedor = document.getElementById("historial-compras");
  if (compras.length === 0) {
    historialContenedor.innerHTML = `<p class="text-muted text-center">No se encontraron productos.</p>`;
    return;
  }

  historialContenedor.innerHTML = compras
    .map((compra) => {
      const productosHTML = compra.productos
        .map((producto, index) => {
          const rutaAjustada = producto.foto_producto.replace("../../", "../");
          const borderClass = index !== 0 ? "border-top pt-3 mt-3" : "";

          return `
                        <div class="d-flex justify-content-between align-items-center ${borderClass}">
                            <div class="d-flex align-items-center">
                                <img src="${rutaAjustada}" alt="${
            producto.nombre_producto
          }" class="me-3 rounded" style="width: 100px; height: 100px; object-fit: cover;">
                                <div>
                                    <h6 class="mb-1 text-dark">${
                                      producto.nombre_producto
                                    }</h6>
                                    <p class="mb-0 text-muted fw-bold">Cantidad: <span class="text-dark">${
                                      producto.cantidad
                                    }</span></p>
                                    <p class="mb-0 text-muted">Precio unitario: $${new Intl.NumberFormat(
                                      "es-CL"
                                    ).format(producto.precio_unitario)}</p>
                                    <p class="mb-0 fw-bold text-dark">Precio total: $${new Intl.NumberFormat(
                                      "es-CL"
                                    ).format(
                                      producto.precio_unitario *
                                        producto.cantidad
                                    )}</p>
                                </div>
                            </div>
                            <button class="btn btn-cafe-opinar btn-sm" onclick="agregarAlCarrito(${
                              producto.id_producto
                            }, ${producto.cantidad})">Volver a comprar</button>
                        </div>
                    `;
        })
        .join("");

      return `
                <div class="list-group-item p-4 bg-light mb-4 rounded shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                        <h5 class="mb-0">Fecha de compra: ${compra.fecha_compra}</h5>
                        <a href="#" class="text-cafe fs-5 fw-bold text-decoration-none" onclick="agregarTodaLaCompraAlCarrito(${compra.id_compra})">
                            Agregar todo al carrito
                        </a>
                    </div>
                    ${productosHTML}
                </div>
            `;
    })
    .join("");
}

/**
 * Actualiza el span del total de compras
 * @param {number} total - Número total de compras
 */
function updateTotalCompras(total) {
  const totalComprasSpan = document.getElementById("total-compras");
  if (totalComprasSpan) {
    totalComprasSpan.textContent = `${total} ${
      total === 1 ? "compra" : "compras"
    }`;
  } else {
    console.error(
      "No se encontró el elemento para mostrar el total de compras."
    );
  }
}

function agregarTodaLaCompraAlCarrito(idCompra) {
  console.log(
    `Se llamó a agregarTodaLaCompraAlCarrito con idCompra: ${idCompra}`
  );
  fetch("../assets/php/obtenerProductosCompra.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      id_compra: idCompra,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      return response.json();
    })
    .then((productos) => {
      console.log("Productos recibidos:", productos);
      if (productos.error) {
        showAlert(productos.error, "danger");
        return;
      }

      // Iterar sobre los productos y agregarlos al carrito
      productos.forEach((producto) => {
        agregarAlCarrito(producto.id_producto, producto.cantidad);
      });
      showAlert(
        "Todos los productos de la compra fueron agregados al carrito.",
        "success"
      );
    })
    .catch((error) => {
      console.error("Error al obtener los productos de la compra:", error);
      showAlert(
        "Error al obtener los productos. Inténtalo más tarde.",
        "danger"
      );
    });
}

function agregarAlCarrito(productId, cantidad) {
  fetch("../assets/php/agregaralCarrito.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      id_producto: productId,
      cantidad: cantidad,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        showAlert("Producto agregado al carrito con éxito.", "success");
      } else {
        showAlert(
          data.error || "Hubo un error al agregar el producto al carrito.",
          "danger"
        );
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      showAlert(
        "Ocurrió un error al agregar el producto al carrito.",
        "danger"
      );
    });
}

/**
 * Muestra una alerta Bootstrap en la página.
 * @param {string} message - Mensaje de la alerta.
 * @param {string} type - Tipo de alerta (success, danger, warning, info).
 * @param {number} duration - Duración en milisegundos antes de que desaparezca.
 */
function showAlert(message, type = "success", duration = 3000) {
  const alertContainer = document.getElementById("alert-container");
  if (!alertContainer) {
    console.error("No se encontró el contenedor de alertas.");
    return;
  }

  // Crear la alerta
  const alert = document.createElement("div");
  alert.className = `alert alert-${type} alert-dismissible fade show`;
  alert.role = "alert";
  alert.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

  // Agregar la alerta al contenedor
  alertContainer.appendChild(alert);

  // Eliminar la alerta después de la duración especificada
  setTimeout(() => {
    alert.classList.remove("show");
    alert.addEventListener("transitionend", () => alert.remove());
  }, duration);
}
