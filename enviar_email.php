<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// Função para enviar o email
function enviarEmail($destinatario_email, $titulo, $body, $altbody) {
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP e autenticação
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->Port = 2525;
        $mail->Username = '828033ee24173b';
        $mail->Password = '44c6f9bb5cae5b';

        // Configurações do email
        $mail->setFrom('plataforma.saggezza@outlook.com', 'Suporte');
        $mail->addAddress($destinatario_email);
        $mail->isHTML(true);

        // Corpo do email
        $mail->Subject = $titulo;
        $mail->Body    = $body;
        $mail->AltBody = $altbody;

        // Envie o email
        $mail->send();

        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>     