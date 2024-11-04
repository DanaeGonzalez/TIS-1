<?php

require '../../../../autoload.php';
require '../../../../../views/menu_registro/auth.php';
include '../../../../../config/conexion.php';

/*
|--------------------------------------------------------------------------
| Inicializamos el objeto Transaction
|--------------------------------------------------------------------------
*/


// Inicializamos el objeto Transaction
$transaction = new \Transbank\Webpay\WebpayPlus\Transaction();

$id_usuario = $_SESSION['id_usuario'] ?? null;
if (!$id_usuario) {
    exit('Debe iniciar sesión antes de realizar una compra.');
}

$action = $_GET['action'] ?? null;
if (!$action) {
    exit('Debe indicar la acción a realizar');
}

if ($action === 'create') {
    // Consulta para obtener el `id_compra` y `total_compra` desde la tabla `compra`
    $query = "SELECT id_compra, total_compra FROM compra WHERE id_usuario = $id_usuario ORDER BY id_compra DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $id_compra = $row['id_compra'];
        $total_compra = $row['total_compra'];
    } else {
        exit('No se encontró una compra asociada.');
    }

    // Crear el buyOrder basado en el id_compra
    $buyOrder = $id_compra;

    // Crear transacción con Webpay
    $createResponse = $transaction->create(
        $buyOrder,
        uniqid(),
        $total_compra,
        'https://localhost/xampp/TIS-1/IKAT/vendor/transbank/transbank-sdk/examples/webpay-plus/index.php?action=result'
    );

    // Redirigir a Webpay con el token
    $redirectUrl = $createResponse->getUrl() . '?token_ws=' . $createResponse->getToken();
    header('Location: ' . $redirectUrl, true, 302);
    exit;
}
/*
|--------------------------------------------------------------------------
| Confirmar transacción
|--------------------------------------------------------------------------
/ Esto se debería ejecutar cuando el usario finaliza el proceso de pago en el formulario de webpay.
*/
if ($_GET['action'] === 'result') {
    if (userAbortedOnWebpayForm()) {
        cancelOrder();
        exit('Has cancelado la transacción en el formulario de pago. Intenta nuevamente');
    }
    if (anErrorOcurredOnWebpayForm()) {
        cancelOrder();
        exit('Al parecer ocurrió un error en el formulario de pago. Intenta nuevamente');
    }
    if (theUserWasRedirectedBecauseWasIdleFor10MinutesOnWebapayForm()) {
        cancelOrder();
        exit('Superaste el tiempo máximo que puedes estar en el formulario de pago (10 minutos). La transacción fue cancelada por Webpay. ');
    }
    //Por último, verificamos que solo tengamos un token_ws. Si no es así, es porque algo extraño ocurre.
    if (!isANormalPaymentFlow()) { // Notar que dice ! al principio.
        cancelOrder();
        exit('En este punto, si NO es un flujo de pago normal es porque hay algo extraño y es mejor abortar. Quizás alguien intenta llamar a esta URL directamente o algo así...');
    }

    // Acá ya estamos seguros de que tenemos un flujo de pago normal. Si no, habría "muerto" en los checks anteriores.
    $token = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null; // Obtener el token de un flujo normal
    $response = $transaction->commit($token);

    if ($response->isApproved()) {
        //Si el pago está aprobado (responseCode == 0 && status === 'AUTHORIZED') entonces aprobamos nuestra compra
        // Código para aprobar compra acá
        approveOrder($response);
    } else {
        cancelOrder();
    }

    return;
}

function cancelOrder($response = null)
{
    // Marcar la orden como fallida o cancelada aquí
    if ($response) {
        echo '<pre>' . print_r($response, true) . '</pre>';
    }

    echo '
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f8f9fa; font-family: Arial, sans-serif;">
        <div style="text-align: center; padding: 40px 30px; border-radius: 15px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); max-width: 500px; background-color: #ffffff;">
            <h1 style="color: #dc3545; font-size: 2.5em; font-weight: bold; margin-bottom: 10px;">¡Orden Rechazada!</h1>
            
            <p style="color: #333333; font-size: 1.2em; line-height: 1.5; margin-bottom: 25px;">
                Lo sentimos, tu transacción no pudo ser completada. <br>
                Por favor, intenta nuevamente o contacta a soporte si el problema persiste.
            </p>
            
            <div style="background-color: #f8d7da; padding: 15px; border-radius: 10px; margin-bottom: 25px; color: #721c24; font-size: 1.1em;">
                <p style="margin: 0;"><strong>ID de Transacción:</strong> ' . ($response ? htmlspecialchars($response->getBuyOrder()) : 'N/A') . '</p>
                <p style="margin: 0; margin-top: 8px;"><strong>Motivo:</strong> ' . ($response ? htmlspecialchars($response->getStatus()) : 'Desconocido') . '</p>
            </div>
            
            <a href="../../../../../views/menu_rol/' .
        ($_SESSION['tipo_usuario'] === "Admin" ? "menu_adm.php" : ($_SESSION['tipo_usuario'] === "Registrado" ? "menu_reg.php" : "menu_supadm.php")) . '" 
               class="btn" style="display: inline-block; text-decoration: none; color: #ffffff; background-color: #dc3545; padding: 12px 25px; border-radius: 5px; font-size: 1.1em; font-weight: bold; transition: background-color 0.3s; box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);">
               Volver al Inicio
            </a>
        </div>
    </div>';
}


function approveOrder($response)
{

    global $conn;
    
    // Asumiendo que tienes el ID del carrito de compras en la sesión
    $id_carrito = $_SESSION['id_carrito'];

    // Paso 1: Obtener los productos y cantidades del carrito de compras
    $query = "SELECT id_producto, cantidad_producto FROM carrito_producto WHERE id_carrito = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_carrito);
    $stmt->execute();
    $result = $stmt->get_result();

    // Paso 2: Iterar por cada producto en el carrito y actualizar el stock y cantidad vendida
    while ($row = $result->fetch_assoc()) {
        $id_producto = $row['id_producto'];
        $cantidad_comprada = $row['cantidad_producto'];

        // Actualizar el stock y cantidad vendida en la tabla producto
        $updateQuery = "
                UPDATE producto 
                SET stock_producto = stock_producto - ?, 
                    cantidad_vendida = cantidad_vendida + ? 
                WHERE id_producto = ? AND stock_producto >= ?";

        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("iiii", $cantidad_comprada, $cantidad_comprada, $id_producto, $cantidad_comprada);

        // Ejecutar la actualización y verificar que se realizó correctamente
        if (!$updateStmt->execute()) {
            echo "Error al actualizar el producto ID " . $id_producto . ": " . $updateStmt->error;
        }
    }












    // Acá has lo que tengas que hacer para marcar la orden como aprobada o finalizada
    echo '
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f2f5f7; font-family: Arial, sans-serif;">
        <div style="text-align: center; padding: 40px 30px; border-radius: 15px; box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); max-width: 500px; background-color: #ffffff;">
            <h1 style="color: #28a745; font-size: 2.5em; font-weight: bold; margin-bottom: 10px;">¡Compra realizada con éxito!</h1>
            
            <p style="color: #333333; font-size: 1.2em; line-height: 1.5; margin-bottom: 25px;">
                Muchas gracias por tu compra, <strong>' . htmlspecialchars($_SESSION['nombre_usuario']) . '</strong>. <br>
                Tu transacción ha sido aprobada y procesada con éxito.
            </p>
            
            <div style="background-color: #e9ecef; padding: 15px; border-radius: 10px; margin-bottom: 25px; color: #555555; font-size: 1.1em;">
                <p style="margin: 0;"><strong>ID de Transacción:</strong> ' . htmlspecialchars($response->getBuyOrder()) . '</p>
                <p style="margin: 0; margin-top: 8px;"><strong>Total de la compra:</strong> $' . number_format($response->getAmount()) . '</p>
            </div>
            
            <a href="../../../../../views/menu_rol/' .
        ($_SESSION['tipo_usuario'] === "Admin" ? "menu_adm.php" : ($_SESSION['tipo_usuario'] === "Registrado" ? "menu_reg.php" : "menu_supadm.php")) . '" 
               class="btn" style="display: inline-block; text-decoration: none; color: #ffffff; background-color: #007bff; padding: 12px 25px; border-radius: 5px; font-size: 1.1em; font-weight: bold; transition: background-color 0.3s; box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);">
               Volver al Inicio
            </a>
        </div>
    </div>';








}


function userAbortedOnWebpayForm()
{
    $tokenWs = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
    $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'] ?? null;
    $ordenCompra = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'] ?? null;
    $idSesion = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'] ?? null;

    // Si viene TBK_TOKEN, TBK_ORDEN_COMPRA y TBK_ID_SESION es porque el usuario abortó el pago
    return $tbkToken && $ordenCompra && $idSesion && !$tokenWs;
}

function anErrorOcurredOnWebpayForm()
{
    $tokenWs = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
    $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'] ?? null;
    $ordenCompra = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'] ?? null;
    $idSesion = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'] ?? null;

    // Si viene token_ws, TBK_TOKEN, TBK_ORDEN_COMPRA y TBK_ID_SESION es porque ocurrió un error en el formulario de pago
    return $tokenWs && $ordenCompra && $idSesion && $tbkToken;
}

function theUserWasRedirectedBecauseWasIdleFor10MinutesOnWebapayForm()
{
    $tokenWs = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
    $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'] ?? null;
    $ordenCompra = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'] ?? null;
    $idSesion = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'] ?? null;

    // Si viene solo TBK_ORDEN_COMPRA y TBK_ID_SESION es porque el usuario estuvo 10 minutos sin hacer nada en el
    // formulario de pago y se canceló la transacción automáticamente (por timeout)
    return $ordenCompra && $idSesion && !$tokenWs && !$tbkToken;
}

function isANormalPaymentFlow()
{
    $tokenWs = $_GET['token_ws'] ?? $_POST['token_ws'] ?? null;
    $tbkToken = $_GET['TBK_TOKEN'] ?? $_POST['TBK_TOKEN'] ?? null;
    $ordenCompra = $_GET['TBK_ORDEN_COMPRA'] ?? $_POST['TBK_ORDEN_COMPRA'] ?? null;
    $idSesion = $_GET['TBK_ID_SESION'] ?? $_POST['TBK_ID_SESION'] ?? null;

    // Si viene solo token_ws es porque es un flujo de pago normal
    return $tokenWs && !$ordenCompra && !$idSesion && !$tbkToken;
}
