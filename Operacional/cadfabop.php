<?php
    session_start();

    if(empty($_SESSION)){
    
    print "<script>location.href= '../index.php';</script>";

    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar fabricante</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="cadfabop.css" media="screen"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/png" href="../Imagens/logo-saggezza.png">
    <script src="https://kit.fontawesome.com/f9ec6cbf8e.js" crossorigin="anonymous"></script>
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
                    <a href="cadclienteop.php">
                        <i class="fa-solid fa-users"></i>
                        <span class="nome-item"">Cadastrar cliente</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="cadmaquinaop.php">
                        <i class="fa-solid fa-gear"></i>
                        <span class="nome-item">Cadastrar máquina</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="cadequipop.php">
                        <i class="fa-solid fa-hammer"></i>
                        <span class="nome-item">Cadastrar equipamento</span>
                    </a>
                </li>
                <li class="item-menu active">
                    <a href="#">
                        <i class="fa-solid fa-industry"></i>
                        <span class="nome-item">Cadastrar fabricante</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="cadlubop.php">
                        <i class="fa-solid fa-oil-can"></i>
                        <span class="nome-item">Cadastrar lubrificante</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="lancarapontop.php">
                        <i class="fa-solid fa-pen"></i>
                        <span class="nome-item">Lançar apontamento</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="salvarimgop.php">
                        <i class='bx bxs-image-add'></i>
                        <span class="nome-item">Salvar imagem</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="reportarsinalizacaoop.php">
                        <i class="fa-solid fa-flag"></i>
                        <span class="nome-item">Reportar sinalizações</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="conteudo-principal">
        <div class="container-form">
            <h2 class="tituloform">Cadastrar fabricante</h2>
            <form action="" class="formulario">
                <div class="left">
                    <label class="lbtxt" for="nome-fab">Fabricante:</label>
                    <br>
                    <input type="text" id="nome-fab" placeholder="Nome do fabricante">
                    <br>
                </div>
                <div class="right">
                    <br>
                    <div class="btn-group">
                        <input type="reset" value="Limpar">
                        <input type="submit" id="btn-salvar" value="Salvar">
                    </div>
                </div>
            </form>
        </div>
            <br>
            <div class="container-tabela">
            <div class="barra-pesquisa">
                <input type="text" placeholder="Pesquisar">
                <button id="btn-pesquisa"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <br><br><br><br>
            <table class="tabela">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME DO FABRICANTE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Fabricante 1</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Fabricante 2</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Fabricante 3</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Fabricante 4</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Fabricante 5</td>
                    </tr>
                </tbody>
            </table>
            </div>
    </div>
</body>
<script>
    //Configurando animação do menu
    const sidebar = document.querySelector('.sidebar');
    const btnMenu = document.querySelector('#btn-menu');
    const conteudoPrincipal = document.querySelector('.conteudo-principal');

    btnMenu.addEventListener('click', () => {
        sidebar.classList.toggle('active');
        conteudoPrincipal.classList.toggle('active');
    });
</script>
</html>