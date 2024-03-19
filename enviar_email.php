<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// Função para enviar o email
function enviarEmail($destinatario_email, $novaSenha) {
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP e autenticação
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->Port = 2525;
        $mail->Username = 'dc8eca15aee322';
        $mail->Password = 'f134ab59796faf';

        // Configurações do email
        $mail->setFrom('plataforma.saggezza@outlook.com', 'Suporte');
        $mail->addAddress($destinatario_email);
        $mail->isHTML(true);

        // Corpo do email
        $mail->Subject = 'Recuperação de Senha';
        $mail->Body    = 'Olá! Sua nova senha é: ' . $novaSenha . '<br><br>Com ela você terá acesso ao sistema.';
        $mail->AltBody = 'Olá! Sua nova senha é: ' . $novaSenha . 'Com ela você terá acesso ao sistema.';

        // Envie o email
        $mail->send();

        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>     