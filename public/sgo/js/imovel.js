$( document ).ready(function() {

    $('.a-link-del-imagem').on('click', function() {

        let url = window.location.origin + window.location.pathname;
        url += '/' + $(this).data('href');

        let resposta = confirm("Você tem certeza que deseja remover esta imagem?");

        if (resposta) {
            window.location.href = url;
        }
    });

    $('.a-link-add-principal').on('click', function() {

        let url = window.location.origin + window.location.pathname;
        url += '/' + $(this).data('href');

        let txt = '';
        if ($(this).data('href').includes("add")) {
            txt = "Você tem certeza que deseja colocar este imóvel em destaque?";
        } else {
            txt = "Você tem certeza que deseja remover este imóvel do destaque?";
        }

        let resposta = confirm(txt);

        if (resposta) {
            window.location.href = url;
        }
    });

    $('.modalImovel').on('click', function() {

        items = [
            ,'usuario','matricula_id','estado','cidade'
            ,'bairro','modalidade','unidade','endereco'
            ,'descricao','link','link_matricula','vendido'
            ,"valor_mercado","valor_avaliacao","valor_arremate"
            ,'area_total','area_privativa','area_terreno'
            ,'quartos','banheiros','salas','vagas_garagem'
            ,"valor_prazo","valor_desconto","valor_entrada"
            ,"valor_documentacao","valor_desocupacao"
            ,"valor_reforma","valor_deposito_inicial"
            ,"valor_despesa_venda","valor_despesa_extra"
            ,"valor_saldo_devedor","valor_condominio_mensal"
            ,"valor_condominio_anual","valor_iptu_mensal"
            ,"valor_iptu_anual","valor_prestacao_mensal"
            ,"valor_prestacao","valor_investimento"
            ,"valor_reembolso","valor_saldo_operacao"
            ,"data_criacao","data_atualizacao"
        ];

        for(i = 0; i < items.length; i++) {
            $('.imv-' + items[i]).html('');
            $('.imv-' + items[i]).html( $(this).data( items[i] ) );
        }

        $('.lnk-matricula_id').removeAttr('href');
        $('.lnk-matricula_id').attr('href', $(this).data('link'));

        $('.imv-imagem').removeAttr('src');
        $('.imv-imagem').removeClass('img-responsive')
            .removeClass('thumbnail');


        $('.a-link-add-principal').removeAttr('data-href');

        $('.a-link-del-imagem').html('');
        $('.a-link-del-imagem').removeAttr('data-href');
        if(
            $(this).data('imagem').length > 0 &&
            $(this).data('imagem') != '#'
        ) {
            $('.imv-imagem').attr('src', url + '/foto/' + $(this).data('imagem'));
            $('.imv-imagem').addClass('img-responsive')
                .addClass('thumbnail');
            $('.a-link-del-imagem').data('href', '?remover_foto=' + $(this).data('id'));
            $('.a-link-del-imagem').html('<span class="material-icons" style="color: red">delete</span>');

            if($(this).data('principal')) {
                $('.a-link-add-principal').data('href', '?remover_principal=' + $(this).data('id'));
                $('.a-link-add-principal').html('<span class="material-icons" style="color: #fe6d12">star</span>');
            } else {
                $('.a-link-add-principal').data('href', '?add_principal=' + $(this).data('id'));
                $('.a-link-add-principal').html('<span class="material-icons" style="color: #BBB">star</span>');
            }


        }
    });


});
