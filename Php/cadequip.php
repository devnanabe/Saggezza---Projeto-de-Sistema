<?php
// Inclui o arquivo com as configurações de banco de dados
include 'conexaobd.php';

// Verifique se os dados foram enviados via POST para inserção
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome-equip'])) {
    // Recupere os dados do formulário
    $nome_equip = $_POST['nome-equip'];

    // Insira os dados no banco de dados
    $sql_insert = "INSERT INTO equipamentos (eq_nome) VALUES (?)";
    $stmt_insert = $conn->prepare($sql_insert) or die ($conn->error);
    $stmt_insert->bind_param('s', $nome_equip);
    $stmt_insert->execute();

    // Feche o statement de inserção
    $stmt_insert->close();
}else if($_SERVER['REQUEST_METHOD'] === 'GET'){ 

    // Seleciona os dados da tabela equipamentos para exibir na tabela HTML
    $sql_select = "SELECT eq_id, eq_nome FROM equipamentos";
    $stmt_select = $conn->prepare($sql_select) or die ($conn->error);
    $stmt_select->execute();
    $resultado = $stmt_select->get_result();

    // Exibir os dados em uma tabela HTML
    while ($row = $resultado->fetch_assoc()) {
        echo '<tr><td>' . $row['eq_id'] . '</td><td>' . $row['eq_nome'] . '</td></tr>';
    }

    //Feche o statement do select
    $stmt_select->close();
}

// Feche a conexão com o banco de dados
$conn->close();
?>
