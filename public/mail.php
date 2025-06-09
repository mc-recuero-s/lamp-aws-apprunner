<?php
// $to = "certificadosdedonacion@saciar.org.co";
// $subject = "Mail";
// $message = "Este es el cuerpo del correo electrónico para la prueba.";
// $headers = "From: certificadosdedonacion@saciar.org.co" . "\r\n" .
//            "Reply-To: cdvalencia2@gmail.com" . "\r\n" .
//            "X-Mailer: PHP/" . phpversion();

// if(mail($to, $subject, $message, $headers)) {
//     echo "Correo enviado exitosamente.";
// } else {
//     echo "Error al enviar el correo.";
// }
?> 

<?php
// Incluye las clases de PHPMailer manualmente
require 'libs/PHPMailer/src/Exception.php';
require 'libs/PHPMailer/src/PHPMailer.php';
require 'libs/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    
    $mail->isSMTP();
    $mail->SMTPDebug = 3;
    $mail->Host = 'smtp.office365.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'certificadosdedonacion@saciar.org.co'; 
    $mail->Password = 'saciar2024*'; 
    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;


    $mail->setFrom('certificadosdedonacion@saciar.org.co', 'Saciar Fundación');
    $mail->addAddress('cdvalencia2@gmail.com', 'Dario Agudelo');

    
    $mail->addAttachment('soportes/certificacion/3_firmado.pdf'); 

    
    $mail->isHTML(true);
    $mail->Subject = 'Asunto del correo';
    $mail->Body = 'Este es el contenido del <b>correo en HTML</b>';
    $mail->AltBody = 'Este es el contenido del correo en texto plano';

    
    $mail->send();
    echo 'El correo ha sido enviado';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>