function agregarAlCarrito(productId) {
    fetch('agregarAlCarrito.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id_producto: productId, cantidad: 1 })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Producto agregado al carrito!');
            } else {
                alert('Error al agregar el producto al carrito.');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
        });
}