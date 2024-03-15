<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="Imagens/logo-saggezza.png">
    <link rel="stylesheet" href="index.css" media="screen">
    <script src="https://kit.fontawesome.com/f9ec6cbf8e.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="img-login">
                <img src="Imagens/logo-saggezza-titulo.png" alt="Imagem com logo">
            </div>      
            <form action="login.php" method="POST" class="form-login"> 
                <div class="logo-titulo">
                    <img src="Imagens/logo-saggezza.png" alt="Imagem com logo">
                </div>
                <h2 class="titulo">LOGIN</h2>
                <div class="campo-txt">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="text" name="email" class="form-control" placeholder="Email">
                </div>
                <br>
                <div class="campo-txt">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="senha" class="form-control" placeholder="Senha">
                </div>
                <a href="recuperar.php" class="btn-redefsenha">Esqueci minha senha</a>
                <br>
                <button type="submit" class="btn btn-primary btn-login">Entrar</button>     
            </form>
        </div>
    </div>
</body>
</html>