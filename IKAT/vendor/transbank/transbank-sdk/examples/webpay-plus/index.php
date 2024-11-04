<?php

require '../../../../autoload.php';
require '../../../../../views/menu_registro/auth.php';
include_once '../../../../../config/conexion.php';

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
    $buyOrder = 'buyOrder_' . $id_compra;

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
    // Acá has lo que tengas que hacer para marcar la orden como fallida o cancelada
    if ($response) {
        echo '<pre>' . print_r($response, true) . '</pre>';
    }
    echo 'La orden ha sido RECHAZADA';
    echo '<br><a href="../../../../../index.php" class="btn btn-primary">Volver al Inicio</a>'; // Cambia la ruta según corresponda
}

function approveOrder($response)
{
    // Acá has lo que tengas que hacer para marcar la orden como aprobada o finalizada
    echo 'La orden ha sido APROBADA';
    echo '<pre>' . print_r($response, true) . '</pre>';
    echo '<br><a href="../../../../../index.php" class="btn btn-primary">Volver al Inicio</a>'; // Cambia la ruta según corresponda
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
