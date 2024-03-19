$(document).ready(function(){
    atualizarTabela();
    // Função para lidar com o clique no botão de salvar
    $('#btn-salvar').click(function(event){
        // Impede o comportamento padrão de submissão do formulário
        event.preventDefault();
    
        // Captura os dados do formulário
        var Data = $('#formCadastroLubrificante').serialize();
    
        // Faz a requisição AJAX apenas se o formulário estiver válido
        if ($('#formCadastroLubrificante')[0].checkValidity()) {
            $.ajax({
                type: 'POST',
                url: '../Php/cadlubadm.php', // Arquivo PHP que lida com o cadastro no banco de dados
                data: Data,
                success: function(response){
                    limparCampos();
                    atualizarTabela();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log('Erro ao enviar dados: ' + textStatus);
                }
            });
        }
    });
    
    $('#btn-pesquisa').click(function() {
        filtrarTabela();
    });
    
    });
    
    function limparCampos(){
        $('#nome-lub').val('');
    }
    
    function atualizarTabela() {
        $.ajax({
            url: '../Php/cadlubadm.php', // Arquivo PHP que retorna os dados da tabela
            method: 'GET',
            success: function(response){
                $('#dados').html(response);
            }
        });
    }
    
    function filtrarTabela() {
        var filtro = $('#inputFiltro').val().toLowerCase();
        $('#tabela-dados tbody tr').each(function() {
            var lubrificante = $(this).find('td:eq(1)').text().toLowerCase(); // Índice 1 para a coluna de lubrificante
            
            if (lubrificante.includes(filtro)) {
                $(this).show();  
            } else {
                $(this).hide(); // Esconde a linha se não encontrar o filtro
            }
        });
    }