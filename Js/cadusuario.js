// Espera o documento estar completamente carregado antes de executar o código JavaScript
$(document).ready(function(){
    atualizarTabela();
    carregarSelect();

    $('#btn-salvar').click(function(){

        var usuario = $('#username').val();
        var telefone = $('#telefone').val();
        var email = $('#email').val();
        var tipo = $('#tipo-usuario').val();
        var cliente = $('#tipo-cliente').val();

        // Envia os dados para o arquivo PHP usando AJAX
        $.ajax({
            url: '../Php/cadusuario.php',
            method: 'POST',
            data: { tipos: 'cadastrar',
                    usuario: usuario, 
                    telefone: telefone,
                    email: email, 
                    tipo: tipo,
                    cliente: cliente},
            success: function(response){
                location.reload();
            },
            error: function(xhr, status, error){
                console.error('Erro na requisição AJAX:', status, error);
            }
        });
    });

    $('#btn-atualizar').click(function(){

        var usuario = $('#username').val();
        var telefone = $('#telefone').val();
        var email = $('#email').val();

        // Envia os dados para o arquivo PHP usando AJAX
        $.ajax({
            url: '../Php/cadusuario.php',
            method: 'POST',
            data: { 
                    tipos: 'atualizar',
                    usuario: usuario, 
                    telefone: telefone,
                    email: email},
            success: function(response){
                location.reload();
            },
            error: function(xhr, status, error){
                console.error('Erro na requisição AJAX:', status, error);
            }
        });
    })

    $('#btn-excluir').click(function(){

        var email = $('#email').val();

        // Envia os dados para o arquivo PHP usando AJAX
        $.ajax({
            url: '../Php/cadusuario.php',
            method: 'POST',
            data: { tipos: 'excluir',
                    email: email},
            success: function(response){
                location.reload();
            },
            error: function(xhr, status, error){
                console.error('Erro na requisição AJAX:', status, error);
            }
        });
    })

    $('#btn-reset').click(function(){

        $('#tipo-usuario').prop('disabled', false);
        $('#email').prop('disabled', false);
        $('#tipo-cliente').prop('disabled', false);

        $('#username').val(''); 
        $('#telefone').val(''); 
        $('#email').val('');
        $('#tipo-usuario').val('');
        $('#tipo-cliente').val('');

    })

    $('#tabela-dados tbody').on('click', 'tr', function() {
        var usuario = $(this).find('td:eq(1)').text(); // Usuário está na segunda coluna
        var telefone = $(this).find('td:eq(2)').text(); // Telefone está na terceira coluna
        var email = $(this).find('td:eq(3)').text(); // Email está na quarta coluna
        var tipoTexto = $(this).find('td:eq(4)').text(); // Tipo está na quinta coluna
        var clienteTexto = $(this).find('td:eq(5)').text(); // Cliente está na sexta coluna
    
        // Preenche os campos do formulário com os dados obtidos
        $('#username').val(usuario);
        $('#telefone').val(telefone);
        $('#email').val(email);
    
        // Encontra o valor correspondente ao texto no select de tipo
        var tipoValor = $('#tipo-usuario option').filter(function() {
            return $(this).text() === tipoTexto;
        }).val();
    
        // Define o valor encontrado no select de tipo
        $('#tipo-usuario').val(tipoValor);
    
        // Encontra o valor correspondente ao texto no select de cliente
        var clienteValor = $('#tipo-cliente option').filter(function() {
            return $(this).text() === clienteTexto;
        }).val();
    
        // Define o valor encontrado no select de cliente
        $('#tipo-cliente').val(clienteValor);

        $('#tipo-usuario').prop('disabled', true);
        $('#email').prop('disabled', true);
        $('#tipo-cliente').prop('disabled', true);

    });

    $('#btn-pesquisa').click(function() {
        filtrarTabela();
    });

    $('#btn-pagina').click(function() {
        location.reload();
    });
});

function atualizarTabela() {
    $.ajax({
        url: '../Php/cadusuario.php', // Arquivo PHP que retorna os dados da tabela
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
        url: '../Php/cadusuario.php',
        method: 'GET',
        data: { tipo: 'todos' },
        dataType: 'json',
        success: function(data){
            // Verifica se os dados foram recebidos corretamente
            if(data && data.usuarios && data.clientes){
                var usuarios = data.usuarios;
                var clientes = data.clientes;

                // Limpa e preenche o select de usuarios com os dados recebidos
                $('#tipo-usuario').empty().append('<option value="">Selecione um usuario..</option>');
                $.each(usuarios, function(index, value){
                    $('#tipo-usuario').append('<option value="' + value.tu_id + '">' + value.tu_tipo + '</option>');
                });

                // Limpa e preenche o select de equipamentos com os dados recebidos
                $('#tipo-cliente').empty().append('<option value="">Selecione um cliente..</option>');
                $.each(clientes, function(index, value){
                    $('#tipo-cliente').append('<option value="' + value.cl_id + '">' + value.cl_nome + '</option>');
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
        var usuario = $(this).find('td:eq(1)').text().toLowerCase(); // Índice 1 para a coluna de nome do usuario
        var telefone = $(this).find('td:eq(2)').text().toLowerCase(); // Índice 2 para a coluna de telefone
        var email = $(this).find('td:eq(3)').text().toLowerCase(); // Índice 3 para a coluna de email
        var tipo = $(this).find('td:eq(4)').text().toLowerCase(); // Índice 4 para a coluna de tipo de usuario
        var cliente = $(this).find('td:eq(5)').text().toLowerCase(); // Índice 5 para a coluna de cliente
        
        if (usuario.includes(filtro) || telefone.includes(filtro)
            || email.includes(filtro) || tipo.includes(filtro)
            || cliente.includes(filtro)) {
            $(this).show();  
        } else {
            $(this).hide(); // Esconde a linha se não encontrar o filtro
        }
    });
}