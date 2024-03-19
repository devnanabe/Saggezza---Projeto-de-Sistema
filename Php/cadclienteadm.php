<?php
// Inclui o arquivo com as configurações de banco de dados
include 'conexaobd.php';

// Verifique se os dados foram enviados via POST para inserção
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nomecliente']) && isset($_POST['nomeresponsavel']) 
                                          && isset($_POST['telefonecliente']) && isset($_POST['emailcliente'])) {
    // Recupere os dados do formulário
    $nome_cliente = $_POST['nomecliente'];
    $responsavel_cliente = $_POST['nomeresponsavel'];
    $telefone_cliente = $_POST['telefonecliente'];
    $email_cliente = $_POST['emailcliente'];

    // Insira os dados no banco de dados
    $sql_insert = "INSERT INTO clientes (cl_nome, cl_responsavel, cl_telefone, cl_email) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert) or die ($conn->error);
    $stmt_insert->bind_param('ssss', $nome_cliente, $responsavel_cliente, $telefone_cliente, $email_cliente);
    $stmt_insert->execute();

    // Verifique se a inserção foi bem-sucedida
    if ($stmt_insert->affected_rows > 0) {
        echo 'Cliente cadastrado com sucesso!';
    } else {
        echo 'Erro ao cadastrar cliente.';
    }
    // Feche o statement de inserção
    $stmt_insert->close();
}else if($_SERVER['REQUEST_METHOD'] === 'GET') { 
    
    // Seleciona os dados da tabela clientes para exibir na tabela HTML
    $sql_select = "SELECT cl_id, cl_nome, cl_telefone, cl_responsavel, cl_email FROM clientes";
    $stmt_select = $conn->prepare($sql_select) or die ($conn->error);
    $stmt_select->execute();
    $resultado = $stmt_select->get_result();

    // Exibir os dados em uma tabela HTML
    while ($row = $resultado->fetch_assoc()) {
        echo '<tr><td>' . $row['cl_id'] . '</td><td>' . $row['cl_nome'] . '</td><td>' . $row['cl_telefone'] . '</td><td>' . $row['cl_responsavel'] . '</td><td>' . $row['cl_email'] . '</td></tr>';
    }

    // Fecha o statement de select
    $stmt_select->close();

}

//Fecha a conexão com o banco de dados
$conn->close();
?>
