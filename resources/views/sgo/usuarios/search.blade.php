<form
    action="{{ route("{$currentRouteName}.index") }}"
    method="GET">
    @csrf

    <div class="row">
        <div class="col-sm-6">
            <label class="m-b-5">Pesquisar:</label>
            <div class="form-group form-group-lg">
                <div class="form-line">
                    <input type="text"
                        name="pesquisar"
                        id="pesquisar"
                        class="form-control uppercase"
                        placeholder="Usuário, login ou telefone"
                        value="{{ request()->has('pesquisar') ? request()->get('pesquisar') : '' }}"
                    >
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <label class="m-b-20">Estado:</label>
            <select
                class="form-control show-tick"
                id="pesquisar_uf"
                name="pesquisar_uf">
                <option value="">Escolha um Estado</option>
                @foreach($estados AS $key => $value)
                    <option value="{{ $key }}" {{ (request()->has('pesquisar_uf') ? (request()->get('pesquisar_uf') == $key ? 'selected' : '') : '') }}>{{ mb_strtoupper($value) }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-3 text-left">
            <a class="btn btn-primary waves-effect modalUsuario"
                data-toggle="modal"
                data-target="#largeModal"
                data-acao="cadastrar"
                data-id="0"
                data-nome=""
                data-email=""
                data-uf=""
                data-telefone=""
                data-administrador="0"
                data-ativo="1"
            >
                <i class="material-icons">save</i>
                <span>CADASTRAR</span>
            </a>
        </div>

        <div class="col-sm-9 text-right">
            <a class="btn btn-success waves-effect" href="{{ route("{$currentRouteName}.index") }}">
                <i class="material-icons">cleaning_services</i>
                <span>REDEFINIR</span>
            </a>
            <button type="submit" class="btn btn-success waves-effect">
                <i class="material-icons">search</i>
                <span>PESQUISAR</span>
            </button>
        </div>
    </div>
</form>
