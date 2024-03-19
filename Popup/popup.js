/* -------- CONFIGURAÇÕES DOS POP-UPS ---------- */

//POP UP DE SUCESSO
function openPopupSucesso() {
    document.getElementById("popup-sucesso").style.display = "block";
    setTimeout(() => {
        document.getElementById("popup-sucesso").classList.add("fade-in");
    }, 50);
}

function closePopupSucesso() {
    document.getElementById("popup-sucesso").classList.remove("fade-in");
    setTimeout(() => {
        document.getElementById("popup-sucesso").style.display = "none";
    }, 300);
}

//POP UP DE ERRO
function openPopupErro() {
    document.getElementById("popup-erro").style.display = "block";
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

//POP UP DE AVISO
function openPopupAviso() {
    document.getElementById("popup-aviso").style.display = "block";
    setTimeout(() => {
        document.getElementById("popup-aviso").classList.add("fade-in");
    }, 50);
}

function closePopupAviso() {
    document.getElementById("popup-aviso").classList.remove("fade-in");
    setTimeout(() => {
        document.getElementById("popup-aviso").style.display = "none";
    }, 300);
}

//POP UP DE FORMULARIO
function openPopupForm() {
    document.getElementById("popup-form").style.display = "block";
    setTimeout(() => {
        document.getElementById("popup-form").classList.add("fade-in");
    }, 50);
}

function closePopupForm() {
    document.getElementById("popup-form").classList.remove("fade-in");
    setTimeout(() => {
        document.getElementById("popup-form").style.display = "none";
    }, 300);
}