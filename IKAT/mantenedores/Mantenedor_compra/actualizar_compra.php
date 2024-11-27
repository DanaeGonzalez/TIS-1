<?php
session_start();
include '../../config/conexion.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';        

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_compra = $_POST['id_compra'];
    $id_producto = $_POST['id_producto'];
    $id_usuario = $_POST['id_usuario'];
    $tipo_estado = $_POST['tipo_estado'];

    $sql = "UPDATE compra_producto SET tipo_estado='$tipo_estado' WHERE id_compra= $id_compra AND id_producto = $id_producto";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Compra actualizada exitosamente";

        // Obtener los datos del usuario relacionado con la compra
        $userEmailQuery = "SELECT nombre_usuario, correo_usuario FROM usuario WHERE id_usuario = $id_usuario";
        $userResult = $conn->query($userEmailQuery);

        if ($userResult->num_rows > 0) {
            $userRow = $userResult->fetch_assoc();
            $userName = $userRow['nombre_usuario'];
            $toEmail = $userRow['correo_usuario'];

            // Obtener detalles del producto
            $productQuery = "SELECT nombre_producto, foto_producto FROM producto WHERE id_producto = $id_producto";
            $productResult = $conn->query($productQuery);

            if ($productResult->num_rows > 0) {
                $productRow = $productResult->fetch_assoc();
                $productName = $productRow['nombre_producto'];
                $productPhoto = $productRow['foto_producto']; // URL de la foto

                // Configuración del correo
                $fromEmail = 'clientes.ikat@gmail.com';
                $fromName = 'Sistema de Compras';
                $password = 'gcqecxzdqgqaaboj'; // Contraseña de aplicación de Gmail

                $subject = 'Actualización de Estado de Compra';
                $messageText = "
                <html>
                <body style='font-family: Arial, sans-serif; background-color: #F2F2F2; padding: 20px;'>
                    <div style='max-width: 600px; margin: 0 auto; background-color: #FFFFFF; border: 1px solid #BFBFBF; border-radius: 8px; overflow: hidden;'>
                        <div style='background-color: #8C5C32; padding: 15px; text-align: center; color: #FFFFFF;'>
                            <h1 style='margin: 0;'>Actualización de Compra</h1>
                        </div>
                        <div style='padding: 20px; text-align: center;'>
                            <h2 style='color: #8C5C32;'>Estimado cliente: $userName</h2>
                            <p style='color: #595959; font-size: 16px;'>El estado de su compra con ID: <strong>$id_compra</strong> ha cambiado a: <strong>$tipo_estado</strong>.</p>
                            <h2 style='color: #8C5C32;'>Producto</h2>
                            <p style='color: #0D0D0D; font-size: 18px;'><strong>$productName</strong></p>
                            <div style='margin: 20px auto;'>
                                <img src='$productPhoto' alt='$productName' style='width: 100%; max-width: 300px; border: 1px solid #BFBFBF; border-radius: 8px;'>
                            </div>
                        </div>
                        <div style='background-color: #F2F2F2; padding: 15px; text-align: center;'>
                            <p style='color: #595959; font-size: 14px;'>Gracias por confiar en nosotros.</p>
                        </div>
                    </div>
                </body>
                </html>";

                $mail = new PHPMailer(true);

                try {
                    // Configuración del servidor SMTP
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = $fromEmail;
                    $mail->Password = $password;
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Configuración del correo
                    $mail->setFrom($fromEmail, $fromName);
                    $mail->addAddress($toEmail);
                    $mail->isHTML(true); // Habilitar HTML en el correo
                    $mail->Subject = $subject;
                    $mail->Body = $messageText;

                    // Enviar el correo
                    $mail->send();
                    $_SESSION['mensaje'] .= " Se ha enviado un correo de notificación.";
                } catch (Exception $e) {
                    $_SESSION['mensaje'] .= " Sin embargo, no se pudo enviar el correo: {$mail->ErrorInfo}";
                }
            } else {
                $_SESSION['mensaje'] .= " No se encontraron detalles del producto.";
            }
        } else {
            $_SESSION['mensaje'] .= " No se encontró el correo electrónico del usuario.";
        }
    } else {
        $_SESSION['mensaje'] = "Error al actualizar la compra: " . $conn->error;
    }

    // Redirigir de vuelta a mostrar_compra.php
    header('Location: mostrar_compra.php');
    exit();
}
?>
