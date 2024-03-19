<?php
    session_start();

    if(empty($_SESSION)){
    
    print "<script>location.href= '../index.php';</script>";

    }

    include '../dbconnect.php'; // inclua o arquivo de conexão com o banco de dados
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

    <!-- CONSTRUÇÃO DO GRÁFICO DE LINHA - GOOGLE CHARTS -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Valor'],
          <?php
            $query="SELECT a.ap_data, a.ap_valor
                    FROM apontamentos a
                    INNER JOIN clientes c ON a.ap_cliente = c.cl_id
                    INNER JOIN equipamentos e ON a.ap_equipamento = e.eq_id
                    WHERE c.cl_id = 2";
            $result=mysqli_query($conn,$query);
            while($data=mysqli_fetch_array($result)){
                $date=htmlspecialchars($data['ap_data']); // Escapar para evitar problemas de formatação no JavaScript
                $valor=floatval($data['ap_valor']); // Converte para float, como é um valor numerico
            
            ?>
                ['<?php echo $date;?>', <?php echo $valor;?>],
            <?php
            }
          ?>

        ]);

        var formatter = new google.visualization.NumberFormat({pattern: '0.00'}); // Define o formato para duas casas decimais
        formatter.format(data, 1);

        var options = {
            backgroundColor: 'transparent',
            title: 'Estatísticas de Uso do Equipamento',
            curveType: 'function',
            fontSize: 16,
            tooltip: { 
                textStyle: {
                    fontSize: 12 // Define o tamanho da fonte do tooltip para 12
                },
                    width: 'auto'
            },
            tooltip: { width: 'auto' },
            legend: { position: 'bottom' },

        };
        

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
      
      window.addEventListener('resize', function(){
          location.reload();
      });
    </script>

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
            <!-- CHAMANDO O GRÁFICO -->
            <div id="curve_chart" style="width: 100%%; 
                                        height: 350px; 
                                        border-radius: 15px;
                                        border: 2px solid #0B4983;"></div>
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