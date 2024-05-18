<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpMailer/Exception.php';
require '../phpMailer/PHPMailer.php';
require '../phpMailer/SMTP.php';

function sendEmail($email, $subject, $body) {
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.dondominio.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'makemeapass@javiernavarroedib.com';
    $mail->Password   = '4J6ggNYt?r@n+d';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('makemeapass@javiernavarroedib.com');
    $mail->addReplyTo('makemeapass@javiernavarroedib.com');
    $mail->addAddress($email);

    //Content
    $mail->isHTML(true);   //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}