<?php
// Inclui o arquivo com as configurações de banco de dados
include 'conexaobd.php';

// Verifique se os dados foram enviados via POST para inserção
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome-fab'])) {
    // Recupere os dados do formulário
    $nome_fabricante = $_POST['nome-fab'];

    // Insira os dados no banco de dados
    $sql_insert = "INSERT INTO fabricantes (fa_nome) VALUES (?)";
    $stmt_insert = $conn->prepare($sql_insert) or die ($conn->error);
    $stmt_insert->bind_param('s', $nome_fabricante);
    $stmt_insert->execute();

    // Feche o statement de inserção
    $stmt_insert->close();
}else if($_SERVER['REQUEST_METHOD'] === 'GET'){

    // Seleciona os dados da tabela fabricantes para exibir na tabela HTML
    $sql_select = "SELECT fa_id, fa_nome FROM fabricantes";
    $stmt_select = $conn->prepare($sql_select) or die ($conn->error);
    $stmt_select->execute();
    $resultado = $stmt_select->get_result();

    // Exibir os dados em uma tabela HTML
    while ($row = $resultado->fetch_assoc()) {
        echo '<tr><td>' . $row['fa_id'] . '</td><td>' . $row['fa_nome'] . '</td></tr>';
    }

    // Fecha o statement de select 
    $stmt_select->close();
}

//Fecha a conexão com o banco de dados
$conn->close();
?>
