<div class="row">
    <div class="body table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 74%">TARIFAS</th>
                    <th style="width: 13%" class="text-center">STATUS</th>
                    <th style="width: 13%">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @if($tarifas->isEmpty())
                    <tr>
                        <td colspan="3" class="font-bold col-pink text-center">
                            Nenhuma tarifa encontrada.
                        </td>
                    </tr>
                @else
                    @foreach($tarifas as $item)
                        <tr>
                            <td scope="row" class="vertical-align-middle">
                                <br>
                                @foreach([
                                    'valor_prazo', 'valor_inicial', 'valor_final', 'valor_desconto',
                                    'valor_condominio', 'valor_iptu', 'valor_prestacao_financiamento',
                                    'valor_entrada', 'valor_documentacao',
                                    'valor_desocupacao', 'valor_reforma', 'valor_despesa_venda',
                                    'valor_despesa_extra', 'ativo'
                                ] as $column)
                                    @php
                                        $column_nome = $column;
                                        $column_nome = ucwords(str_replace('_', ' ', $column_nome));
                                        $column_nome = str_replace('Valor ', '', $column_nome);
                                    @endphp
                                    <div class="col-sm-4 m-t--20 p-b--20">
                                            {{ $column_nome }}
                                            @if(in_array($column, [
                                                'valor_inicial', 'valor_final'
                                            ]))
                                                (R$)
                                            @elseif(in_array($column, ['valor_prazo']))
                                            @else
                                                (%)
                                            @endif
                                        :
                                        <strong>{{ $item->{$column} }}</strong>
                                    </div>
                                @endforeach
                            </td>
                            <td class="vertical-align-middle text-center">
                                @if($item->ativo)
                                    <span class="text-success">
                                        <i class="material-icons">toggle_on</i>
                                    </span>
                                @else
                                    <span class="text-danger">
                                        <i class="material-icons">toggle_off</i>
                                    </span>
                                @endif
                            </td>
                            <td class="vertical-align-middle text-center">
                                <button type="button" class="btn btn-info waves-effect modalTarifa"
                                    data-toggle="modal"
                                    data-target="#largeModal"
                                    data-acao="atualizar"
                                    data-id="{{ $item->id }}"
                                    data-ativo="{{ $item->ativo }}"
                                    @foreach([
                                        'valor_prazo', 'valor_inicial', 'valor_final', 'valor_desconto',
                                        'valor_iptu', 'valor_prestacao_financiamento',
                                        'valor_condominio', 'valor_entrada', 'valor_documentacao',
                                        'valor_desocupacao', 'valor_reforma', 'valor_despesa_venda',
                                        'valor_despesa_extra', 'ativo'
                                    ] as $column)
                                        data-{{ $column }}="{{ $item->{ $column } }}"
                                    @endforeach
                                >
                                    <i class="material-icons">visibility</i>
                                    <span>VISUALIZAR</span>
                                </button>

                                <button type="button" class="btn btn-danger m-t-10 waves-effect  modalTarifaRemover"
                                    data-toggle="modal"
                                    data-target="#largeModalDelete"
                                    data-acao="remover"
                                    data-id="{{ $item->id }}"
                                >
                                    <i class="material-icons">delete</i>
                                    <span>REMOVER</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
