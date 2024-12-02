function cargarEstrellas(idProducto) {
    const container = document.getElementById(`stars-container-${idProducto}`);

    fetch(`../assets/php/stars.php?id_producto=${idProducto}`)
        .then(response => response.text())
        .then(html => {
            container.innerHTML = html; 
        })
        .catch(error => {
            console.error('Error cargando las estrellas:', error);
            container.innerHTML = '<span>Error al cargar estrellas</span>';
        });
}

// Llamar la función para todos los productos en la página
document.addEventListener('DOMContentLoaded', () => {
    const productContainers = document.querySelectorAll('[id^="stars-container-"]');
    productContainers.forEach(container => {
        const idProducto = container.id.split('-')[2]; 
        cargarEstrellas(idProducto);
    });
});
