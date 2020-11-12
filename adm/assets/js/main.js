/**
 * Caracteres de verificação
 */
var crcEmail = "qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM1234567890@_.";
var crcUser = "qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM1234567890@_.";
var crcNomo = "qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM ";
var letras = "qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM";
var numeros = "123456789";
var letrasAcentuadas = "ÁÂÃÉÊÍÓÔÕáâãçéêíóôõ";
var tudo = letrasAcentuadas.concat(numeros.concat(letras));
//caracteresEspeciais = "!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª";

var usuario = document.forms['form']['usuario'];
var usuario_error = document.getElementById('usuario_error');
if (usuario_error !== null) {
    if (document.getElementById("usuario")) {
        document.getElementById("usuario").onkeypress = function(e) {
            var chr = String.fromCharCode(e.which);
            if (crcUser.indexOf(chr) < 0) {
                usuario_error.innerHTML = "Caracter não permitido. Nesse campo";
                usuario.style.borderBottom = "2px solid red";
                usuario_error.style.display = "block";
                usuario.focus();
                return false;
            } else {
                usuario_error.style.display = 'none';
            }
        };
    }
    usuario.addEventListener('input', usuario_Verify);
}


var email = document.forms['form']['email'];
var email_error = document.getElementById('email_error');
if (email_error !== null) {
    if (document.getElementById("email")) {
        document.getElementById("email").onkeypress = function(e) {
            var chr = String.fromCharCode(e.which);
            if (crcEmail.indexOf(chr) < 0) {
                email_error.innerHTML = "Caracteres diferentes de @ _ . não permitidos <br> Click no Botão";
                email.style.borderBottom = "2px solid red";
                email_error.style.display = "block";
                email.focus();
                return false;
            } else {
                email_error.style.display = 'none';
            }
        };
    }
    email.addEventListener('input', email_Verify);
}

var nome = document.forms['form']['nome'];
var nome_error = document.getElementById('nome_error');
if (nome_error !== null) {
    if (document.getElementById("nome")) {
        document.getElementById("nome").onkeypress = function(e) {
            var chr = String.fromCharCode(e.which);
            if (crcNomo.indexOf(chr) < 0) {
                nome_error.innerHTML = "Somente letras no Nome";
                nome.style.borderBottom = "2px solid red";
                nome_error.style.display = "block";
                nome.focus();
                return false;
            } else {
                nome_error.style.display = 'none';
            }
        };
    }
    nome.addEventListener('input', nome_Verify);
}

var password = document.forms['form']['senha'];
var pass_error = document.getElementById('pass_error');
if (pass_error !== null) { // Verifica se está com o ID "pass_error" na página
    if (document.getElementById("senha")) { // Verifica se está com o ID "senha" na página
        document.getElementById("senha").onkeypress = function(e) {
            var chr = String.fromCharCode(e.which);
            var caracteresEspeciais = "!@#$%&*()_-+";
            var crcSenha = caracteresEspeciais.concat(numeros.concat(letras));
            //caracteresEspeciais = "!@#$%&*()_-+={[}]/?;:,\\\'<>°ºª";
            if (crcSenha.indexOf(chr) < 0) { // Verifica se contem os caracter associado na variavel
                pass_error.innerHTML = "Caracter diferentes de !@#$%&*()_-+ não permitido.";
                senha.style.borderBottom = "2px solid red";
                pass_error.style.display = "block";
                senha.focus();
                return false;
            } else {
                pass_error.style.display = 'none';
            }
        };
    }
    password.addEventListener('input', password_Verify);
}



function validated() {
    if (nome_error !== null && nome.value.length < 5) {
        nome_error.innerHTML = "Somente letras";
        nome.style.borderBottom = "2px solid red";
        nome_error.style.display = "block";
        nome.focus();
        return false;
    }
    if (email_error !== null && (email.value.length < 5 || email.value.indexOf(" ") >= 0)) {
        email.style.borderBottom = "2px solid red";
        email_error.style.display = "block";
        email.focus();
        return false;
    }
    if (usuario.value.length < 5 || usuario.value.indexOf(" ") >= 0) {
        usuario.style.borderBottom = "2px solid red";
        usuario_error.style.display = "block";
        usuario.focus();
        return false;
    }
    if (password.value.length < 6 || password.value.indexOf(" ") >= 0) {
        password.style.borderBottom = "2px solid red";
        pass_error.style.display = "block";
        password.focus();
        return false;
    }
}

function usuario_Verify() {
    if (usuario.value.length != "") {
        usuario.style.borderBottom = "2px solid #d9d9d9";
        usuario_error.style.display = "none";
        return true;
    }
}

function email_Verify() {
    if (email.value.length != "") {
        email.style.borderBottom = "2px solid #d9d9d9";
        email_error.style.display = "none";
        return true;
    }
}

function nome_Verify() {
    if (nome.value.length != "") {
        nome.style.borderBottom = "2px solid #d9d9d9";
        nome_error.style.display = "none";
        return true;
    }
}

function password_Verify() {
    if (password.value.length >= 5) {
        password.style.borderBottom = "2px solid #d9d9d9";
        pass_error.style.display = "none";
        return true;
    }
}
// Parte de alerta ativado
$(document).ready(function() {
    $('#myAlert').show('fade');
    setTimeout(function() {
        $('#myAlert').hide('fade');
    }, 5000);
});