<?php
// Incluir o arquivo de conexão com o banco de dados
include 'conexaobd.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tipo']) && $_GET['tipo'] === 'select'){

$nome = $_SESSION["nome"];
$query = "SELECT us_cliente FROM usuarios WHERE us_nome = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $nome);
$stmt->execute();
$stmt->bind_result($id_cliente); // Associa o resultado da consulta à variável $id_cliente
$stmt->fetch();
$stmt->close();

$sql_select = "SELECT a.ap_id, c.cl_nome, e.eq_nome, a.ap_valor, a.ap_data 
               FROM apontamentos a
               INNER JOIN clientes c ON a.ap_cliente = c.cl_id
               INNER JOIN equipamentos e ON a.ap_equipamento = e.eq_id
               WHERE c.cl_id = $id_cliente";
$stmt_select = $conn->prepare($sql_select) or die ($conn->error);
$stmt_select->execute();
$resultado = $stmt_select->get_result();

// Exibir os dados em uma tabela HTML
while ($row = $resultado->fetch_assoc()) {
    echo '<tr><td>' . $row['ap_id'] . '</td><td>' . $row['cl_nome'] . '</td><td>' . $row['eq_nome'] . '</td><td>' . $row['ap_valor'] . '</td><td>' . $row['ap_data'] . '</td></tr>';
}

// Fecha o statement de select
$stmt_select->close();

}

// Fechar a conexão com o banco de dados
$conn->close();
?>
