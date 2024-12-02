// Selección del contenedor de etiquetas dinámicas
const selectedFiltersContainer = document.getElementById("selectedFilters");

// Asignar eventos a todos los checkboxes de los filtros
document.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
    checkbox.addEventListener("change", handleFilterChange);
});

// Función para crear etiquetas de filtros seleccionados
function addFilterTag(filterName, filterValue) {
    const tag = document.createElement("span");
    tag.className = "badge bg-secondary text-white rounded-pill d-flex align-items-center gap-1";
    tag.innerHTML = `
${filterName}: ${filterValue}
<button type="button" class="btn-close btn-close-white btn-sm ms-1" aria-label="Remove"></button>
`;

    tag.querySelector("button").addEventListener("click", () => {
        removeFilterTag(tag, filterName, filterValue);
    });

    selectedFiltersContainer.appendChild(tag);
}

// Función para eliminar etiquetas y desmarcar el checkbox correspondiente
function removeFilterTag(tag, filterName, filterValue) {
    selectedFiltersContainer.removeChild(tag);

    const checkbox = document.querySelector(
        `input[name="${filterName}"][value="${filterValue}"]`
    );
    if (checkbox) checkbox.checked = false;
}

// Función para manejar la selección y deselección de filtros
function handleFilterChange(event) {
    const checkbox = event.target;
    const filterName = checkbox.name;
    const filterValue = checkbox.value;

    if (checkbox.checked) {
        addFilterTag(filterName, filterValue);
    } else {
        const tag = Array.from(selectedFiltersContainer.children).find(
            (el) => el.textContent.includes(`${filterName}: ${filterValue}`)
        );
        if (tag) removeFilterTag(tag, filterName, filterValue);
    }
}
