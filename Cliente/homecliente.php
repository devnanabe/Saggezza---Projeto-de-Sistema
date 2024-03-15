<?php
    session_start();

    if(empty($_SESSION)){
    
    print "<script>location.href= '../index.php';</script>";

    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="homecliente.css" media="screen"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="../Imagens/logo-saggezza.png">
    <script src="https://kit.fontawesome.com/f9ec6cbf8e.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="menu-bar">
        <div class="logo">
            <img class="img-logo" src="../Imagens/logo-saggezza.png">
            <span class="nome-logo">Saggezza</span>
        </div>
        <div class="user-info">
            <label id="nome-usuario">
                <?php
                    echo " " . $_SESSION["nome"];   
                ?>
            </label>
            <button id="logout"><i class="fa-solid fa-right-from-bracket"></i>
            <?php 
                print "<a href='../logout.php' class='btn btn-white'>Sair</a>"
            ?>
            </button>
        </div>
    </nav>
    <div class="container-grafico">
        <div class="filtros">
            <span class="filtro-txt">Equipamento:</span>
            <select id="equipamento">
                <option value="Equip1">Equipamento 1</option>
                <option value="Equip2">Equipamento 2</option>
            </select>
            <span class="filtro-txt">Dados do(s):</span>
            <select id="dados">
                <option value="dias">Últimos 3 dias</option>
                <option value="semana">Última semana</option>
                <option value="meses">Últimos 3 meses</option>
                <option value="ano">Último ano</option>
            </select>
        </div>
        <div class="grafico">

        </div>
        <div class="btn-group">
            <button class="btn-baixar" id="baixarPDF">Baixar PDF</button>
            <button class="btn-baixar" id="baixarCSV">Baixar CSV</button>
        </div>
    </div>
    <div class="container-tabela">
        <br><br><br>
        <table class="tabela">
            <thead>
                <tr>
                    <th>CLIENTE</th>
                    <th>EQUIPAMENTO</th>
                    <th>DATA E HORA</th>
                    <th>VALOR</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cliente</td>
                    <td>Equipamento 1</td>
                    <td>00/00/00 00:00</td>
                    <td>000</td>
                </tr>
                <tr>
                    <td>Cliente</td>
                    <td>Equipamento 2</td>
                    <td>00/00/00 00:00</td>
                    <td>000</td>
                </tr>
                <tr>
                    <td>Cliente</td>
                    <td>Equipamento 1</td>
                    <td>00/00/00 00:00</td>
                    <td>000</td>
                </tr>
            </tbody>
        </table>
        <br><br>
    </div>
</body>
</html>