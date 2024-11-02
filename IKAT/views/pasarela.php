<?php
/**
 * @author     Cristian Cisternas.
 * @copyright  2021 Brouter SpA (https://www.brouter.cl)
 * @date       Agoust 2021
 * @license    GNU LGPL
 * @version    1.0.1
 */

include_once '..\config\conexion.php';
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function get_ws($data, $method, $type, $endpoint)
{
    $curl = curl_init();
    if ($type == 'live') {
        $TbkApiKeyId = '597055555532';
        $TbkApiKeySecret = '579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C';
        $url = "https://webpay3g.transbank.cl" . $endpoint;//Live
    } else {
        $TbkApiKeyId = '597055555532';
        $TbkApiKeySecret = '579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C';
        $url = "https://webpay3gint.transbank.cl" . $endpoint;//Testing
    }
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            'Tbk-Api-Key-Id: ' . $TbkApiKeyId . '',
            'Tbk-Api-Key-Secret: ' . $TbkApiKeySecret . '',
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    //echo $response;
    return json_decode($response);
}

$baseurl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$url = "https://webpay3gint.transbank.cl/";
$type = "sandbox";

$action = isset($_GET["action"]) ? $_GET["action"] : 'init';
$message = null;
$post_array = false;




switch ($action) {

    case "init":
        $message .= 'init';

    
        $query = "SELECT id_compra, total_compra FROM compra WHERE id_usuario = ? ORDER BY fecha_compra DESC LIMIT 1";
        $stmt = mysqli_prepare($conn, $query);
        $id_usuario = $_SESSION['id_usuario'];
        mysqli_stmt_bind_param($stmt, 'i', $id_usuario);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if ($row = mysqli_fetch_assoc($result)) {
            $buy_order = $row['id_compra'];
            $amount = $row['total_compra'];
        } else {
            $message .= "No se encontraron compras para el usuario.";
            break;
        }
    
        $session_id = $id_usuario;
        $return_url = $baseurl . "?action=getResult";
        $data = json_encode([
            "buy_order" => $buy_order,
            "session_id" => $session_id,
            "amount" => $amount,
            "return_url" => $return_url
        ]);
        $method = 'POST';
        $endpoint = '/rswebpaytransaction/api/webpay/v1.0/transactions';
    
        $response = get_ws($data, $method, $type, $endpoint);
        $message .= "<pre>" . print_r($response, TRUE) . "</pre>";
        $url_tbk = $response->url ?? '';
        $token = $response->token ?? '';
        $submit = 'Continuar!';
        break;
    
    case "getResult":
        if (!isset($_POST["token_ws"])) {
            break;
        }
    
        $token = filter_input(INPUT_POST, 'token_ws');
        $request = array(
            "token" => $token
        );
    
        $data = '';
        $method = 'PUT';
        $type = 'sandbox';
        $endpoint = '/rswebpaytransaction/api/webpay/v1.0/transactions/' . $token;
    
        $response = get_ws($data, $method, $type, $endpoint);
    
        // Muestra los detalles de la transacción
        if ($response) {
            $message .= "<h3>Resultado de la transacción</h3>";
            $message .= "<p>Estado: <strong>{$response->status}</strong></p>";
            $message .= "<p>Monto: <strong>\${$response->amount}</strong></p>";
            $message .= "<p>Orden de compra: <strong>{$response->buy_order}</strong></p>";
            $message .= "<p>ID de sesión: <strong>{$response->session_id}</strong></p>";
            $message .= "<p>Detalles de la tarjeta: <strong>{$response->card_detail->card_number}</strong></p>";
            $message .= "<p>Fecha de contabilización: <strong>{$response->accounting_date}</strong></p>";
            $message .= "<p>Fecha de transacción: <strong>{$response->transaction_date}</strong></p>";
            $message .= "<p>Código de autorización: <strong>{$response->authorization_code}</strong></p>";
            $message .= "<p>Código de tipo de pago: <strong>{$response->payment_type_code}</strong></p>";
            $message .= "<p>Código de respuesta: <strong>{$response->response_code}</strong></p>";
            $message .= "<p>Número de cuotas: <strong>{$response->installments_number}</strong></p>";
        } else {
            $message .= "<p>No se pudo obtener información de la transacción.</p>";
        }
    
        $url_tbk = "..\index.php";
        $submit = 'Volver al inicio';
        break;
    
}
?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Webpay Plus Mall">
    <meta name="author" content="VendoOnline.cl">

    <title>Pagos</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="text-center">

            <?php if ($action == "init"): ?>
                <img src="..\assets\images\webpay.png" alt="Webpay Logo" class="mb-4">
                <p>Estamos procesando su pago de <strong>$<?= $amount ?></strong> para la compra
                    <strong>N°<?= $buy_order ?></strong>.
                </p>
                <p>Si no se redirige automáticamente, haga clic en el botón a continuación:</p>
            <?php elseif ($action == "getResult"): ?>
                <?php echo $message; ?>
            <?php elseif ($action == "getStatus"): ?>
                <p>Estado de la transacción para la compra</p>
                <?php echo $message; ?>
            <?php elseif ($action == "refund"): ?>
                <p>Reembolso solicitado para la compra por un monto de <strong>$<?= $amount ?></strong>.</p>
                <?php echo $message; ?>
                <p>Revise la respuesta para confirmar si el reembolso fue exitoso.</p>
            <?php endif; ?>

            <form name="brouterForm" id="brouterForm" method="POST" action="<?= $url_tbk ?>" style="display:block;">
                <input type="hidden" name="token_ws" value="<?= $token ?>" />
                <input type="submit" value="<?= (($submit) ? $submit : 'Cargando...') ?>" class="btn btn-primary" />
            </form>
        </div>

        <?php /* echo $message; */ ?>

        <?php if ($action == "init") { ?>
            <script>
                window.onload = function () {
                    setTimeout(function () {
                        document.brouterForm.submit(); // Envía el formulario automáticamente después de 3 segundos
                    }, 3000); // 3000 milisegundos = 3 segundos
                };
            </script>
        <?php } ?>
    </div>
</body>

</html>