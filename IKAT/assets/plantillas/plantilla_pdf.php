<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>IKAT - Documentos</title>
<head>
	<title>Factura</title>
	<style type="text/css">
		*{
			box-sizing: border-box;
			-webkit-user-select: none; /* Chrome, Opera, Safari */
			-moz-user-select: none; /* Firefox 2+ */
			-ms-user-select: none; /* IE 10+ */
			user-select: none; /* Standard syntax */
		}
		.bill-container{
			width: 750px;
			position: absolute;
			left:0;
			right: 0;
			margin: auto;
			border-collapse: collapse;
			font-family: sans-serif;
			font-size: 13px;
		}

		.bill-emitter-row td{
			width: 50%;
			border-bottom: 1px solid; 
			padding-top: 10px;
			padding-left: 10px;
			vertical-align: top;
		}
		.bill-emitter-row{
			position: relative;
		}
		.bill-emitter-row td:nth-child(2){
			padding-left: 60px;
		}
		.bill-emitter-row td:nth-child(1){
			padding-right: 60px;
		}

		.bill-type{
			border: 1px solid;
			border-top: 1px solid; 
			border-bottom: 1px solid; 
			margin-right: -30px;
			background: white;
			width: 60px;
			height: 50px;
			position: absolute;
			left: 0;
			right: 0;
			top: -1px;
			margin: auto;
			text-align: center;
			font-size: 40px;
			font-weight: 600;
		}
		.text-lg{
			font-size: 30px;
		}
		.text-center{
			text-align: center;
		}

		.col-2{
			width: 16.66666667%;
			float: left;
		}
		.col-3{
			width: 25%;
			float: left;
		}
		.col-4{
			width: 33.3333333%;
			float: left;
		}
		.col-5{
			width: 41.66666667%;
			float: left;
		}
		.col-6{
			width: 50%;
			float: left;
		}
		.col-8{
			width: 66.66666667%;
			float: left;
		}
		.col-10{
			width: 83.33333333%;
			float: left;
		}
		.row{
			overflow: hidden;
		}

		.margin-b-0{
			margin-bottom: 0px;
		}

		.bill-row td{
			padding-top: 5px
		}

		.bill-row td > div{
			border-top: 1px solid; 
			border-bottom: 1px solid; 
			margin: 0 -1px 0 -2px;
			padding: 0 10px 13px 10px;
		}
		.row-details table {
			border-collapse: collapse;
			width: 100%;
		}
		.row-details td > div, .row-qrcode td > div{
			border: 0;
			margin: 0 -1px 0 -2px;
			padding: 0;
		}
		.row-details table td{
			padding: 5px;
		}
		.row-details table tr:nth-child(1){
			border-top: 1px solid; 
			border-bottom: 1px solid; 
			background: #c0c0c0;
			font-weight: bold;
			text-align: center;
		}
		.row-details table tr +  tr{
			border-top: 1px solid #c0c0c0; 
			
		}
		.text-right{
			text-align: right;
		}

		.margin-b-10 {
			margin-bottom: 10px;
		}

		.total-row td > div{
			border-width: 2px;
		}

		.row-qrcode td{
			padding: 10px;
		}		

		#qrcode {
			width: 50%
		}
	</style>
</head>
<body>
	<table class="bill-container">
		<tr class="bill-emitter-row">
			<td>
				<div class="bill-type">
					<img style="width:50px; height:50px;" src="/xampp/TIS-1/IKAT/assets/images/cat_blanco.png" alt="logo_ikat">
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
</body>
</html>