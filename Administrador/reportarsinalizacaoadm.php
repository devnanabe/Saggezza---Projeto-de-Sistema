<?php
    session_start();

    if(empty($_SESSION)){
    
    print "<script>location.href= '../index.php';</script>";

    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Reportar sinalizações</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="reportarsinalizacaoadm.css" media="screen"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="../Imagens/logo-saggezza.png">
    <script src="https://kit.fontawesome.com/f9ec6cbf8e.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../Js/reportarsinalizacao.js"></script>
</head>
<body>
    <header>
        <div class="topo">
            <div class="content">
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
            </div>
        </div>
        <nav class="sidebar">
            <div class="logo">
                <img class="img-logo" src="../Imagens/logo-saggezza.png" alt="Logo sem título"> <!-- Para puxar uma imagem que está na outra pasta, temos que usar .. primeiro-->
                <span class="nomelogo">Saggezza</span>
                <i class='bx bx-menu' id="btn-menu"></i> <!-- Botão de menu -->
            </div>
            <ul class="lista">
                <li class="item-menu">
                    <a href="cadclienteadm.php">
                        <i class="fa-solid fa-users"></i>
                        <span class="nome-item"">Cadastrar cliente</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="cadmaquina.php">
                        <i class="fa-solid fa-gear"></i>
                        <span class="nome-item">Cadastrar máquina</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="cadequipadm.php">
                        <i class="fa-solid fa-hammer"></i>
                        <span class="nome-item">Cadastrar equipamento</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="cadfabadm.php">
                        <i class="fa-solid fa-industry"></i>
                        <span class="nome-item">Cadastrar fabricante</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="cadlubadm.php">
                        <i class="fa-solid fa-oil-can"></i>
                        <span class="nome-item">Cadastrar lubrificante</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="cadusuarioadm.php">
                        <i class="fa-solid fa-user-plus"></i>
                        <span class="nome-item">Cadastrar usuário</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="lancarapontadm.php">
                        <i class="fa-solid fa-pen"></i>
                        <span class="nome-item">Lançar apontamento</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="salvarimgadm.php">
                        <i class='bx bxs-image-add'></i>
                        <span class="nome-item">Salvar imagem</span>
                    </a>
                </li>
                <li class="item-menu active">
                    <a href="#">
                        <i class="fa-solid fa-flag"></i>
                        <span class="nome-item">Reportar sinalizações</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="conteudo-principal">
        <div class="container-form">
            <h2 class="tituloform">Reportar sinalizações</h2>
            <form method="POST" action="" class="formulario">
                <div class="left">
                <label class="lbtxt" for="clienteSelect">Cliente:</label>
                    <br>
                    <select id="clienteSelect" name="clienteSelect">
                        <option value="">Selecione um cliente..</option>
                    </select>
                    <br>
                    <label class="lbtxt" for="equipamentoSelect">Equipamento:</label>
                    <br>
                    <select id="equipamentoSelect" name="equipamentoSelect">
                        <option value="">Selecione um equipamento..</option>
                    </select>
                    <br>
                    <label class="lbtxt" for="data">Data/Hora:</label>
                    <br>
                    <input type="datetime-local" id="data" name="data">
                    <br>
                </div>
                <div class="right">
                    <label class="lbtxt" for="sinalizacao">Sinalização:</label>
                    <br>
                    <textarea id="sinalizacao" name="sinalizacao" placeholder="Escreva aqui..."></textarea>
                    <br>
                    <div class="btn-group">
                        <input type="reset" value="Limpar">
                        <input type="submit" id="btn-salvar" name="btn-salvar" value="Salvar">
                    </div>
                </div>
            </form>
        </div>
        <br>
        <div class="container-tabela">
            <div class="barra-pesquisa">
                <input type="text" id="inputFiltro" placeholder="Pesquisar" class="campopesquisar">
                <button id="btn-pesquisa"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <br><br><br><br>
            <table class="tabela" id="tabela-dados">
                <thead>
                        <tr>
                        <th>ID</th>
                        <th>CLIENTE</th>
                        <th>EQUIPAMENTO</th>
                        <th>SINALIZAÇÃO</th>
                        <th>DATA</th>
                        </tr>
                    </thead>
                    <tbody id="dados">
                    <!-- Conteúdo da tabela aqui -->
                    </tbody>
                </table>
            </div>
    </div>
</body>
<script>
     // Configurando animação do menu
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.querySelector('.sidebar');
        const btnMenu = document.querySelector('#btn-menu');
        const conteudoPrincipal = document.querySelector('.conteudo-principal');

        // Verificando se o estado do menu foi armazenado no localStorage
        const isMenuActive = localStorage.getItem('isMenuActive');
        if (isMenuActive === 'true') {
            sidebar.classList.add('active');
            conteudoPrincipal.classList.add('active');
        }

        btnMenu.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            conteudoPrincipal.classList.toggle('active');

            // Salvar o estado do menu no localStorage
            const isActive = sidebar.classList.contains('active');
            localStorage.setItem('isMenuActive', isActive);
        });
    });
</script>
</html>