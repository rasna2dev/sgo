

<form method="POST" id="formTarifa"
    data-act="{{ route("{$currentRouteName}.index") }}"
    onsubmit="return false"
>
        @csrf
    <input type="hidden" name="_method" id="_method">
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="modal-title" id="largeModalLabel"></h4>
                        </div>
                        <div class="col-sm-2 text-right">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-12 mt-0 hide _resposta" id="resposta">
                            <div class="alert">
                                <ul></ul>
                            </div>
                        </div>

                        @foreach([
                            'valor_prazo', 'valor_inicial', 'valor_final', 'valor_desconto',
                            'valor_condominio', 'valor_iptu', 'valor_prestacao_financiamento',
                            'valor_entrada', 'valor_documentacao',
                            'valor_desocupacao', 'valor_reforma', 'valor_despesa_venda',
                            'valor_despesa_extra', 'ativo'
                        ] as $column)
                            <div class="col-sm-4">
                                @if($column == 'ativo')
                                    <label class="m-b-20">Status:</label>
                                    <div class="demo-switch">
                                        <div class="switch">
                                            <label>
                                                INATIVO <input type="checkbox" name="ativo" id="ativo" checked value="0">
                                                    <span class="lever"></span> ATIVO
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    @php
                                        $column_nome = $column;
                                        $column_nome = ucwords(str_replace('_', ' ', $column_nome));
                                        $column_nome = str_replace('Valor ', '', $column_nome);
                                    @endphp
                                    <label>
                                        {{ $column_nome }}:
                                        @if(in_array($column, [
                                            'valor_inicial', 'valor_final'
                                        ]))
                                            (R$)
                                        @elseif(in_array($column, ['valor_prazo']))
                                        @else
                                            (%)
                                        @endif
                                    </label>
                                    <div class="form-group form-group-lg">
                                        <div class="form-line">
                                            <input type="number"
                                                name="{{ $column }}"
                                                id="{{ $column }}"
                                                placeholder="0.0"
                                                class="form-control"
                                                maxlength="255"
                                                value="0"
                                                min="0"
                                                max="99999999999"
                                                step="any"
                                                required
                                            >
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary waves-effect" type="submit">
                        <i class="material-icons">save</i>
                        <span>SALVAR</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>





<form method="POST" id="formTarifaDelete"
    data-act="{{ route("{$currentRouteName}.index") }}"
    onsubmit="return false"
>
        @csrf
        @method('DELETE')
        <input type="hidden" name="delete_id" id="delete_id">
    <div class="modal fade" id="largeModalDelete" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="modal-title" id="largeModalLabelDelete">Remover Tarifa</h4>
                        </div>
                        <div class="col-sm-2 text-right">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">
                                <i class="material-icons">close</i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 mt-0 hide _resposta" id="resposta_delete">
                            <div class="alert">
                                <ul></ul>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <h4>Deseja mesmo remover esta Tarifa?</h4>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary waves-effect"  data-dismiss="modal" type="button">
                        <i class="material-icons">close</i>
                        <span>Não</span>
                    </button>
                    <button class="btn btn-danger waves-effect" type="submit">
                        <i class="material-icons">done</i>
                        <span>Sim</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
