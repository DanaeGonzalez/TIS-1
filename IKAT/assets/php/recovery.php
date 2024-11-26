<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require '../../vendor/phpmailer/phpmailer/src/Exception.php';
    require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../../vendor/phpmailer/phpmailer/src/SMTP.php';

    require '../../config/conexion.php';
    $email = $_POST['email'];

    $query = "SELECT * FROM usuario WHERE correo_usuario = '' AND activo = 1";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);

    if ($result->num_rows > 0) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'ba1aa05cd7e1b9';                     //SMTP username
            $mail->Password   = 'e97358819d2424';                               //SMTP password
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('from@example.com', 'Mailer'); //
            $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body    = 'Hola!<br>
            Este es un correo generado automáticamente para solicitar la recuperación de tu contraseña en IKAT. Por favor, 
            <a href="localhost/TIS-1/IKAT/views/menu_registro/change_pass.php?id='.$row['id_usuario'].'">haz click aquí</a> para continuar con la operación.';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            header("Location: ../../views/menu_registro/login.php?msg=ok");
        } catch (Exception $e) {
            header("Location: ../../views/menu_registro/login.php?msg=error");
        }


    }else{
        header("Location: ../../views/menu_registro/login.php?msg=not_found");
        exit();
    }