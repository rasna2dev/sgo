

<form method="POST" id="formUsuario"
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

                        <div class="col-sm-6">
                            <label>Nome:</label>
                            <div class="form-group form-group-lg">
                                <div class="form-line">
                                    <input type="text"
                                        name="nome"
                                        id="nome"
                                        class="form-control uppercase"
                                        maxlength="255"
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label>Login:</label>
                            <div class="form-group form-group-lg">
                                <div class="form-line">
                                    <input type="email"
                                        name="email"
                                        id="email"
                                        class="form-control lowercase"
                                        maxlength="255"
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="m-b-20">Estado:</label>
                            <select
                                class="form-control show-tick"
                                id="uf"
                                name="uf"
                                required>
                                <option value="">Escolha um Estado</option>
                                @foreach($estados AS $key => $value)
                                    <option value="{{ $key }}">{{ mb_strtoupper($value) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label>
                                Whatsapp:
                                <span class="font-12">(+5599987654321)</span>
                            </label>
                            <div class="form-group form-group-lg">
                                <div class="form-line">
                                    <input type="tel"
                                        name="telefone"
                                        id="telefone"
                                        class="form-control"
                                        maxlength="20"
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label>Senha:</label>
                            <div class="form-group form-group-lg">
                                <div class="form-line">
                                    <input type="password"
                                        name="senha"
                                        id="senha"
                                        class="form-control"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label>Confirmar Senha:</label>
                            <div class="form-group form-group-lg">
                                <div class="form-line">
                                    <input type="password"
                                        name="resenha"
                                        id="resenha"
                                        class="form-control"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="m-b-20">Administrador:</label>
                            <div class="demo-switch">
                                <div class="switch">
                                    <label>
                                        NÃO <input type="checkbox" name="administrador" id="administrador" checked value="0">
                                            <span class="lever"></span> SIM
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="m-b-20">Status:</label>
                            <div class="demo-switch">
                                <div class="switch">
                                    <label>
                                        INATIVO <input type="checkbox" name="ativo" id="ativo" checked value="0">
                                            <span class="lever"></span> ATIVO
                                    </label>
                                </div>
                            </div>
                        </div>
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
