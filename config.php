<?php
require_once 'enviar_email.php';
include('dbconnect.php');

// verifique se o formulário foi enviado
if(isset($_POST['enviar'])){
    // Verifique se os dados correspondentes existem no banco de dados
    $destinatario_email = $_POST['email'];
    $query = "SELECT * FROM usuarios WHERE us_email = '$destinatario_email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        // Função para gerar uma senha aleatória
        function gerarSenhaAleatoria($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomPassword = '';
            for ($i = 0; $i < $length; $i++) {
                $randomPassword .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomPassword;
        }

        // Gerar uma nova senha aleatória
        $novaSenha = gerarSenhaAleatoria(12); // Gera uma senha com 12 caracteres
        
        // Atualize a senha no banco de dados
        $novaSenhaHash = password_hash($novaSenha, PASSWORD_DEFAULT); // Hash da nova senha
        $query_update = "UPDATE usuarios SET us_senha = '$novaSenhaHash' WHERE us_email = '$destinatario_email'";
        $resultado_update = mysqli_query($conn, $query_update);

        if($resultado_update) {
            // Chame a função para enviar o email
            $titulo = "Recuperação de Senha";
            $body = "Olá! Sua nova senha é: " . $novaSenha . "<br><br>Com ela você terá acesso ao sistema.";
            $altbody = "Olá! Sua nova senha é: " . $novaSenha . "Com ela você terá acesso ao sistema.";
            
            if(enviarEmail($destinatario_email, $titulo, $body, $altbody)) {
                print "<script>location.href='index.php';</script>";
            } else {
                print "<script>location.href= 'recuperar';</script>";
            }
        } else {
            print "<script>location.href= 'recuperar.php';</script>";
        }
    } else {
        print "<script>alert('Não foi possível encontrar um usuário com esse email.');</script>";
        print "<script>location.href= 'recuperar.php';</script>";
    }
} else {
    print "<script>alert('Erro ao enviar mensagem. Mensagem não enviada via formulário.');</script>";
    print "<script>location.href='index.php';</script>";
}
?>