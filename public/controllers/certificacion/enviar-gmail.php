<?php

    require("../../includes/dsn_open.php");

    require '../../libs/PHPMailer/src/Exception.php';
    require '../../libs/PHPMailer/src/PHPMailer.php';
    require '../../libs/PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include 'html-mail.php';

    $mail = new PHPMailer(true);

    $response = array();
    $response['success'] = true;
    $response['message'] = 'Hecho.';  


    mysqli_autocommit($conexion,FALSE);

    // $certificacion= "UPDATE certificacion SET estado='6', fecha_envio='".$_POST['fecha_envio']."' WHERE id=".$_POST['id'];
    // $conexion->query($certificacion);
    
    $mail->isSMTP();
    // $mail->SMTPDebug = 3;
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'cdvalencia2@gmail.com'; 
    $mail->Password = 'sost aiqy ngmb woze'; 
    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    
    $mail->setFrom('cdvalencia2@gmail.com', 'FUNDACION SACIAR');
    $mail->addAddress($_POST['correo'], $_POST['institucion']);
    
    $mail->addAttachment('../../soportes/certificacion/'.$_POST['id'].'_firmado.pdf'); 

    
    $mail->isHTML(true);
    $mail->Subject = 'FUNDACION SACIAR';
    $mail->Body = $html;
    $mail->AltBody = '';

    
    $mail->send();
    // echo 'El correo ha sido enviado';
    

    if (!mysqli_commit($conexion)) {
        $response['success'] = false;
        $response['message'] = 'Ha ocurrido un error, intente nuevamente.';
        http_response_code(500);
        echo json_encode($response);
        exit();
    }else{
        http_response_code(200);
        echo json_encode($response);
    }

    mysqli_rollback($conexion);

    mysqli_close($conexion);

?>