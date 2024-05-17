

<form method="POST" id="formImovel"
    data-act="{{ route("{$currentRouteName}.index") }}"
    data-id=""
    onsubmit="return false"
>
        @csrf
    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="modal-title">
                                Imóvel
                                <span class="imv-matricula_id"></span>
                            </h4>
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

                        <div class="col-sm-3"></div>
                        <div class="col-sm-6 text-center">
                            <div class="row">
                                <div class="col-sm-12">
                                    <img class="imv-imagem">
                                </div>
                                <div class="col-sm-12 text-right">
                                    <a title="Remover Imagem" class="a-link-del-imagem" href="#remover-imagem"></a>
                                    <a title="Adicionar destaque" class="a-link-add-principal" href="#favoritos"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3"></div>

                        <div class="col-sm-6">
                            <label>Usuário:</label><br>
                            <span class="imv-usuario"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Criado:</label><br>
                            <span class="imv-data_criacao"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Atualizado:</label><br>
                            <span class="imv-data_atualizacao"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Matrícula:</label><br>
                            <a target="_blank" class="lnk-matricula_id">
                                <span class="imv-matricula_id"></span>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <label>Estado:</label><br>
                            <span class="imv-estado"></span>
                        </div>
                        <div class="col-sm-6">
                            <label>Cidade:</label><br>
                            <span class="imv-cidade"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Bairro:</label><br>
                            <span class="imv-bairro"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Tipo:</label><br>
                            <span class="imv-unidade"></span>
                        </div>
                        <div class="col-sm-6">
                            <label>Endereço:</label><br>
                            <span class="imv-endereco"></span>
                        </div>

                        <div class="col-sm-3">
                            <label>Área Total:</label><br>
                            <span class="imv-area_total"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Área Privativa:</label><br>
                            <span class="imv-area_privativa"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Área Terreno:</label><br>
                            <span class="imv-area_terreno"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>&nbsp;</label><br>
                            <span>&nbsp;</span>
                        </div>
                        <div class="col-sm-3">
                            <label>Quartos:</label><br>
                            <span class="imv-quartos"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Banheiro:</label><br>
                            <span class="imv-banheiros"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Salas:</label><br>
                            <span class="imv-salas"></span>
                        </div>
                        <div class="col-sm-3">
                            <label>Vagas Gar.:</label><br>
                            <span class="imv-vagas_garagem"></span>
                        </div>
                        <div class="col-sm-12">
                            <label>Descrição:</label><br>
                            <span class="imv-descricao"></span>
                        </div>
                        <div class="col-sm-12 m-t-20">
                            <div class="row">
                                <div class="col-sm-6">
                                    Valor de Mercado: <span class="imv-valor_mercado col-cyan"></span><br>
                                    Valor de Avaliação: <span class="imv-valor_avaliacao col-cyan"></span><br>
                                    Valor de Arremate: <span class="imv-valor_arremate col-cyan"></span><br>
                                    Desconto: <span class="imv-valor_desconto col-cyan"></span><br>
                                    Condominio: <span class="imv-valor_condominio_mensal col-cyan"></span><br>
                                    IPTU / Mensal: <span class="imv-valor_iptu_mensal col-cyan"></span><br>
                                    Prestação do Financiamento: <span class="imv-valor_prestacao_mensal col-cyan"></span><br>
                                    Entrada: <span class="imv-valor_entrada col-cyan"></span><br>
                                    Documentação: <span class="imv-valor_documentacao col-cyan"></span><br>
                                    Desocupação: <span class="imv-valor_desocupacao col-cyan"></span><br>
                                    Reforma: <span class="imv-valor_reforma col-cyan"></span><br>
                                    Depósito Inicial: <span class="imv-valor_deposito_inicial col-cyan"></span>
                                </div>
                                <div class="col-sm-6">
                                    Prazo de venda / meses: <span class="imv-valor_prazo col-cyan"></span><br>
                                    Prestação: <span class="imv-valor_prestacao col-cyan"></span><br>
                                    Condominio: <span class="imv-valor_condominio_anual col-cyan"></span><br>
                                    IPTU: <span class="imv-valor_iptu_anual col-cyan"></span><br>
                                    Despesa de Venda: <span class="imv-valor_despesa_venda col-cyan"></span><br>
                                    Despesas Extras / Geral: <span class="imv-valor_despesa_extra col-cyan"></span><br>
                                    Investimento TOTAL: <span class="imv-valor_investimento col-cyan"></span><br>
                                    Valor de venda: <span class="imv-valor_mercado col-cyan"></span><br>
                                    Saldo devedor: <span class="imv-valor_saldo_devedor col-cyan"></span><br>
                                    Reembolso: <span class="imv-valor_reembolso col-cyan"></span><br>
                                    <strong class="font-20 col-cyan">
                                        Saldo da Operação: <span class="imv-valor_saldo_operacao"></span>
                                    </strong>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button class="btn btn-primary waves-effect" type="submit">
                        <i class="material-icons">save</i>
                        <span>SALVAR</span>
                    </button> --}}
                </div>
            </div>
        </div>
    </div>
</form>
