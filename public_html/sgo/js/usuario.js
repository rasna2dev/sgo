


$( document ).ready(function() {
    $('.modalUsuario').on('click', function() {

        $('#nome').val( $(this).data('nome') );
        $('#email').val( $(this).data('email') );
        $('#uf').val( $(this).data('uf') ).trigger('change');
        $('#telefone').val( $(this).data('telefone') );

        if($(this).data('administrador')) {
            $('#administrador').prop('checked',true );
            $('#administrador').val(1);
        } else {
            $('#administrador').prop('checked', false );
            $('#administrador').val(0);
        }

        if($(this).data('ativo')) {
            $('#ativo').prop('checked',true );
            $('#ativo').val(1);
        } else {
            $('#ativo').prop('checked', false );
            $('#ativo').val(0);
        }

        $('#uf').selectpicker('refresh');

        if($(this).data('acao') == 'cadastrar') {
            $('#largeModalLabel').html('Cadastrar Usuário');
            $('#_method').val('POST');
            $('#formUsuario').attr('action', (
                $('#formUsuario').data('act')
            ));
        } else {
            $('#largeModalLabel').html('Atualizar Usuário');
            $('#_method').val('PUT');
            $('#formUsuario').attr('action', (
                $('#formUsuario').data('act') + '/' +
                $(this).data('id')
            ));
        }
    });

    $('#formUsuario').on('submit', function() {
        $('#errors').hide();
        $('#errors').children('ul').empty();

        var administrador = $('#administrador').prop('checked') ? 1 : 0;
        var ativo = $('#ativo').prop('checked') ? 1 : 0;

        $.ajax({
            url: $('#formUsuario').attr('action'),
            type: $('#_method').val(),
            headers: {
                'X-CSRF-TOKEN': $('#formUsuario').children('[name="_token"]').val()
            },
            data: {
                nome: $('#nome').val(),
                email: $('#email').val(),
                uf: $('#uf').val(),
                telefone: $('#telefone').val(),
                senha: $('#senha').val(),
                resenha: $('#resenha').val(),
                administrador: administrador,
                ativo: ativo,
            },
            success: function(response) {
                return retornoSucesso(response);
                /*$('#resposta').removeClass('hide');
                $('#resposta > div').removeClass('alert-danger');
                $('#resposta > div').addClass('alert-success');
                $('#resposta > div > ul').remove();

                var ul = $('<ul/>');
                var li = $('<li>'+ response.message +'</li>');
                ul.append(li);
                $('#resposta > div').append(ul);

                var url = window.location.href;
                var parametros = url.split("?")[1];
                var tempoEspera = 4000;

                setTimeout(function() {
                    if (typeof parametros === 'undefined') {
                        window.location.href = url;
                    } else {
                        window.location.href = url + parametros;
                    }
                }, tempoEspera);*/
            },
            error: function(xhr, status, error) {
                /*
                $('#resposta').removeClass('hide');
                $('#resposta > div').removeClass('alert-success');
                $('#resposta > div').addClass('alert-danger');
                $('#resposta > div > ul').remove();

                var ul = $('<ul/>');

                $.each(xhr.responseJSON.errors, function(chave, valor) {
                    if (Array.isArray(valor)) {
                        $.each(valor, function(index, mensagem) {
                            var li = $('<li>'+ mensagem +'</li>');
                            ul.append(li);
                        });
                    } else {
                        var li = $('<li>'+ valor +'</li>');
                        ul.append(li);
                    }
                });

                $('#resposta > div').append(ul);

                var tempoEspera = 4000;

                setTimeout(function() {
                    $('#resposta').addClass('hide');
                    $('#resposta > div').removeClass('alert-success');
                }, tempoEspera);*/
                return retornoErro(xhr, status, error);
            }
        });
    });
});
