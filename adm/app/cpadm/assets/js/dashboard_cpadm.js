/* ---------------------------- Sobre a Paginação -------------------------------- */

$(document).ready(function() { // Quando carregar a Página faça
    var pagina = 1;
    listar_usuario(pagina);
});

function listar_usuario(pagina, variavelComplemento = null) {
    var dados = {
        Pagina: pagina
    };
    $.post('http://localhost/showadm/adm/carregarUsuariosJS/listar/' + pagina + '?tiporesultado=1', dados, function(retorna) {
        $('#conteudo').html(retorna);
    });
}
/* ------------------------------------------------------------------------------- */
/* ---------------------------- Pesquisar sobre -------------------------------- */
$(function() {
    // Verificando se o usuário digitou algum valor no campo
    $('#pesquisarUsuarios').keyup(function() {
        var pesquisar_usuario = $(this).val(); // Pegando o valor e atribuindo na variavel

        // Verificar se há valor na variavel "pesquisar_usuario"
        if (pesquisar_usuario !== '') {
            var dados = {
                palavrasPesquisarUsuario: pesquisar_usuario
            };
            $.post('http://localhost/showadm/adm/carregarUsuariosJS/listar/1?tiporesultado=2', dados, function(retorna) {
                // Carregar o conteúdo para o Usuário
                $('#conteudo').html(retorna);
            });
        } else {
            var pagina = 1;
            listar_usuario(pagina);
        }
    });
});

/* ------------------------------------------------------------------------------- */
/* ------------------------ Modal Visualizar o Usuário --------------------------- */
$(document).ready(function() { // Quando carregar a Página faça
    $(document).on('click', '.view_data', function() {
        var usuarioID = $(this).attr('id');
        //alert(usuarioID);
        if (usuarioID !== '') {

            $.post('http://localhost/showadm/adm/VisualizarUsuarioModal/visualizarUsuarioModal/' + usuarioID, dados, function(retorna) {
                // Carregar o conteúdo para o Usuário
                //$('#conteudo').html(retorna);
                $('#verUsuarioModal').html(retorna); // Envia para a janela modal
                $('#visializarUsuarioModal').modal('show'); // Carregar a janela modal
            });
        }
    });
});

/* ------------------------------------------------------------------------------- */
/* ------------------------ Modal Cadastrar o Usuário --------------------------- */

$("#insert_usuario_modal").on("submit", function(event) {
    event.preventDefault(); // Para não executar o Form "Formulário"
    var enderecoCadastro = jQuery('.enderecoCadastro').attr('data-enderecoCadastro');
    //console.log(enderecoCadastro);
    $.ajax({
        method: "POST",
        url: enderecoCadastro,
        data: new FormData(this), // Os dados que vem do formulário
        contentType: false,
        processData: false,
        success: function(retorna) {
            if (retorna['erro']) {
                //console.log(retorna);
                //console.log(" 1 "); // Sucesso
                //$('#msgCadastrarUsuarioModal').html(retorna['msg']);
                $('.addUsuarioModal').modal('hide');
                $('#addSucessoModal').modal('show');
                listar_usuario(1);
            } else {
                //console.log(retorna);
                //console.log(" 0 "); // Error
                $('#msgCadastrarUsuarioModal').html(retorna['msg']);
            }
        }
    });
});