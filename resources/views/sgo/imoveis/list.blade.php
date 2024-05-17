
<div class="row">
    @if(session('success'))
        <div class="col-sm-12 mt-0 div-sucess">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    @endif
    <div class="body table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>MATRÍCULA</th>
                    <th>ENDEREÇO</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @if($imoveis->isEmpty())
                    <tr>
                        <td colspan="3" class="font-bold col-pink text-center">
                            Nenhum imóvel encontrado com esta forma de busca.
                        </td>
                    </tr>
                @else
                    @foreach($imoveis as $item)
                    <tr>
                        <td  class="vertical-align-middle">{{ $item->matricula_id }}</td>
                        <td class="vertical-align-middle">
                            {{ $item->endereco }} -
                            {{ is_null($item->bairro) ? '' : $item->bairro . ' - ' }}
                            {{ $item->cidade }}
                            - {{ $item->estado }}
                        </td>
                        <td class="vertical-align-middle">
                            <button type="button" class="btn btn-success waves-effect modalImovel" data-toggle="modal" data-target="#largeModal"
                                data-id="{{ $item->id}}"
                                data-usuario ="{{ $item->usuario }}"
                                data-matricula_id="{{ $item->matricula_id}}"
                                data-estado ="{{ $item->estado }}"
                                data-cidade ="{{ $item->cidade }}"
                                data-bairro ="{{ $item->bairro }}"
                                data-unidade ="{{ $item->unidade }}"
                                data-endereco ="{{ $item->endereco }}"
                                data-area_total = {{ $item->area_total }}
                                data-area_privativa = {{ $item->area_privativa }}
                                data-area_terreno = {{ $item->area_terreno }}
                                data-quartos = {{ $item->quartos }}
                                data-banheiros = {{ $item->banheiros }}
                                data-salas = {{ $item->salas }}
                                data-vagas_garagem = {{ $item->vagas_garagem }}
                                data-valor_mercado="{{ formatarValorReal( $item->valor_mercado ) }}"
                                data-valor_avaliacao="{{ formatarValorReal( $item->valor_avaliacao ) }}"
                                data-valor_arremate="{{ formatarValorReal( $item->valor_arremate ) }}"
                                data-valor_prazo="{{ formatarValorReal( $item->valor_prazo ) }}"
                                data-valor_desconto="{{ formatarValorReal( $item->valor_desconto ) }}"
                                data-valor_entrada="{{ formatarValorReal( $item->valor_entrada ) }}"
                                data-valor_documentacao="{{ formatarValorReal( $item->valor_documentacao ) }}"
                                data-valor_desocupacao="{{ formatarValorReal( $item->valor_desocupacao ) }}"
                                data-valor_reforma="{{ formatarValorReal( $item->valor_reforma ) }}"
                                data-valor_deposito_inicial="{{ formatarValorReal( $item->valor_deposito_inicial ) }}"
                                data-valor_despesa_venda="{{ formatarValorReal( $item->valor_despesa_venda ) }}"
                                data-valor_despesa_extra="{{ formatarValorReal( $item->valor_despesa_extra ) }}"
                                data-valor_saldo_devedor="{{ formatarValorReal( $item->valor_saldo_devedor ) }}"
                                data-valor_condominio_mensal="{{ formatarValorReal( $item->valor_condominio_mensal ) }}"
                                data-valor_condominio_anual="{{ formatarValorReal( $item->valor_condominio_anual ) }}"
                                data-valor_iptu_mensal="{{ formatarValorReal( $item->valor_iptu_mensal ) }}"
                                data-valor_iptu_anual="{{ formatarValorReal( $item->valor_iptu_anual ) }}"
                                data-valor_prestacao_mensal="{{ formatarValorReal( $item->valor_prestacao_mensal ) }}"
                                data-valor_prestacao="{{ formatarValorReal( $item->valor_prestacao ) }}"
                                data-valor_investimento="{{ formatarValorReal( $item->valor_investimento ) }}"
                                data-valor_reembolso="{{ formatarValorReal( $item->valor_reembolso ) }}"
                                data-valor_saldo_operacao="{{ formatarValorReal( $item->valor_saldo_operacao ) }}"
                                data-descricao ="{{ $item->descricao }}"
                                data-link ="{{ $item->link }}"
                                data-vendido="{{ $item->vendido }}"
                                data-principal="{{ $item->principal }}"
                                data-imagem="{{ $item->imagem }}"
                                data-data_criacao="{{ $item->data_criacao }}"
                                data-data_atualizacao="{{ $item->data_atualizacao }}"
                            >
                                <i class="material-icons">visibility</i>
                                <span>VISUALIZAR</span>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="paginate text-center">
                        @include( 'sgo.inc.paginacao', ['item' => $imoveis])
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
