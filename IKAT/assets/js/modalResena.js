// Función para abrir el modal con los datos del producto
function abrirModalResena(idProducto) {
    // Limpia y configura el modal
    document.getElementById('productoId').value = idProducto;
    document.getElementById('calificacion').value = '';
    document.getElementById('comentario').value = '';

    // Limpia solo las estrellas dentro del modal
    const estrellasModal = document.querySelectorAll('#modalResena .star-rating i');
    estrellasModal.forEach(estrella => {
        estrella.classList.remove('bi-star-fill');
        estrella.classList.add('bi-star');
    });

    // Abre el modal
    const modalElement = document.getElementById('modalResena');
    const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
    modal.show();
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

// Evento de abrir el modal de editar la reseña
document.querySelectorAll('.editar-resena').forEach(button => {
    button.addEventListener('click', function () {
        const idResena = this.dataset.id; // Extrae el id_resenia del atributo data-id
        console.log('ID de la reseña cargado:', idResena); // Depuración
        const calificacion = this.dataset.calificacion;
        const comentario = this.dataset.comentario;

        // Cargar datos en el modal
        document.getElementById('idResena').value = idResena; // Asigna el id_resenia al input oculto
        document.getElementById('editarCalificacion').value = calificacion; // Asigna la calificación
        document.getElementById('editarComentario').value = comentario; // Asigna el comentario

        // Llenar las estrellas en el modal respetando el orden inverso
        const estrellasModal = document.querySelectorAll('#modalEditarResena .star-rating i');
        estrellasModal.forEach((estrella, index) => {
            if (estrellasModal.length - index <= calificacion) { // Ajustar para respetar el orden invertido
                estrella.classList.add('bi-star-fill');
                estrella.classList.remove('bi-star');
            } else {
                estrella.classList.add('bi-star');
                estrella.classList.remove('bi-star-fill');
            }
        });

        // Abrir el modal
        const modal = new bootstrap.Modal(document.getElementById('modalEditarResena'));
        modal.show();
    });
});



// Evento para guardar los cambios
document.getElementById('guardarCambiosResena').addEventListener('click', function () {
    const idResena = document.getElementById('idResena').value;
    const calificacion = document.getElementById('editarCalificacion').value;
    const comentario = document.getElementById('editarComentario').value;

    // Depuración: Verifica que los valores sean correctos
    console.log({
        id_resenia: idResena,
        calificacion: calificacion,
        comentario: comentario
    });

    if (!idResena || !calificacion || !comentario) {
        alert('Por favor, completa todos los campos antes de guardar los cambios.');
        return;
    }

    fetch('../assets/php/editar_resena.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id_resenia: idResena,
            calificacion: calificacion,
            comentario: comentario
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('¡Reseña actualizada exitosamente!');
            location.reload(); // Recargar la página para actualizar las reseñas
        } else {
            alert('Hubo un problema al actualizar la reseña. Inténtalo nuevamente.');
        }
    })
    .catch(error => {
        console.error('Error en el fetch:', error);
        alert('Hubo un problema al guardar la reseña.');
    });
});

//Evento nuevo para que funque el clic
document.querySelectorAll('#modalEditarResena .star-rating i').forEach((estrella, index, estrellas) => {
    // Manejar clic en las estrellas
    estrella.addEventListener('click', function () {
        const valor = estrellas.length - index; // Ajustar el índice para respetar el orden inverso
        document.getElementById('editarCalificacion').value = valor; // Actualizar el input oculto
        console.log('Calificación seleccionada:', valor); // Depuración

        // Actualizar visualmente las estrellas
        estrellas.forEach((s, i) => {
            if (i >= index) {
                s.classList.add('bi-star-fill');
                s.classList.remove('bi-star');
            } else {
                s.classList.add('bi-star');
                s.classList.remove('bi-star-fill');
            }
        });
    });
});

// Estrellas dentro del modal (Escribir reseña)
document.querySelectorAll('#modalResena .star-rating i').forEach((estrella, index, estrellas) => {
    estrella.addEventListener('click', function () {
        const valor = estrellas.length - index; // Calcular el valor
        document.getElementById('calificacion').value = valor; // Actualizar el input oculto

        // Actualizar visualmente solo las estrellas del modal
        estrellas.forEach((s, i) => {
            if (i >= index) {
                s.classList.add('bi-star-fill');
                s.classList.remove('bi-star');
            } else {
                s.classList.add('bi-star');
                s.classList.remove('bi-star-fill');
            }
        });
    });
});


// Estrellas del contenedor de reseñas pendientes
document.querySelectorAll('.star-rating.pendientes').forEach(starContainer => {
    starContainer.addEventListener('click', function () {
        const idProducto = this.closest('.d-flex').querySelector('[data-id-producto]').dataset.idProducto;
        abrirModalResena(idProducto); // Solo abre el modal
    });

    // Asegúrate de que no se pinten las estrellas al hacer clic o hover
    const estrellasPendientes = starContainer.querySelectorAll('i');
    estrellasPendientes.forEach(estrella => {
        estrella.style.pointerEvents = 'none'; // Desactiva interactividad visual
    });
});




document.getElementById('modalResena').addEventListener('hidden.bs.modal', function () {
    document.getElementById('productoId').value = '';
    document.getElementById('calificacion').value = '';
    document.getElementById('comentario').value = '';

    // Limpia las estrellas del modal
    const estrellasModal = document.querySelectorAll('#modalResena .star-rating i');
    estrellasModal.forEach(estrella => {
        estrella.classList.remove('bi-star-fill');
        estrella.classList.add('bi-star');
    });
});



