<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="Imagens/logo-saggezza.png"> <!-- icone da página -->
    <link rel="stylesheet" href="index.css" media="screen">
    <script src="https://kit.fontawesome.com/f9ec6cbf8e.js" crossorigin="anonymous"></script> <!-- Biblioteca de icones -->
    <link rel="stylesheet" href="Popup/popup.css"> <!-- Necessário para qualquer página que contenha popups -->
    <script src="Popup/popup.js"></script> <!-- Chamando o script dos pop-ups -->
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="img-login">
                <img src="Imagens/logo-saggezza-titulo.png" alt="Imagem com logo">
            </div>      
            <form action="login.php" id="loginForm" method="POST" class="form-login"> 
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
                <a href="recuperar.php"  class="btn-redefsenha">Esqueci minha senha</a>
                <br>
                <button type="submit" class="btn btn-primary btn-login">Entrar</button>     
            </form>
        </div>
    </div>

    <!-- POP UP DE ERRO -->
    <div id="popup-erro" class="popup">
        <div class="popup-content-erro">
            <i class="fa-solid fa-circle-xmark icone-erro"></i> <!-- Icone -->
            <h3 class="titulo-erro">Erro!</h3> <!-- Titulo -->
            <p class="popup-txt">message</p> <!-- Texto -->
            <br>
            <button onclick="closePopupErro()" class="btn-popup-erro">Ok!</button> <!-- Fechar -->
        </div>
    </div>
    
    <!-- Script que atualiza a mensagem do popup de acordo com a necessidade e fecha os popups e erro 
    (reutilizando do arquivo js para funcionar dentro do login.php) -->
    <script>
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "login.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.type === "success") {
                    window.location.href = response.redirect;
                } else {
                    openPopupErro(response.message);
                }
            }
        };
        xhr.send(formData);
    });

    function openPopupErro(message) {
        // Atualiza o conteúdo do popup com a mensagem recebida
        document.getElementById("popup-erro").style.display = "block";
        document.querySelector("#popup-erro .popup-txt").textContent = message; // Define o texto da mensagem
        setTimeout(() => {
            document.getElementById("popup-erro").classList.add("fade-in");
        }, 50);
    }

    function closePopupErro() {
        document.getElementById("popup-erro").classList.remove("fade-in");
        setTimeout(() => {
         document.getElementById("popup-erro").style.display = "none";
        }, 300);
    }
</script>


</body>
</html>