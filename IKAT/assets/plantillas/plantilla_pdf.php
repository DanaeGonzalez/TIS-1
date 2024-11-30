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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['direccion_pedido'], $_POST['id_metodo'], $_POST['total_calculado'])) {
    // Capturar datos del formulario
    $id_usuario = $_SESSION['id_usuario'];
    $direccion_pedido = $_POST['direccion_pedido'];
    $id_metodo = $_POST['id_metodo'];
    $total_compra = $_POST['total_calculado'];
    $fecha_compra = date('Y-m-d H:i:s');
    $puntos_ganados = $total_compra * 0.05;

    // Insertar en la base de datos
    $query = "INSERT INTO compra (id_compra, fecha_compra, total_compra, puntos_ganados, direccion_pedido, id_metodo, id_usuario) 
              VALUES (NULL, '$fecha_compra', '$total_compra', '$puntos_ganados', '$direccion_pedido', '$id_metodo', '$id_usuario')";

    if ($conn->query($query) === TRUE) {
        echo "Compra registrada exitosamente.";
        header("Location: https://localhost/xampp/TIS-1/IKAT/vendor/transbank/transbank-sdk/examples/webpay-plus/index.php?action=create");
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {

    $total = $_POST['total'] ?? 0;

    // Obtener métodos de pago
    $query_metodo = "SELECT * FROM metodo_pago WHERE activo = 1";
    $result_metodo = $conn->query($query_metodo);

    // Verificar si la dirección está confirmada
    $direccionConfirmada = isset($_POST['direccion_pedido']) && !empty($_POST['direccion_pedido']);
}?>


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
						Boleta/Cotización
					</div>
					<p><strong>Fecha de Emisión:</strong> 25/10/2023</p>
				</div>
			</td>
		</tr>
	
		<tr class="bill-row">
			<td colspan="2">
				<div>
					<div class="row">
						<p class="col-8 margin-b-0">
							<strong>Apellido y Nombre / Razón social: </strong>Usuario
						</p>
					</div>
					<div class="row">
						<p class="col-6 margin-b-0">
							<strong>Condición Frente al IVA: </strong>Consumidor final
						</p>
						<p class="col-6 margin-b-0">
							<strong>Domicilio: </strong>Direccion envio
						</p>
					</div>
					<p>
						<strong>Condicion de venta: </strong>Débito/Credito
					</p>
				</div>
			</td>
		</tr>
		<tr class="bill-row row-details">
			<td colspan="2">
				<div>
					<table>
						<tr>
							<td>Código</td>
							<td>Producto / Servicio</td>
							<td>Cantidad</td>
							<td>U. Medida</td>
							<td>Precio Unit.</td>
							<td>% Bonif.</td>
							<td>Imp. Bonif.</td>
							<td>Subtotal</td>
						</tr>
						
							<tr>
								<td>321</td>
								<td>Madera</td>
								<td>1,00</td>
								<td>Unidad</td>
								<td>150,00</td>
								<td>0,00</td>
								<td>0,00</td>
								<td>150,00</td>
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
							<strong>150,00</strong>
						</p>
					</div>
					<div class="row text-right">
						<p class="col-10 margin-b-0">
							<strong>Importe Otros Tributos: $</strong>
						</p>
						<p class="col-2 margin-b-0">
							<strong>0,00</strong>
						</p>
					</div>
					<div class="row text-right">
						<p class="col-10 margin-b-0">
							<strong>Importe total: $</strong>
						</p>
						<p class="col-2 margin-b-0">
							<strong>150,00</strong>
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

</body>
</html>