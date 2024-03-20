<?php

include 'conexaobd.php';
session_start();


$nome = $_SESSION["nome"];
$query = "SELECT us_cliente FROM usuarios WHERE us_nome = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $nome);
$stmt->execute();
$stmt->bind_result($id_cliente); // Associa o resultado da consulta à variável $id_cliente
$stmt->fetch();
$stmt->close();


// Query para buscar dados do banco de dados (substitua pela sua consulta)
$sql = "SELECT a.ap_id, c.cl_nome, e.eq_nome, a.ap_valor, a.ap_data 
        FROM apontamentos a
        INNER JOIN clientes c ON a.ap_cliente = c.cl_id
        INNER JOIN equipamentos e ON a.ap_equipamento = e.eq_id
        WHERE c.cl_id = $id_cliente";
$result = $conn->query($sql);

// Verifique se há resultados
if ($result->num_rows > 0) {
    // Cria o cabeçalho CSV
    $csv = "ID,CLIENTE,EQUIPAMENTO,VALOR,DATA\n";
    
    // Adiciona os dados ao CSV
    while($row = $result->fetch_assoc()) {
        $csv .= $row["ap_id"] . "," . $row["cl_nome"] . "," . $row["eq_nome"] . "," . $row["ap_valor"] . "," . $row["ap_data"] ."\n";
    }

    // Define os cabeçalhos para download do arquivo CSV
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="dados.csv";');

    // Envia o conteúdo CSV para o navegador
    echo $csv;
} else {
    echo "Nenhum dado encontrado.";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
