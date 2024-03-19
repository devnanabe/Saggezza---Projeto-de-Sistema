// Espera o documento estar completamente carregado antes de executar o código JavaScript
$(document).ready(function(){
    atualizarTabela();
    carregarSelect();

    $('#btn-salvar').click(function(){

        var clienteId = $('#clienteSelect').val();
        var equipamentoId = $('#equipamentoSelect').val();
        var data = $('#data').val();
        var sinalizacao = $('#sinalizacao').val();

        // Envia os dados para o arquivo PHP usando AJAX
        $.ajax({
            url: '../Php/reportarsinalizacaoadm.php',
            method: 'POST',
            data: { clienteId: clienteId, 
                    equipamentoId: equipamentoId,
                    data: data, 
                    sinalizacao: sinalizacao},
            success: function(response){
               atualizarTabela();
            },
            error: function(xhr, status, error){
                console.error('Erro na requisição AJAX:', status, error);
            }
        });
    });

    $('#btn-pesquisa').click(function() {
        filtrarTabela();
    });
});

function atualizarTabela() {
    $.ajax({
        url: '../Php/reportarsinalizacaoadm.php', // Arquivo PHP que retorna os dados da tabela
        method: 'GET',
        data:{tipo: 'select'},
        success: function(response){
            $('#dados').html(response);
        }
    });
}

// Função para carregar os dados a partir do servidor usando AJAX
function carregarSelect(){
    $.ajax({
        url: '../Php/reportarsinalizacaoadm.php',
        method: 'GET',
        data: { tipo: 'todos' },
        dataType: 'json',
        success: function(data){
            // Verifica se os dados foram recebidos corretamente
            if(data && data.clientes && data.equipamentos){
                var clientes = data.clientes;
                var equipamentos = data.equipamentos;

                // Limpa e preenche o select de clientes com os dados recebidos
                $('#clienteSelect').empty().append('<option value="">Selecione um cliente...</option>');
                $.each(clientes, function(index, value){
                    $('#clienteSelect').append('<option value="' + value.cl_id + '">' + value.cl_nome + '</option>');
                });

                // Limpa e preenche o select de equipamentos com os dados recebidos
                $('#equipamentoSelect').empty().append('<option value="">Selecione um equipamento...</option>');
                $.each(equipamentos, function(index, value){
                    $('#equipamentoSelect').append('<option value="' + value.eq_id + '">' + value.eq_nome + '</option>');
                });
            } else {
                console.error('Erro ao receber dados do servidor.');
            }
        },
        error: function(xhr, status, error){
            console.error('Erro na requisição AJAX:', status, error);
        }
    });
}

function filtrarTabela() {
    var filtro = $('#inputFiltro').val().toLowerCase();
    $('#tabela-dados tbody tr').each(function() {
        var nome = $(this).find('td:eq(1)').text().toLowerCase(); // Índice 1 para a coluna de nome do cliente
        var equipamento = $(this).find('td:eq(2)').text().toLowerCase(); // Índice 2 para a coluna de equipamento
        var sinalizacao = $(this).find('td:eq(4)').text().toLowerCase(); // Índice 3 para a coluna de sinalizacao
        
        if (nome.includes(filtro) || equipamento.includes(filtro) 
            || sinalizacao.includes(filtro)) {
            $(this).show();  
        } else {
            $(this).hide(); // Esconde a linha se não encontrar o filtro
        }
    });
}
