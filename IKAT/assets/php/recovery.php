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
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body    = 'Hola!<br><br>
            Este es un correo generado automáticamente para realizar la recuperación de tu contraseña en IKAT. No debes responder a este correo en caso de algún problema.<br><br>
            Por favor, 
            <a href="http://localhost/xampp/TIS-1/IKAT/views/menu_registro/change_pass.php?id='.$row['id_usuario'].'&token='.$token.'">haz click aquí</a> para continuar con la operación.';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
            $mail->send();
            header("Location: ../../views/menu_registro/login.php?msg=ok");
        } catch (Exception $e) {
            header("Location: ../../views/menu_registro/login.php?msg=error");
        }
        
    }else{
        header("Location: ../../views/menu_registro/login.php?msg=not_found");
        exit();
    }