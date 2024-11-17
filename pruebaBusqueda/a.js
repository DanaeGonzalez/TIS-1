// Lista de sugerencias de ejemplo con descripciones e imágenes
const sugerencias = [
    { nombre: "Agua", descripcion: "Agua natural y pura.", imagen: "https://cdn.uss.cl/content/uploads/2024/03/15182231/comprromiso-agua.jpg" },
    { nombre: "Agua purificada", descripcion: "Filtrada para eliminar impurezas.", imagen: "https://cdn.uss.cl/content/uploads/2024/03/15182231/comprromiso-agua.jpg" },
    { nombre: "Agua mineral", descripcion: "Agua con minerales esenciales.", imagen: "https://cdn.uss.cl/content/uploads/2024/03/15182231/comprromiso-agua.jpg" },
    { nombre: "Agua con gas", descripcion: "Refrescante y con burbujas.", imagen: "https://cdn.uss.cl/content/uploads/2024/03/15182231/comprromiso-agua.jpg" },
    { nombre: "Agua sin gas", descripcion: "Ideal para cualquier ocasión.", imagen: "https://cdn.uss.cl/content/uploads/2024/03/15182231/comprromiso-agua.jpg" },
    { nombre: "Agua de coco", descripcion: "Naturalmente dulce y refrescante.", imagen: "https://cdn.uss.cl/content/uploads/2024/03/15182231/comprromiso-agua.jpg" },
    { nombre: "Jugo de naranja", descripcion: "100% jugo de naranjas frescas.", imagen: "https://cdn.uss.cl/content/uploads/2024/03/15182231/comprromiso-agua.jpg" },
    { nombre: "Jugo de manzana", descripcion: "Dulce y saludable.", imagen: "https://cdn.uss.cl/content/uploads/2024/03/15182231/comprromiso-agua.jpg" },
    { nombre: "Soda", descripcion: "Bebida carbonatada refrescante.", imagen: "https://cdn.uss.cl/content/uploads/2024/03/15182231/comprromiso-agua.jpg" },
    { nombre: "Té helado", descripcion: "Perfecto para el verano.", imagen: "https://cdn.uss.cl/content/uploads/2024/03/15182231/comprromiso-agua.jpg" }
];

// Elementos del DOM
const campo = document.getElementById("campo");
const lista = document.getElementById("lista");

// Escucha el evento "input" para mostrar sugerencias mientras escribe
campo.addEventListener("input", function() {
    const valor = campo.value.toLowerCase();
    lista.innerHTML = ""; // Limpiar las sugerencias anteriores

    if (valor) {
        const filtradas = sugerencias.filter(sugerencia => sugerencia.nombre.toLowerCase().includes(valor));
        
        filtradas.forEach(sugerencia => {
            const item = document.createElement("li");
            item.classList.add("list-group-item", "list-group-item-action", "sugerencia-item");
            
            // Estructura de contenido de la sugerencia
            item.innerHTML = `
                <img src="${sugerencia.imagen}" alt="${sugerencia.nombre}" class="sugerencia-img">
                <div>
                    <strong>${sugerencia.nombre}</strong><br>
                    <small>${sugerencia.descripcion}</small>
                </div>
            `;

            // Agrega un evento para seleccionar la sugerencia al hacer clic
            item.addEventListener("click", () => {
                campo.value = sugerencia.nombre;
                lista.innerHTML = ""; // Limpiar las sugerencias al seleccionar
            });

            lista.appendChild(item);
        });
    }
});
