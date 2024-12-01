<?php
$webNotificationPayload['title'] = '¡Gracias por tu compra!';
$webNotificationPayload['body'] = 'Tu compra ha sido procesada con éxito. Haz clic aquí para ver tu pedido.';
$webNotificationPayload['icon'] = '../assets/images/cat_blanco.jpg';
$webNotificationPayload['url'] = 'compras.php';
echo json_encode($webNotificationPayload);
exit();
?>