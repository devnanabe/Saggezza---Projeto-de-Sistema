<?php
// Incluir o arquivo de conexão com o banco de dados
include 'conexaobd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['clienteId']) && isset($_POST['equipamentoId']) && isset($_POST['maquinaId']) && isset($_POST['lubrificanteId']) && isset($_POST['fabricanteId'])){
    // Verificar se os dados foram recebidos
        $cliente = $_POST['clienteId'];
        $equipamento = $_POST['equipamentoId'];
        $maquina = $_POST['maquinaId'];
        $lubrificante = $_POST['lubrificanteId'];
        $fabricante = $_POST['fabricanteId'];

        // Inserção de dados usando prepared statement
        $sqlInsert = "INSERT INTO maquinas (ma_equipamento, ma_cliente, ma_fabricante, ma_tipo, ma_lubrificante) VALUES (?, ?, ?, ?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param('iiiii', $equipamento, $cliente, $fabricante, $maquina, $lubrificante);
        $stmtInsert->execute();

        $stmtInsert->close(); // Fechar instrução preparada
    
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

    // Consulta para obter as máquinas
    $sqlMaquinas = "SELECT tm_id, tm_tipo FROM tipos_maquina";
    $stmtMaquinas = $conn->prepare($sqlMaquinas);
    $stmtMaquinas->execute();
    $resultMaquinas = $stmtMaquinas->get_result();

    $maquinas = array();

    // Verificar se há resultados da consulta de máquinas
    if ($resultMaquinas->num_rows > 0) {
        while($row = $resultMaquinas->fetch_assoc()) {
            $maquinas[] = array(
                'tm_id' => $row['tm_id'],
                'tm_tipo' => $row['tm_tipo']
            );
        }
    }

    // Consulta para obter os lubrificantes
    $sqlLubrificantes = "SELECT lu_id, lu_nome FROM lubrificantes";
    $stmtLubrificantes = $conn->prepare($sqlLubrificantes);
    $stmtLubrificantes->execute();
    $resultLubrificantes = $stmtLubrificantes->get_result();

    $lubrificantes = array();

    // Verificar se há resultados da consulta de lubrificantes
    if ($resultLubrificantes->num_rows > 0) {
        while($row = $resultLubrificantes->fetch_assoc()) {
            $lubrificantes[] = array(
                'lu_id' => $row['lu_id'],
                'lu_nome' => $row['lu_nome']
            );
        }
    }

    // Consulta para obter os fabricantes
    $sqlFabricantes = "SELECT fa_id, fa_nome FROM fabricantes";
    $stmtFabricantes = $conn->prepare($sqlFabricantes);
    $stmtFabricantes->execute();
    $resultFabricantes = $stmtFabricantes->get_result();

    $fabricantes = array();

    // Verificar se há resultados da consulta de fabricantes
    
    if ($resultFabricantes->num_rows > 0) {
        while($row = $resultFabricantes->fetch_assoc()) {
            $fabricantes[] = array(
                'fa_id' => $row['fa_id'],
                'fa_nome' => $row['fa_nome']
            );
        }
    }

    // Retornar os dados como JSON
    echo json_encode(array('clientes' => $clientes, 'equipamentos' => $equipamentos, 'maquinas' => $maquinas, 'lubrificantes' => $lubrificantes, 'fabricantes' => $fabricantes));
    $stmtClientes->close();
    $stmtEquipamentos->close();
    $stmtMaquinas->close();
    $stmtLubrificantes->close();
    $stmtFabricantes->close();
}else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['tipo']) && $_GET['tipo'] === 'select'){

$sql_select = "SELECT m.ma_id, c.cl_nome, e.eq_nome, tm.tm_tipo, l.lu_nome, f.fa_nome 
               FROM maquinas m
               INNER JOIN clientes c ON m.ma_cliente = c.cl_id
               INNER JOIN equipamentos e ON m.ma_equipamento = e.eq_id
               INNER JOIN tipos_maquina tm ON m.ma_tipo = tm.tm_id
               INNER JOIN lubrificantes l ON m.ma_lubrificante = l.lu_id
               INNER JOIN fabricantes f ON m.ma_fabricante = f.fa_id;";
$stmt_select = $conn->prepare($sql_select) or die ($conn->error);
$stmt_select->execute();
$resultado = $stmt_select->get_result();

// Exibir os dados em uma tabela HTML
while ($row = $resultado->fetch_assoc()) {
    echo '<tr><td>' . $row['ma_id'] . '</td><td>' . $row['cl_nome'] . '</td><td>' . $row['eq_nome'] . '</td><td>' . $row['tm_tipo'] . '</td><td>' . $row['lu_nome'] . '</td><td>' . $row['fa_nome'] . '</td></tr>';
}

//fechar o statement de select
$stmt_select->close();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
