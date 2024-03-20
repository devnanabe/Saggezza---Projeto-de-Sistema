<?php
// Inclui o arquivo com as configurações de banco de dados
include 'conexaobd.php';

// Verifique se os dados foram enviados via POST para inserção
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome-lub'])) {
    // Recupere os dados do formulário
    $nome_lubrificante = $_POST['nome-lub'];

    // Insira os dados no banco de dados
    $sql_insert = "INSERT INTO lubrificantes (lu_nome) VALUES (?)";
    $stmt_insert = $conn->prepare($sql_insert) or die ($conn->error);
    $stmt_insert->bind_param('s', $nome_lubrificante);
    $stmt_insert->execute();


    // Feche o statement de inserção
    $stmt_insert->close();
}else if ($_SERVER['REQUEST_METHOD'] === 'GET'){

    // Seleciona os dados da tabela lubrificantes para exibir na tabela HTML
    $sql_select = "SELECT lu_id, lu_nome FROM lubrificantes";
    $stmt_select = $conn->prepare($sql_select) or die ($conn->error);
    $stmt_select->execute();
    $resultado = $stmt_select->get_result();

    // Exibir os dados em uma tabela HTML
    while ($row = $resultado->fetch_assoc()) {
        echo '<tr><td>' . $row['lu_id'] . '</td><td>' . $row['lu_nome'] . '</td></tr>';
    }

    // Fecha o statement de select
    $stmt_select->close();

}

//Fecha a conexão com o banco de dados
$conn->close();
?>
