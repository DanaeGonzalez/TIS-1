// Función para abrir el modal con los datos del producto
function abrirModalResena(idProducto) {
    document.getElementById('productoId').value = idProducto; // Asignar el ID del producto al input oculto
    document.getElementById('calificacion').value = ''; // Resetear la calificación
    document.getElementById('comentario').value = ''; // Resetear el comentario
    const estrellas = document.querySelectorAll('.star-rating i');
    estrellas.forEach(estrella => estrella.classList.remove('bi-star-fill')); // Resetear estrellas
    estrellas.forEach(estrella => estrella.classList.add('bi-star')); // Resetear estrellas
}

document.querySelectorAll('.star-rating i').forEach((star, index, stars) => {
    star.addEventListener('click', function () {
        // Invertir el índice debido a `row-reverse`
        const valor = stars.length - index; // Calcula el valor invertido

        // Asignar el valor correcto al input oculto
        document.getElementById('calificacion').value = valor;

        // Limpiar todas las estrellas
        stars.forEach(s => {
            s.classList.remove('bi-star-fill');
            s.classList.add('bi-star');
        });

        // Llenar las estrellas hasta la seleccionada
        stars.forEach((s, i) => {
            if (i >= index) { // Llenar desde la seleccionada hacia adelante (debido al orden inverso)
                s.classList.remove('bi-star');
                s.classList.add('bi-star-fill');
            }
        });
    });
});




// Guardar la reseña al presionar el botón "Guardar Reseña"
document.getElementById('guardarResena').addEventListener('click', function () {
    const productoId = document.getElementById('productoId').value;
    const calificacion = document.getElementById('calificacion').value;
    const comentario = document.getElementById('comentario').value;

    if (!calificacion || !comentario) {
        alert('Por favor, completa todos los campos antes de guardar la reseña.');
        return;
    }

    console.log({ producto_id: productoId, calificacion, comentario }); // Verifica los datos enviados

    fetch('../assets/php/guardar_resena.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ producto_id: productoId, calificacion, comentario })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('¡Reseña guardada exitosamente!');
            location.reload(); // Recargar la página para actualizar las reseñas
        } else {
            console.error('Error en el backend:', data.message);
            alert('Hubo un problema al guardar la reseña. Inténtalo nuevamente.');
        }
    })
    .catch(error => {
        console.error('Error en el fetch:', error);
        alert('Hubo un problema al guardar la reseña.');
    });
});
