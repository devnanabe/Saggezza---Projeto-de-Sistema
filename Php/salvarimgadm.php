<?php
// Incluir o arquivo de conexão com o banco de dados
include 'conexaobd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['arquivo']) && isset($_POST['cliente']) && isset($_POST['equipamento']) && isset($_POST['data'])){
    // Verificar se os dados foram recebidos
        $cliente = $_POST['cliente'];
        $equipamento = $_POST['equipamento'];
        $data = $_POST['data'];
        $dataFormatada = date('Y-m-d', strtotime($data));

        if ($_FILES['arquivo']) {
    
            $fileName = $_FILES['arquivo']['name'];
            $fileTmpName = $_FILES['arquivo']['tmp_name'];
            $newName = uniqid();
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
            $uploadDir = '../Upload/';

            $uploadPath = $uploadDir . $newName . "." . $ext;
            
        
            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                // Inserir no banco de dados
                $sqlInsert = "INSERT INTO imagens (im_cliente, im_equipamento, im_data, im_nome_image, im_path_image) VALUES (?, ?, ?, ?, ?)";
                $stmtInsert = $conn->prepare($sqlInsert);
                $stmtInsert->bind_param('iisss', $cliente, $equipamento, $dataFormatada, $fileName, $uploadPath);
                $stmtInsert->execute();

                // Verificar se a inserção foi bem-sucedida
                if ($stmtInsert->affected_rows > 0) {
                    echo 'Arquivo enviado e inserido no banco de dados com sucesso.';
                } else {
                    echo 'Erro ao inserir arquivo no banco de dados: ';
                }

            } else {
                echo "Erro ao fazer upload do arquivo.";
            }
        }
        $stmtInsert->close(); // Fecha o statement do insert
    
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

    $sql_select = "SELECT i.im_id, c.cl_nome, e.eq_nome, i.im_nome_image, i.im_path_image, i.im_data
                FROM imagens i
                INNER JOIN clientes c ON i.im_cliente = c.cl_id
                INNER JOIN equipamentos e ON i.im_equipamento = e.eq_id";
    $stmt_select = $conn->prepare($sql_select) or die ($conn->error);
    $stmt_select->execute();
    $resultado = $stmt_select->get_result();

    // Exibir os dados em uma tabela HTML
    while ($row = $resultado->fetch_assoc()) {
        echo '<tr><td>' . $row['im_id'] . '</td><td>' . $row['cl_nome'] . '</td><td>' . $row['eq_nome'] . '</td><td>' . $row['im_nome_image'] . '</td><td>' . $row['im_path_image'] . '</td><td>' . $row['im_data'] . '</td></tr>';
    }

    // Fecha o statement de select
    $stmt_select->close();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
