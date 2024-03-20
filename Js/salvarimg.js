$(document).ready(function(){ 
    atualizarTabela();
    carregarSelect();

    $('#formCadastroImagem').submit(function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: '../Php/salvarimg.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                atualizarTabela();
                limparCampos();
                
            },
            error: function (xhr, status, error) {
                console.error(error);
            }

        });

    });

    $('#btn-pesquisa').click(function() {
        filtrarTabela();
    });
});

function limparCampos(){
    $('#clienteSelect').val(''); 
    $('#equipamentoSelect').val(''); 
    $('#arquivo').val('');
    $('#data').val('');
}

function atualizarTabela() {
    $.ajax({
        url: '../Php/salvarimg.php', // Arquivo PHP que retorna os dados da tabela
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
        url: '../Php/salvarimg.php',
        method: 'GET',
        data: { tipo: 'todos' },
        dataType: 'json',
        success: function(data){
            // Verifica se os dados foram recebidos corretamente
            if(data && data.clientes && data.equipamentos){
                var clientes = data.clientes;
                var equipamentos = data.equipamentos;

                // Limpa e preenche o select de clientes com os dados recebidos
                $('#clienteSelect').empty().append('<option value="">Selecione um cliente..</option>');
                $.each(clientes, function(index, value){
                    $('#clienteSelect').append('<option value="' + value.cl_id + '">' + value.cl_nome + '</option>');
                });

                // Limpa e preenche o select de equipamentos com os dados recebidos
                $('#equipamentoSelect').empty().append('<option value="">Selecione um equipamento..</option>');
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
        var imagem = $(this).find('td:eq(3)').text().toLowerCase(); // Índice 3 para a coluna de imagem
        
        if (nome.includes(filtro) || equipamento.includes(filtro) 
            || imagem.includes(filtro)) {
            $(this).show();  
        } else {
            $(this).hide(); // Esconde a linha se não encontrar o filtro
        }
    });
}