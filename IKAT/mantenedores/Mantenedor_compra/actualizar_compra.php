<?php
session_start();
include '../../config/conexion.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';        

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_compra = $_POST['id_compra'];
    $id_usuario = $_POST['id_usuario'];
    $tipo_estado = $_POST['tipo_estado'];

    $sql = "UPDATE compra SET tipo_estado='$tipo_estado' WHERE id_compra= $id_compra";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['mensaje'] = "Compra actualizada exitosamente";

        // Obtener el correo del usuario relacionado con la compra
        $userEmailQuery = "SELECT correo_usuario FROM usuario WHERE id_usuario = $id_usuario";
        $userResult = $conn->query($userEmailQuery);

        if ($userResult->num_rows > 0) {
            $userRow = $userResult->fetch_assoc();
            $toEmail = $userRow['correo_usuario'];

            // Configuración del correo
            $fromEmail = 'smurfchatgpt3@gmail.com';
            $fromName = 'Sistema de Compras';
            $password = 'csnigtgwrrffzrog'; // Contraseña de aplicación de Gmail

            $subject = 'Actualizacion de Estado de Compra';
            $messageText = "Estimado usuario, el estado de su compra con ID: $id_compra ha cambiado a: <strong>$tipo_estado</strong>.";

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
