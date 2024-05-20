

<form method="POST" id="formUsuario"
    action="{{ route("{$currentRouteName}.update", 1) }}"
>
    @csrf
    @method('PUT')

    <div class="row">
        @if ($errors->any())
            <div class="col-sm-12 mt-0 div-error">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @if(session('success'))
            <div class="col-sm-12 mt-0 div-sucess">
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        <div class="col-sm-6">
            <label>Nome:</label>
            <div class="form-group form-group-lg">
                <div class="form-line">
                    <input type="text"
                        class="form-control"
                        disabled
                        value="{{ $usuario->nome }}"
                    >
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <label>Login:</label>
            <div class="form-group form-group-lg">
                <div class="form-line">
                    <input type="text"
                        class="form-control"
                        disabled
                        value="{{ $usuario->email }}"
                    >
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <label>Estado:</label>
            <div class="form-group form-group-lg">
                <div class="form-line">
                    <input type="text"
                        class="form-control"
                        disabled
                        value="{{ $usuario->uf }}"
                    >
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <label>Whatsapp:</label>
            <div class="form-group form-group-lg">
                <div class="form-line">
                    <input type="text"
                        class="form-control"
                        disabled
                        value="{{ $usuario->telefone }}"
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
                        required
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
                        required
                    >
                </div>
            </div>
        </div>
        <div class="col-sm-12 text-right">
            <button class="btn btn-primary waves-effect" type="submit">
                <i class="material-icons">save</i>
                <span>SALVAR</span>
            </button>
        </div>
    </div>
</form>
