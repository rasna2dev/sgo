<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="{{ url('sgo/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('sgo/plugins/node-waves/waves.min.css') }}" rel="stylesheet" />
    <link href="{{ url('sgo/plugins/animate-css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ url('sgo/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ url('sgo/css/login.min.css') }}" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>SGO</b></a>
            <small>{{ config('app.name') }}</small>
        </div>
        <div class="card">
            <div class="body">
                @if ($errors->any())
                    <div class="col-sm-12 mt-0">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <form id="sign_in" method="POST">
                    @csrf
                    <div class="msg">Faça login para iniciar sua sessão.</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="usuario" placeholder="Login" value="{{ old('usuario') }}" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="senha" placeholder="Senha" value="{{ old('senha') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5"></div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">ENTRAR</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ url('sgo/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('sgo/plugins/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ url('sgo/plugins/node-waves/waves.js') }}"></script>
</body>

</html>
