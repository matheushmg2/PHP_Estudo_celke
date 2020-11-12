// Parte de alerta ativado
$(document).ready(function() {
    $('#myAlert').show('fade');
    setTimeout(function() {
        $('#myAlert').hide('fade');
    }, 5000);
});