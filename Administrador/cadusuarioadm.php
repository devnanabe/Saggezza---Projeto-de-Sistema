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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Js/cadusuario.js"></script>
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
            <form method="POST" action="" id="formCadastroUsuario" class="formulario">
                <div class="left">
                    <label class="lbtxt" for="username">Usuário:</label>
                    <br>
                    <input type="text" id="username" name="username" placeholder="Nome do usuário">
                    <br>
                    <label class="lbtxt" for="telefone">Telefone:</label>
                    <br>
                    <input type="text" id="telefone" name="telefone" placeholder="(00)00000-0000">
                    <br>
                    <label class="lbtxt" for="email">Email:</label>
                    <br>
                    <input type="email" id="email" name="email" placeholder="usuario@email.com">
                    <br>
                    <div class="btn-group">
                        <button class="btn-form" id="btn-excluir" name="btn-excluir">Excluir</button>
                        <button class="btn-form" id="btn-atualizar" name="btn-atualizar">Atualizar</button>
                    </div>
                </div>
                <div class="right">
                    <label class="lbtxt" for="tipo-usuario">Tipo:</label>
                    <br>
                    <select id="tipo-usuario" name="tipo-usuario">
                        <option value="">Selecione um usuario..</option>
                    </select>
                    <br>
                    <label class="lbtxt" for="tipo-cliente">Cliente:</label>
                    <br>
                    <select id="tipo-cliente" name="tipo-cliente">
                        <option value="">Selecione um cliente..</option>
                    </select>
                    <br>
                    <div class="btn-group2">
                        <input type="reset" id="btn-reset" name="btn-reset" value="Limpar" class="btn2">
                        <input type="submit" id="btn-salvar" name="btn-salvar" value="Salvar" class="btn2">
                        <input type="submit" name="btn-pagina" id="btn-pagina" value="Atualizar pagina" class="btn2">

                    </div>
                </div>
            </form>
        </div>
        <br>
        <div class="container-tabela">
            <div class="barra-pesquisa">
                <input type="text" id="inputFiltro" placeholder="Pesquisar">
                <button id="btn-pesquisa"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <br><br><br><br>
            <table class="tabela" id="tabela-dados">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>USUARIO</th>
                        <th>TELEFONE</th>
                        <th>EMAIL</th>
                        <th>TIPO</th>
                        <th>CLIENTE</th>
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