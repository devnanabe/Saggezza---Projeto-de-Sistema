<?php
// Incluir o arquivo de conexão com o banco de dados
include 'conexaobd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clienteId']) && isset($_POST['equipamentoId']) && isset($_POST['valor']) && isset($_POST['data'])){
    // Verificar se os dados foram recebidos
        $cliente = $_POST['clienteId'];
        $equipamento = $_POST['equipamentoId'];
        $valor = $_POST['valor'];
        $data = $_POST['data'];

        $dataFormatada = date('Y-m-d', strtotime($data));

        // Inserção de dados usando prepared statement
        $sqlInsert = "INSERT INTO apontamentos (ap_equipamento, ap_cliente, ap_valor, ap_data) VALUES (?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param('iids', $equipamento, $cliente, $valor, $dataFormatada);
        $stmtInsert->execute();

        // Verificar se a inserção foi bem-sucedida
        if ($stmtInsert->affected_rows > 0) {
            echo 'Máquina cadastrada com sucesso!';
        } else {
            echo 'Erro ao cadastrar máquina.';
        }

        $stmtInsert->close(); // Fecha o statement de insert
    
}else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tipo']) && $_GET['tipo'] === 'todos'){
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
    
    // Consulta para obter os equipamentos
    $sqlEquipamentos = "SELECT eq_id, eq_nome FROM equipamentos";
    $stmtEquipamentos = $conn->prepare($sqlEquipamentos);
    $stmtEquipamentos->execute();
    $resultEquipamentos = $stmtEquipamentos->get_result();

    $equipamentos = array();

    // Verificar se há resultados da consulta de equipamentos
    if ($resultEquipamentos->num_rows > 0) {
        while($row = $resultEquipamentos->fetch_assoc()) {
            $equipamentos[] = array(
                'eq_id' => $row['eq_id'],
                'eq_nome' => $row['eq_nome']
            );
        }
    }

    // Retornar os dados como JSON
    echo json_encode(array('clientes' => $clientes, 'equipamentos' => $equipamentos));
    $stmtClientes->close();
    $stmtEquipamentos->close();
}else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tipo']) && $_GET['tipo'] === 'select'){

    $sql_select = "SELECT a.ap_id, c.cl_nome, e.eq_nome, a.ap_valor, a.ap_data 
                FROM apontamentos a
                INNER JOIN clientes c ON a.ap_cliente = c.cl_id
                INNER JOIN equipamentos e ON a.ap_equipamento = e.eq_id";
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
