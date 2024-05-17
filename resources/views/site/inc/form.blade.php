<div class="container container-bigger form-request-wrap form-request-wrap-modern">
    <div class="row row-fix justify-content-sm-center justify-content-lg-end">
        <div class="col-lg-6 col-xxl-5">
            <div class="form-request form-request-modern bg-gray-lighter novi-background">
                <h4>Pesquisar Imóvel</h4>
                <form class="rd-mailform form-fix" action="{{ url('') }}" method="GET">
                    <div class="row row-20 row-fix">
                        <div class="col-6">
                            <label class="form-label-outside">Estado</label>
                            <div class="form-wrap form-wrap-inline">
                                <select class="form-input select-filter" id="busca_estado" name="busca_estado" onchange="carregarCidade(this.value)">
                                    <option value="">--</option>
                                    @foreach($estados as $estado)
                                        <option value="{{ $estado->id }}" {{ (isset($req->busca_estado) && $req->busca_estado == $estado->id) ? 'selected' : '' }}>{{ $estado->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label-outside">Tipo</label>
                            <div class="form-wrap form-wrap-inline">
                                <select class="form-input select-filter" id="busca_tipo" name="busca_tipo">
                                    <option value="">--</option>
                                    @foreach($unidades as $unidade)
                                        <option value="{{ $unidade->id }}" {{ (isset($req->busca_tipo) && $req->busca_tipo == $unidade->id) ? 'selected' : '' }}>{{ $unidade->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label-outside">Cidade</label>
                            <div class="form-wrap form-wrap-inline">
                                <select class="form-input select-filter" id="busca_cidade" name="busca_cidade" onchange="carregarBairro(this.value)">
                                    <option value="">--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label-outside">Bairro</label>
                            <div class="form-wrap form-wrap-inline">
                                <select class="form-input select-filter" id="busca_bairro" name="busca_bairro">
                                    <option value="">--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label-outside">Valor Mínimo</label>
                            <div class="form-wrap form-wrap-modern">
                                <input class="form-input input-append" id="busca_valor_min" name="busca_valor_min" type="number" min="0" max="1000000" value="{{ isset($req->busca_valor_min) ? $req->busca_valor_min : '' }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label-outside">Máximo</label>
                            <div class="form-wrap form-wrap-modern">
                                <input class="form-input input-append" id="busca_valor_max" name="busca_valor_max" type="number" min="0" max="1000000" value="{{ isset($req->busca_valor_max) ? $req->busca_valor_max : '' }}">
                            </div>
                        </div>
                        {{-- <div class="col-6">
                            <label class="form-label-outside">Área Mínima</label>
                            <div class="form-wrap form-wrap-modern">
                                <input class="form-input input-append" id="busca_area_min" name="busca_area_min" type="number" min="0" max="1000000" value="{{ isset($req->busca_area_min) ? $req->busca_area_min : '' }}">
                            </div>
                        </div> --}}
                        {{-- <div class="col-6">
                            <label class="form-label-outside">Máxima</label>
                            <div class="form-wrap form-wrap-modern">
                                <input class="form-input input-append" id="busca_area_max" name="busca_area_max" type="number" min="0" max="1000000" value="{{ isset($req->busca_area_max) ? $req->busca_area_max : '' }}">
                            </div>
                        </div> --}}
                        {{-- <div class="col-6">
                            <label class="form-label-outside">Quarto</label>
                            <div class="form-wrap form-wrap-inline">
                                <select class="form-input select-filter" id="busca_quarto" name="busca_quarto">
                                    <option value="">--</option>
                                    <option value="1" {{ (isset($req->busca_quarto) && $req->busca_quarto == 1) ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ (isset($req->busca_quarto) && $req->busca_quarto == 2) ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ (isset($req->busca_quarto) && $req->busca_quarto == 3) ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ (isset($req->busca_quarto) && $req->busca_quarto == 4) ? 'selected' : '' }}>4+</option>
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="col-6">
                            <label class="form-label-outside">Sala</label>
                            <div class="form-wrap form-wrap-inline">
                                <select class="form-input select-filter" id="busca_sala" name="busca_sala">
                                    <option value="">--</option>
                                    <option value="1" {{ (isset($req->busca_sala) && $req->busca_sala == 1) ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ (isset($req->busca_sala) && $req->busca_sala == 2) ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ (isset($req->busca_sala) && $req->busca_sala == 3) ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ (isset($req->busca_sala) && $req->busca_sala == 4) ? 'selected' : '' }}>4+</option>
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="col-6">
                            <label class="form-label-outside">Banheiro</label>
                            <div class="form-wrap form-wrap-inline">
                                <select class="form-input select-filter" id="busca_banheiro" name="busca_banheiro">
                                    <option value="">--</option>
                                    <option value="1" {{ (isset($req->busca_banheiro) && $req->busca_banheiro == 1) ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ (isset($req->busca_banheiro) && $req->busca_banheiro == 2) ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ (isset($req->busca_banheiro) && $req->busca_banheiro == 3) ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ (isset($req->busca_banheiro) && $req->busca_banheiro == 4) ? 'selected' : '' }}>4+</option>
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="col-6">
                            <label class="form-label-outside">Garagem</label>
                            <div class="form-wrap form-wrap-inline">
                                <select class="form-input select-filter" id="busca_garagem" name="busca_garagem">
                                    <option value="">--</option>
                                    <option value="1" {{ (isset($req->busca_garagem) && $req->busca_garagem == 1) ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ (isset($req->busca_garagem) && $req->busca_garagem == 2) ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ (isset($req->busca_garagem) && $req->busca_garagem == 3) ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ (isset($req->busca_garagem) && $req->busca_garagem == 4) ? 'selected' : '' }}>4+</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                    <div class="form-wrap form-button">
                        <button class="button button-block button-secondary" type="submit">pesquisar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
