<?php
    session_start();

    if(empty($_SESSION)){
    
    print "<script>location.href= '../index.php';</script>";

    }

    include '../dbconnect.php'; // inclua o arquivo de conexão com o banco de dados

    $nome = $_SESSION["nome"];
    $query = "SELECT us_cliente FROM usuarios WHERE us_nome = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $nome);
    $stmt->execute();
    $stmt->bind_result($id_cliente); // Associa o resultado da consulta à variável $id_cliente
    $stmt->fetch();
    $stmt->close();
    
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Js/homecliente.js"></script>

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
                    WHERE c.cl_id = $id_cliente";
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
        <div class="grafico">
            <!-- CHAMANDO O GRÁFICO -->
            <div id="curve_chart" style="width: 100%%; 
                                        height: 350px; 
                                        border-radius: 15px;
                                        border: 2px solid #0B4983;"></div>
        </div>
        <div class="btn-group">
            <button class="btn-baixar" id="baixarPDF" name="baixarPDF">Baixar PDF</button>
            
            <button class="btn-baixar" id="baixarCSV" name="baixarCSV">Baixar CSV</button>
        </div>
    </div>
    <div class="container-tabela">
        <br><br><br>
                <table class="tabela" id="tabela-dados">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>CLIENTE</th>
                            <th>EQUIPAMENTO</th>
                            <th>DATA E HORA</th>
                            <th>VALOR</th>
                        </tr>
                    </thead>
                    <tbody id="dados">
                    <!-- Conteúdo da tabela aqui -->
                    </tbody>
                </table>
        <br><br>
    </div>
    <script>
        document.getElementById('baixarPDF').addEventListener('click', function() {
        window.location.href = '../Php/relatorio.php';
        });

        document.getElementById('baixarCSV').addEventListener('click', function() {
        window.location.href = '../Php/csv.php';
        });
    </script>
</body>
</html>