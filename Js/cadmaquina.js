// Espera o documento estar completamente carregado antes de executar o código JavaScript
$(document).ready(function(){

    atualizarTabela();
    carregarSelect();
       
        $('#btn-salvar').click(function(){
    
            var clienteId = $('#clienteSelect').val();
            var equipamentoId = $('#equipamentoSelect').val();
            var maquinaId = $('#maquinaSelect').val();
            var lubrificanteId = $('#lubrificanteSelect').val();
            var fabricanteId = $('#fabricanteSelect').val();
    
            // Envia os dados para o arquivo PHP usando AJAX
            $.ajax({
                url: '../Php/cadmaquina.php',
                method: 'POST',
                data: { clienteId: clienteId, 
                        equipamentoId: equipamentoId,
                        maquinaId: maquinaId, 
                        lubrificanteId: lubrificanteId, 
                        fabricanteId: fabricanteId },
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
            url: '../Php/cadmaquina.php', // Arquivo PHP que retorna os dados da tabela
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
            url: '../Php/cadmaquina.php',
            method: 'GET',
            data: { tipo: 'todos' },
            dataType: 'json',
            success: function(data){
                // Verifica se os dados foram recebidos corretamente
                if(data && data.clientes && data.equipamentos && data.maquinas && data.lubrificantes && data.fabricantes){
                    var clientes = data.clientes;
                    var equipamentos = data.equipamentos;
                    var maquinas = data.maquinas;
                    var lubrificantes = data.lubrificantes;
                    var fabricantes = data.fabricantes;
    
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
    
                    // Limpa e preenche o select de máquinas com os dados recebidos
                    $('#maquinaSelect').empty().append('<option value="">Selecione uma maquina..</option>');
                    $.each(maquinas, function(index, value){
                        $('#maquinaSelect').append('<option value="' + value.tm_id + '">' + value.tm_tipo + '</option>');
                    });
    
                    // Limpa e preenche o select de lubrificantes com os dados recebidos
                    $('#lubrificanteSelect').empty().append('<option value="">Selecione um lubrificante..</option>');
                    $.each(lubrificantes, function(index, value){
                        $('#lubrificanteSelect').append('<option value="' + value.lu_id + '">' + value.lu_nome + '</option>');
                    });
    
                    // Limpa e preenche o select de fabricantes com os dados recebidos
                    $('#fabricanteSelect').empty().append('<option value="">Selecione um fabricante..</option>');
                    $.each(fabricantes, function(index, value){
                        $('#fabricanteSelect').append('<option value="' + value.fa_id + '">' + value.fa_nome + '</option>');
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
            var tipo_maquina = $(this).find('td:eq(3)').text().toLowerCase(); // Índice 3 para a coluna de tipo maquina
            var lubrificante = $(this).find('td:eq(4)').text().toLowerCase(); // Índice 4 para a coluna de lubrificante
            var fabricante = $(this).find('td:eq(5)').text().toLowerCase(); // Índice 5 para a coluna de fabricante
            
            if (nome.includes(filtro) || equipamento.includes(filtro) 
                || tipo_maquina.includes(filtro) || lubrificante.includes(filtro) 
                || fabricante.includes(filtro)) {
                $(this).show();  
            } else {
                $(this).hide(); // Esconde a linha se não encontrar o filtro
            }
        });
    }
    