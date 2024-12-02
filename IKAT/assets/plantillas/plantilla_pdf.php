<?php
include $_SERVER['DOCUMENT_ROOT'] . '/xampp/TIS-1/IKAT/views/menu_registro/auth.php';
include $_SERVER['DOCUMENT_ROOT'] . '/xampp/TIS-1/IKAT/config/conexion.php';
$sql = "SELECT p.id_producto, p.nombre_producto, p.stock_producto, cp.cantidad 
        FROM carrito cp 
        JOIN producto p ON cp.id_producto = p.id_producto 
        WHERE cp.id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['id_usuario']);
$stmt->execute();
$result = $stmt->get_result();

// Recorrer los productos del carrito
while ($row = $result->fetch_assoc()) {
    if ($row['cantidad'] > $row['stock_producto']) {
        // Si hay stock insuficiente, agregar el producto al array
        $productosSinStock[] = $row;
        $alerta = true;  // Marcar que hay un problema con el stock
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['direccion_pedido'], $_POST['total_calculado'])) {
    // Capturar datos del formulario
    $id_usuario = $_SESSION['id_usuario'];
	$direccion_pedido = $_POST['direccion_pedido'] ?? '';
	$total_calculado = $_POST['total_calculado'] ?? 0;
    $valorImpuestos = $_POST['valorImpuestos'] ?? 0;
    $valor_envio = $_POST['valor_envio'] ?? 0;
    $fecha_compra = $fecha_compra ?? date('Y-m-d H:i:s');

} else {
    $fecha_compra = $fecha_compra ?? date('Y-m-d H:i:s');

    $total = $_POST['total'] ?? 0;
    $totalIVA = $total * 0.19;
    $totalFinal = $total;

    // Obtener métodos de pago
    $query_metodo = "SELECT * FROM metodo_pago WHERE activo = 1";
    $result_metodo = $conn->query($query_metodo);

    // Verificar si la dirección está confirmada
    $direccionConfirmada = isset($_POST['direccion_pedido']) && !empty($_POST['direccion_pedido']);
}

// Consulta para obtener el nombre del usuario
$sql_usuario = "SELECT nombre_usuario, apellido_usuario FROM usuario WHERE id_usuario = ?";
$stmt_usuario = $conn->prepare($sql_usuario);
$stmt_usuario->bind_param("i", $id_usuario);
$stmt_usuario->execute();
$result_usuario = $stmt_usuario->get_result();

if ($result_usuario->num_rows > 0) {
    $row_usuario = $result_usuario->fetch_assoc();
    $nombre_usuario = $row_usuario['nombre_usuario'] . " " . $row_usuario['apellido_usuario'];
} else {
    $nombre_usuario = "Usuario no encontrado"; // Manejo de error si no se encuentra el usuario
}


?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>IKAT - Documentos</title>
	
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>

	<link rel="stylesheet" href="/xampp/TIS-1/IKAT/assets/css/estructura_plantilla.css">
    <link rel="stylesheet" href="/xampp/TIS-1/IKAT/assets/scss/delete.scss">
    <link rel="stylesheet" href="/xampp/TIS-1/IKAT/assets/css/payButton.css">
	<link rel="stylesheet" href="/xampp/TIS-1/IKAT/assets/css/styles.css">
	<link rel="stylesheet" href="/xampp/TIS-1/IKAT/assets/css/cofeButton.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

</head>
<body>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/xampp/TIS-1/IKAT/templates/header.php'; ?>
	<br>
	<div class="container-f">
	<div class="main">
	<table class="bill-container">
		<tr class="bill-emitter-row">
			<td>
				<div class="bill-type">
					<img style="width:40px; height:50px; align-items: center;" src="/xampp/TIS-1/IKAT/assets/images/cat_blanco.png" alt="logo_ikat">
				</div>
				<div class="text-lg text-center">
					IKAT
				</div>
				<p><strong>Razón social:</strong> IKAT S.A.</p>
				<p><strong>Domicilio Comercial:</strong> Av. Alonso de Ribera 2850</p>
			</td>
			<td>
				<div>
					<div class="text-lg">
						Cotización
					</div>
					<p><strong>Fecha de Emisión:</strong> 
   						<?php echo isset($fecha_compra) ? htmlspecialchars($fecha_compra) : 'Fecha no disponible'; ?>
					</p>

				</div>
			</td>
		</tr>
	
		<tr class="bill-row">
			<td colspan="2">
				<div>
					<div class="row">
						<p class="col-8 margin-b-0">
							<strong>Nombre Solicitante</strong> <?php echo htmlspecialchars($nombre_usuario) ?>
						</p>
					</div>
					<div class="row">
						<p class="col-6 margin-b-0">
							<strong>Condición Frente al IVA: </strong>Consumidor final
						</p>
						<p class="col-6 margin-b-0">
							<strong>Dirección Entrega: </strong><?php echo htmlspecialchars($direccion_pedido) ?>
						</p>
					</div>
					<p>
						<strong>Condición de venta: </strong>Débito/Credito
					</p>
				</div>
			</td>
		</tr>
		<tr class="bill-row row-details">
			<td colspan="2">
				<div>
					<table>
						<tr>
							<td>Producto</td>
							<td>Cantidad</td>
							<td>Precio Unit.</td>
							<td>Subtotal</td>
						</tr>
						
						<tr>
							<?php
                            // Consulta para obtener los productos del carrito
                            $sql = "SELECT p.id_producto, p.nombre_producto, p.stock_producto, cp.cantidad, p.precio_unitario, p.foto_producto
                            FROM carrito cp 
                            JOIN producto p ON cp.id_producto = p.id_producto 
                            WHERE cp.id_usuario = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $_SESSION['id_usuario']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $total = 0;

                            // Mostrar productos en el carrito
                            while ($row = $result->fetch_assoc()) {
                                $subtotal = $row['precio_unitario'] * $row['cantidad'];
                                $total += $subtotal;
                                echo "<td>{$row['nombre_producto']}</td>";
								echo "<td>{$row['cantidad']}</td>";
								echo "<td>{$row['precio_unitario']}</td>";
								echo "<td>\$" . number_format(floor($subtotal), 0, '', '.') . "</td>";   
                            }
                            ?>
						</tr>
							
					</table>
				</div>
			</td>
		</tr>
		<tr class="bill-row total-row">
			<td colspan="2">
				<div>
					<div class="row text-right">
						<p class="col-10 margin-b-0">
							<strong>Subtotal: $</strong>
						</p>
						<p class="col-2 margin-b-0">
							<strong><?php echo $total; ?></strong>
						</p>
					</div>
					<div class="row text-right">
						<p class="col-10 margin-b-0">
							<strong>Total IVA 19%: $</strong>
						</p>
						<p class="col-2 margin-b-0">
							<strong><?php echo $totalIVA; ?></strong>
						</p>
					</div>
					<div class="row text-right">
						<p class="col-10 margin-b-0">
							<strong>Valor Envío: $</strong>
						</p>
						<p class="col-2 margin-b-0">
							<strong><?php echo $valorEnvio;?></strong>
						</p>
					</div>
					<div class="row text-right">
						<p class="col-10 margin-b-0">
							<strong>Total a Pagar: $</strong>
						</p>
						<p class="col-2 margin-b-0">
							<strong><?php echo $totalFinal;?></strong>
						</p>
					</div>
				</div>
			</td>
		</tr>
	</table>
	</div>
	</div>
	<?php include $_SERVER['DOCUMENT_ROOT'] . '/xampp/TIS-1/IKAT/templates/footer.php'; ?>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ho+j7jyWK8fNQe+A12e2rFKoMtU5UzcLFpibcB+lNujQw8ERfZ1xJ1lAJ82FmoQU" 
        crossorigin="anonymous"></script>

	<script>
    	window.onload = function() {
        window.print();
    	};

		function calcularTotal() {
    		const subtotal = parseFloat(document.querySelector('input[name="total"]').value) || 0;
    		const valorEnvio = parseFloat(document.getElementById('valorEnvioInput').value) || 0;
    		const tasaImpuestos = 0.19;

    		const totalIVA = Math.round(subtotal * tasaImpuestos);
    		const totalFinal = subtotal + valorEnvio;

    		document.getElementById('valorImpuestos').textContent = `$${formatNumber(totalIVA)}`;
    		document.getElementById('totalConEnvioImpuestos').textContent = `$${formatNumber(totalFinal)}`;
    		document.getElementById('totalCalculado').value = totalFinal.toFixed(2);
		}

		function formatNumber(num) {
    		return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
		}
    </script>
</body>
</html>