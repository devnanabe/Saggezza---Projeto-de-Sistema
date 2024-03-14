<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Salvar imagem</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="salvarimgadm.css" media="screen"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/f9ec6cbf8e.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="topo">
            <div class="content">
                <div class="user-info">
                    <label id="nome-usuario">nome usuario</label>
                    <button id="logout"><i class="fa-solid fa-right-from-bracket"></i> Sair</button>
                </div>
            </div>
        </div>
        <nav class="sidebar">
            <div class="logo">
                <img class="img-logo" src="../Imagens/logo-sem-nome.png" alt="Logo sem título"> <!-- Para puxar uma imagem que está na outra pasta, temos que usar .. primeiro-->
                <span class="nomelogo">Intelligent Systems</span>
                <i class='bx bx-menu' id="btn-menu"></i> <!-- Botão de menu -->
            </div>
            <ul class="lista">
                <li class="item-menu">
                    <a href="cadclienteadm.html">
                        <i class="fa-solid fa-users"></i>
                        <span class="nome-item"">Cadastrar cliente</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="cadmaquina.html">
                        <i class="fa-solid fa-gear"></i>
                        <span class="nome-item">Cadastrar máquina</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="cadequipadm.html">
                        <i class="fa-solid fa-hammer"></i>
                        <span class="nome-item">Cadastrar equipamento</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="cadfabadm.html">
                        <i class="fa-solid fa-industry"></i>
                        <span class="nome-item">Cadastrar fabricante</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="cadlubadm.html">
                        <i class="fa-solid fa-oil-can"></i>
                        <span class="nome-item">Cadastrar lubrificante</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="cadusuarioadm.html">
                        <i class="fa-solid fa-user-plus"></i>
                        <span class="nome-item">Cadastrar usuário</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="lancarapontadm.html">
                        <i class="fa-solid fa-pen"></i>
                        <span class="nome-item">Lançar apontamento</span>
                    </a>
                </li>
                <li class="item-menu active">
                    <a href="salvarimgadm.html">
                        <i class='bx bxs-image-add'></i>
                        <span class="nome-item">Salvar imagem</span>
                    </a>
                </li>
                <li class="item-menu">
                    <a href="reportarsinalizacaoadm.html">
                        <i class="fa-solid fa-flag"></i>
                        <span class="nome-item">Reportar sinalizações</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <div class="conteudo-principal">
        <div class="container-form">
            <h2 class="tituloform">Salvar imagem</h2>
            <form action="" class="formulario">
                <div class="left">
                    <label class="lbtxt" for="cliente-sel">Cliente:</label>
                    <br>
                    <select id="cliente-sel">
                        <option value="Cli1">Cliente 1</option>
                        <option value=Cli2">Cliente 2</option>
                    </select>
                    <br>
                    <label class="lbtxt" for="equip-sel">Equipamento:</label>
                    <br>
                    <select id="equip-sel">
                        <option value="Cli1">Equipamento 1</option>
                        <option value=Cli2">Equipamento 2</option>
                    </select>
                    <br>
                </div>
                <div class="right">
                    <label class="lbtxt" for="valor">Upload do documento:</label>
                    <br>
                    <div class="importar-img">
                        <label class="txt-img">Nome do arquivo</label>
                        <button id="btn-importar">Browse</button>
                    </div>
                    <br>
                    <label class="lbtxt" for="data">Data/Hora:</label>
                    <br>
                    <input type="datetime-local" id="data">
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
                            <th>EMAIL</th>
                            <th>CLIENTE</th>
                            <th>TELEFONE</th>
                            <th>RESPONSÁVEL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>cliente1@email.com</td>
                            <td>Cliente 1</td>
                            <td>(11) 1234-5678</td>
                            <td>Administrador 1</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>cliente2@email.com</td>
                            <td>Cliente 2</td>
                            <td>(22) 2345-6789</td>
                            <td>Operacional 1</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>cliente3@email.com</td>
                            <td>Cliente 3</td>
                            <td>(33) 3456-7890</td>
                            <td>Administrador 1</td>
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