$(document).ready(function(){
    atualizarTabela();
    // Função para lidar com o clique no botão de salvar
    $('#btn-salvar').click(function(event){
        // Impede o comportamento padrão de submissão do formulário
        event.preventDefault();
    
        // Captura os dados do formulário
        var Data = $('#formCadastroCliente').serialize();
    
        // Faz a requisição AJAX apenas se o formulário estiver válido
        if ($('#formCadastroCliente')[0].checkValidity()) {
            $.ajax({
                type: 'POST',
                url: '../Php/cadclienteadm.php', // Arquivo PHP que lida com o cadastro no banco de dados
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
        $('#nomecliente').val('');
        $('#nomeresponsavel').val('');
        $('#telefonecliente').val('');
        $('#emailcliente').val('');
    }
    
    function atualizarTabela() {
        $.ajax({
            url: '../Php/cadclienteadm.php', // Arquivo PHP que retorna os dados da tabela
            method: 'GET',
            success: function(response){
                $('#dados').html(response);
            }
        });
    }
    
    function filtrarTabela() {
        var filtro = $('#inputFiltro').val().toLowerCase();
        $('#tabela-dados tbody tr').each(function() {
            var nome = $(this).find('td:eq(1)').text().toLowerCase(); // Índice 1 para a coluna de nome do cliente
            var email = $(this).find('td:eq(4)').text().toLowerCase(); // Índice 4 para a coluna de e-mail
    
            if (nome.includes(filtro) || email.includes(filtro)) {
                $(this).show(); // Mostra a linha se encontrar o filtro no nome ou e-mail
            } else {
                $(this).hide(); // Esconde a linha se não encontrar o filtro
            }
        });
    }
    