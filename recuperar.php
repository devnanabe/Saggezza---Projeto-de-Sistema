<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar senha</title>
    <link rel="icon" type="image/png" href="Imagens/logo-saggezza.png">
    <link rel="stylesheet" href="recuperar.css" media="screen">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="img-login">
                <img src="Imagens/logo-saggezza-titulo.png" alt="Imagem com logo">
            </div>
            <form action="config.php" method="POST" class="form-recuperar">
                <div class="logo-titulo">
                    <img src="Imagens/logo-saggezza.png" alt="Imagem com logo">
                </div>
                <h2 class="titulo">RECUPERAR SENHA</h2>
                <div class="campo-txt">
                    <input type="email" name="email" placeholder="Email" class="form-control" required>
                </div>
                <br>
                <input type="submit" name="enviar" value="Enviar" class="form-control">
            </form>
        </div>
    </div>
</body>
</html>