$( document ).ready(function() {

    let colunas = [
        'valor_prazo', 'valor_inicial', 'valor_final', 'valor_desconto',
        'valor_condominio', 'valor_iptu', 'valor_prestacao_financiamento',
        'valor_entrada', 'valor_documentacao',
        'valor_desocupacao', 'valor_reforma', 'valor_despesa_venda',
        'valor_despesa_extra'
    ];

    function atribuirValor(e)
    {

        for(i = 0; i < colunas.length; i++) {
            if ($('#' + colunas[i]).length) {
                $('#' + colunas[i]).val( e.data( colunas[i] ) );
            }
        }

        if(e.data('ativo')) {
            $('#ativo').prop('checked',true );
            $('#ativo').val(1);
        } else {
            $('#ativo').prop('checked', false );
            $('#ativo').val(0);
        }

        if(e.data('acao') == 'cadastrar') {
            $('#largeModalLabel').html('Cadastrar Tarifa');
            $('#_method').val('POST');
            $('#formTarifa').attr('action', (
                $('#formTarifa').data('act')
            ));
        } else {
            $('#largeModalLabel').html('Atualizar Tarifa');
            $('#_method').val('PUT');
            $('#formTarifa').attr('action', (
                $('#formTarifa').data('act') + '/' +
                e.data('id')
            ));
        }
    }


    $('.modalTarifa').on('click', function() {
        return atribuirValor( $(this) );
    });

    $('#formTarifa').on('submit', function() {
        $('#errors').hide();
        $('#errors').children('ul').empty();

        let p = {};
        for(i = 0; i < colunas.length; i++) {
            if ($('#' + colunas[i]).length) {
                p[colunas[i]] = $('#' + colunas[i]).val();
            }
        }

        p['ativo'] = $('#ativo').prop('checked') ? 1 : 0;

        $.ajax({
            url: $('#formTarifa').attr('action'),
            type: $('#_method').val(),
            headers: {
                'X-CSRF-TOKEN': $('#formTarifa').children('[name="_token"]').val()
            },
            data: p,
            success: function(response) {
                return retornoSucesso(response);
            },
            error: function(xhr, status, error) {
                return retornoErro(xhr, status, error);
            }
        });
    });

    $('.modalTarifaRemover').on('click', function() {
        $('#delete_id').val( $(this).data('id') );
    });

    $('#formTarifaDelete').on('submit', function() {
        $('#formTarifaDelete').attr('action', (
            $('#formTarifaDelete').data('act') + '/' +
            $('#delete_id').val()
        ));


        $.ajax({
            url: $('#formTarifaDelete').attr('action'),
            type: $('#formTarifaDelete').children('[name="_method"]').val(),
            headers: {
                'X-CSRF-TOKEN': $('#formTarifaDelete').children('[name="_token"]').val()
            },
            success: function(response) {
                return retornoSucesso(response);
            },
            error: function(xhr, status, error) {
                return retornoErro(xhr, status, error);
            }
        });
    });


});
