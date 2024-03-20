<?php
// Inclua a biblioteca TCPDF
require_once('../tcpdf/tcpdf.php');
session_start();

// Crie uma nova instância TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Defina as informações do documento PDF
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Relatório de Clientes');
$pdf->SetSubject('Relatório de Clientes');
$pdf->SetKeywords('TCPDF, PDF, exemplo, PHP, MySQL, relatório, clientes');

// Defina as margens
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Defina o modo de fonte padrão
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Defina o tamanho da fonte
$pdf->SetFont('helvetica', '', 11);

// Adicione uma página
$pdf->AddPage();

// Conexão com o banco de dados
include 'conexaobd.php'; 

$nome = $_SESSION["nome"];
$query = "SELECT us_cliente FROM usuarios WHERE us_nome = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('s', $nome);
$stmt->execute();
$stmt->bind_result($id_cliente); // Associa o resultado da consulta à variável $id_cliente
$stmt->fetch();
$stmt->close();

// Consulta para obter os dados da tabela clientes
$query = "SELECT a.ap_id, c.cl_nome, e.eq_nome, a.ap_valor, a.ap_data 
            FROM apontamentos a
            INNER JOIN clientes c ON a.ap_cliente = c.cl_id
            INNER JOIN equipamentos e ON a.ap_equipamento = e.eq_id
            WHERE c.cl_id = $id_cliente";
$result = mysqli_query($conn, $query);

// Cabeçalho da tabela
$html = '<h1>Relatório de Clientes</h1>
         <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Equipamento</th>
                    <th>valor</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>';

// Loop para adicionar os dados da tabela ao HTML
while ($row = mysqli_fetch_assoc($result)) {
    $html .= '<tr>
                <td>'.$row['ap_id'].'</td>
                <td>'.$row['cl_nome'].'</td>
                <td>'.$row['eq_nome'].'</td>
                <td>'.$row['ap_valor'].'</td>
                <td>'.$row['ap_data'].'</td>
              </tr>';
}

$html .= '</tbody></table>';

// Adicione o HTML ao PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Feche a página
$pdf->lastPage();

// Saída do PDF
$pdf->Output('relatorio_clientes.pdf', 'I');
