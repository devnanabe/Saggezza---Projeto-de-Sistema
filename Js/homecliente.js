// Espera o documento estar completamente carregado antes de executar o código JavaScript
$(document).ready(function(){
    atualizarTabela();


});

function atualizarTabela() {
    $.ajax({
        url: '../Php/homecliente.php', // Arquivo PHP que retorna os dados da tabela
        method: 'GET',
        data:{tipo: 'select'},
        success: function(response){
            $('#dados').html(response);
        }
    });
}