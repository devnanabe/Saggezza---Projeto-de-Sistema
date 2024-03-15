<?php
    session_start();

    if(empty($_SESSION)){
    
    print "<script>location.href= '../index.php';</script>";

    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Cadastrar usuário</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="cadusuarioadm.css" media="screen"/>
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
                <li class="item-menu active">
                    <a href="#">
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
                <li class="item-menu">
                    <a href="reportarsinalizacaoadm.php">
                        <i class="fa-solid fa-flag"></i>
                        <span class="nome-item">Reportar sinalizações</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="conteudo-principal">
        <div class="container-form">
            <h2 class="tituloform">Cadastrar usuário</h2>
            <form action="" class="formulario">
                <div class="left">
                    <label class="lbtxt" for="username">Usuário:</label>
                    <br>
                    <input type="text" id="username" placeholder="Nome do usuário">
                    <br>
                    <label class="lbtxt" for="senha">Senha:</label>
                    <br>
                    <input type="text" id="senha" placeholder="Senha do usuário">
                    <br>
                    <label class="lbtxt" for="telefone">Telefone:</label>
                    <br>
                    <input type="number" id="telefone" placeholder="(00)00000-0000">
                    <br>
                    <div class="btn-group">
                        <button class="btn-form" id="env-senha">Enviar senha</button>
                        <button class="btn-form" id="excluir">Excluir</button>
                        <button class="btn-form" id="atualizar">Atualizar</button>
                    </div>
                </div>
                <div class="right">
                    <label class="lbtxt" for="email">Email:</label>
                    <br>
                    <input type="email" id="email" placeholder="usuario@email.com">
                    <br>
                    <label class="lbtxt" for="tipo-usuario">Tipo:</label>
                    <br>
                    <select id="tipo-usuario">
                        <option value="Tipo1">Tipo 1</option>
                        <option value=Tipo2">Tipo 2</option>
                    </select>
                    <br>
                    <label class="lbtxt" for="cliente">Cliente:</label>
                    <br>
                    <select id="tipo-usuario">
                        <option value="Cli1">Cliente 1</option>
                        <option value=Cli2">Cliente 2</option>
                    </select>
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
                        <th>USUARIO</th>
                        <th>SENHA</th>
                        <th>TELEFONE</th>
                        <th>EMAIL</th>
                        <th>TIPO</th>
                        <th>DATA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Usuario 1</td>
                        <td>********</td>
                        <td>(00)00000-0000</td>
                        <td>usuario@email.com</td>
                        <td>Tipo 1</td>
                        <td>00/00/00 00:00</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Usuario 2</td>
                        <td>********</td>
                        <td>(00)00000-0000</td>
                        <td>usuario@email.com</td>
                        <td>Tipo 1</td>
                        <td>00/00/00 00:00</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Usuario 3</td>
                        <td>********</td>
                        <td>(00)00000-0000</td>
                        <td>usuario@email.com</td>
                        <td>Tipo 2</td>
                        <td>00/00/00 00:00</td>
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