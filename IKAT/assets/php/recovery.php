<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require '../../vendor/phpmailer/phpmailer/src/Exception.php';
    require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../../vendor/phpmailer/phpmailer/src/SMTP.php';
    
    require '../../config/conexion.php';
    $email = $_POST['email'];
    
    $query = "SELECT * FROM usuario WHERE correo_usuario = '$email' AND activo = 1";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);
    
    if ($result->num_rows > 0) {
        $fromEmail = 'clientes.ikat@gmail.com';
        $fromName = 'Sistema de Compras';
        $password = 'gcqecxzdqgqaaboj'; // Contraseña de aplicación de Gmail

        $mail = new PHPMailer(true);
        
        try {
            //Opciones del servidor
            $mail->isSMTP();                                       
            $mail->Host       = 'smtp.gmail.com';                    
            $mail->SMTPAuth   = true;                                  
            $mail->Port       = 587;                                    
            $mail->Username   = $fromEmail;                    
            $mail->Password   = $password;        
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;                       
            
            //Recipientes
            $mail->setFrom($fromEmail, $fromName);
            $mail->addAddress($email);   
            
            //Token de recuperación
            $token = bin2hex(random_bytes(16));
            $queryToken = "UPDATE usuario SET token_rec = '$token' WHERE correo_usuario = '$email'";
            mysqli_query($conn,$queryToken);

            //Contenido
            $body = "<html>
            <body style='font-family: Arial, sans-serif; background-color: #F2F2F2; padding: 20px;'>
                <div style='max-width: 600px; margin: 0 auto; background-color: #FFFFFF; border: 1px solid #BFBFBF; border-radius: 8px; overflow: hidden;'>
                    <div style='background-color: #8C5C32; padding: 15px; text-align: center; color: #FFFFFF;'>
                        <h1 style='margin: 0;'>Recupera tu contraseña</h1>
                    </div>
                    <div style='padding: 20px; text-align: center;'>
                        <h2 style='color: #8C5C32;'>Estimado cliente,
                        <p style='color: #595959; font-size: 16px;'>Hemos notado que estás intentando recuperar tu contraseña.</p>
                        <p style='color: #595959; font-size: 16px;'>Por favor, haz click en el botón de abajo para continuar con el proceso.</p>
                        <a href='http://localhost/xampp/TIS-1/IKAT/views/menu_registro/change_pass.php?id=".$row["id_usuario"]."&token=".$token."'
                            style='background-color: black; margin: 8px 0; color: white; border: none; padding: 16px 32px; text-decoration: none; display: inline-block; font-size: 16px; border-radius: 8px;'>Recuperar Contraseña</a>
                        <p style='color: #595959; font-size: 14px; font-weight: lighter;'>Este correo ha sido generado automáticamente.<br>
                        Evita responder a este correo en caso de algún problema.</p>
                    </div>
                    <div style='background-color: #F2F2F2; padding: 15px; text-align: center;'>
                        <p style='color: #595959; font-size: 14px;'>Gracias por confiar en nosotros.</p>
                    </div>
                </div>
            </body>
            </html>";

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body    = $body;
            
            $mail->send();
            header("Location: ../../views/menu_registro/login.php?msg=ok");
        } catch (Exception $e) {
            header("Location: ../../views/menu_registro/login.php?msg=error");
        }
        
    }else{
        header("Location: ../../views/menu_registro/login.php?msg=not_found");
        exit();
    }