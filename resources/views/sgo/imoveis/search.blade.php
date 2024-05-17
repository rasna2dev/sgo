<form
    action="{{ route("{$currentRouteName}.index") }}"
    method="GET">
    <div class="row">
        <div class="col-sm-3">
            <label>Matrícula:</label>
            <div class="form-group form-group-lg">
                <div class="form-line">
                    <input type="number"
                        name="pesquisar_matricula"
                        id="pesquisar_matricula"
                        class="form-control"
                        value="{{ request()->has('pesquisar_matricula') ? request()->get('pesquisar_matricula') : '' }}"
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
        <div class="col-sm-6">
            <label class="m-b-20">Cidade:</label>
            <select
                class="form-control show-tick"
                id="pesquisar_cidade"
                name="pesquisar_cidade">
                <option value="">Escolha uma Cidade</option>
                @foreach($cidades AS $cidade)
                    <option value="{{ $cidade->id }}" {{ (request()->has('pesquisar_cidade') ? (request()->get('pesquisar_cidade') == $cidade->id ? 'selected' : '') : '') }}>{{ mb_strtoupper($cidade->nome) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-12 mt-0">
            <label class="m-b-5">Pesquisar:</label>
            <div class="form-group form-group-lg">
                <div class="form-line">
                    <input type="text"
                        name="pesquisar"
                        id="pesquisar"
                        class="form-control uppercase"
                        placeholder="Endereço ou descrição"
                        value="{{ request()->has('pesquisar') ? request()->get('pesquisar') : '' }}"
                    >
                </div>
            </div>
        </div>
        <div class="col-sm-12 text-right">
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
