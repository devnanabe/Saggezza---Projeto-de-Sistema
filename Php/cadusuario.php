<?php
// Incluir o arquivo de conexão com o banco de dados
include 'conexaobd.php';
require_once '../enviar_email.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipos']) && $_POST['tipos'] === 'cadastrar'
&& isset($_POST['usuario']) && isset($_POST['telefone']) && isset($_POST['email']) && isset($_POST['tipo']) && isset($_POST['cliente'])){
    // Verificar se os dados foram recebidos
        $usuario = $_POST['usuario'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $tipo = $_POST['tipo'];
        $cliente = $_POST['cliente'];
        

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
            $senha = gerarSenhaAleatoria(12); // Gera uma senha com 12 caracteres
            
            // Atualize a senha no banco de dados
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT); // Hash da nova senha

        // Inserção de dados usando prepared statement
        $sqlInsert = "INSERT INTO usuarios (us_nome, us_senha, us_cliente, us_email, us_telefone, us_tipo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param('ssissi', $usuario, $senhaHash, $cliente, $email, $telefone, $tipo);
        $stmtInsert->execute();

        // Verificar se a inserção foi bem-sucedida
        if ($stmtInsert->affected_rows > 0) {
            $titulo = "Login de usuário";
            $body = "E-mail: " . $email . "<br><br>Senha: " . $senha;
            $altbody = "E-mail: " . $email . "Senha: " . $senha;
            enviarEmail($email, $titulo, $body, $altbody);
        }else{
            echo "Problema ao enviar o e-mail";
        }

        $stmtInsert->close(); // Fecha o statement de insert
    
}else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tipo']) && $_GET['tipo'] === 'todos'){
    
    // Consulta para obter os equipamentos
    $sqlUsuarios = "SELECT tu_id, tu_tipo FROM tipos_usuario";
    $stmtUsuarios = $conn->prepare($sqlUsuarios);
    $stmtUsuarios->execute();
    $resultUsuarios = $stmtUsuarios->get_result();

    $usuarios = array();

    // Verificar se há resultados da consulta de equipamentos
    if ($resultUsuarios->num_rows > 0) {
        while($row = $resultUsuarios->fetch_assoc()) {
            $usuarios[] = array(
                'tu_id' => $row['tu_id'],
                'tu_tipo' => $row['tu_tipo']
            );
        }
    }

    // Consulta para obter os clientes
    $sqlClientes = "SELECT cl_id, cl_nome FROM clientes";
    $stmtClientes = $conn->prepare($sqlClientes);
    $stmtClientes->execute();
    $resultClientes = $stmtClientes->get_result();

    $clientes = array();

    // Verificar se há resultados da consulta de clientes
    if ($resultClientes->num_rows > 0) {
        while($row = $resultClientes->fetch_assoc()) {
            $clientes[] = array(
                'cl_id' => $row['cl_id'],
                'cl_nome' => $row['cl_nome']
            );
        }
    }

    // Retornar os dados como JSON
    echo json_encode(array('usuarios' => $usuarios, 'clientes' => $clientes));
    $stmtClientes->close();
    $stmtUsuarios->close();
}else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tipo']) && $_GET['tipo'] === 'select'){

    $sql_select = "SELECT u.us_id, u.us_nome, u.us_telefone, u.us_email, t.tu_tipo, c.cl_nome, u.cl_data_cad 
                   FROM usuarios u INNER JOIN tipos_usuario t ON u.us_tipo = t.tu_id 
                   INNER JOIN clientes c ON u.us_cliente = c.cl_id
                   ORDER BY us_id";
    $stmt_select = $conn->prepare($sql_select) or die ($conn->error);
    $stmt_select->execute();
    $resultado = $stmt_select->get_result();

    // Exibir os dados em uma tabela HTML
    while ($row = $resultado->fetch_assoc()) {
        echo '<tr><td>' . $row['us_id'] . '</td><td>' . $row['us_nome'] . '</td><td>' . $row['us_telefone'] . '</td><td>' . $row['us_email'] . '</td><td>' . $row['tu_tipo'] . '</td><td>' . $row['cl_nome'] . '</td><td>' . $row['cl_data_cad'] . '</td></tr>';
    }

    // Fecha o statement de select
    $stmt_select->close();
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipos']) && $_POST['tipos'] === 'atualizar' 
            && isset($_POST['usuario']) && isset($_POST['telefone']) && isset($_POST['email'])){

        // Verificar se os dados foram recebidos
        $usuario = $_POST['usuario'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        

        // Inserção de dados usando prepared statement
        $sqlUpdate = "UPDATE usuarios SET us_nome = ?, us_telefone = ? WHERE us_email = ?";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bind_param('sss', $usuario, $telefone, $email);
        $stmtUpdate->execute();

        $stmtUpdate->close(); // Fecha o statement de insert
    
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tipos']) && $_POST['tipos'] === 'excluir' 
&& isset($_POST['email'])){

// Verificar se os dados foram recebidos
$email = $_POST['email'];


// Inserção de dados usando prepared statement
$sqlUpdate = "DELETE FROM usuarios WHERE us_email = ?";
$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param('s', $email);
$stmtUpdate->execute();

$stmtUpdate->close(); // Fecha o statement de insert

}

// Fechar a conexão com o banco de dados
$conn->close();
?>
