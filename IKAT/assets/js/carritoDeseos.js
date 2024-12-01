function agregarAlCarrito(productId, cantidadInputId = null) {
    // Determinar la cantidad, si se especifica un input, usar su valor
    const cantidad = cantidadInputId 
        ? parseInt(document.getElementById(cantidadInputId).value) || 1 
        : 1;

    fetch('../assets/php/agregaralCarrito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id_producto: productId,
                cantidad: cantidad
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('alertCarritoSuccess').style.display = 'block';
                setTimeout(() => document.getElementById('alertCarritoSuccess').style.display = 'none', 3000);
            } else {
                document.getElementById('alertCarritoError').style.display = 'block';
                setTimeout(() => document.getElementById('alertCarritoError').style.display = 'none', 3000);
            }
        })
        .catch((error) => console.error('Error:', error));
}

function agregarAListaDeDeseos(productId, successMessage = 'Producto agregado a la lista de deseos!', errorMessage = 'El producto ya se encuentra en la lista de deseos.') {
    fetch('../assets/php/agregarAdeseos.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id_producto: productId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('alertDeseosSuccess').style.display = 'block';
                document.getElementById('alertDeseosSuccess').textContent = successMessage;
                setTimeout(() => document.getElementById('alertDeseosSuccess').style.display = 'none', 3000);
            } else {
                document.getElementById('alertDeseosError').style.display = 'block';
                document.getElementById('alertDeseosError').textContent = errorMessage;
                setTimeout(() => document.getElementById('alertDeseosError').style.display = 'none', 3000);
            }
        })
        .catch(error => console.error('Error:', error));
}
