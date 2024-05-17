<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ config('app.name') }} @yield('title')</title>
    <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="{{ url('sgo/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('sgo/plugins/node-waves/waves.min.css') }}" rel="stylesheet" />
    <link href="{{ url('sgo/plugins/animate-css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ url('sgo/plugins/morrisjs/morris.css') }}" rel="stylesheet" />
    <link href="{{ url('sgo/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
    <link href="{{ url('sgo/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ url('sgo/css/themes/all-themes.min.css') }}" rel="stylesheet" />
    <link href="{{ url('sgo/css/sgo.min.css') }}" rel="stylesheet">
</head>

<body class="theme-red">

    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>aguarde ...</p>
        </div>
    </div>

    <div class="overlay"></div>

    {{-- <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div> --}}

    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="{{ url('') }}">
                    {{ config('app.name') }}
                </a>
            </div>
        </div>
    </nav>
    <section>
        <aside id="leftsidebar" class="sidebar">
            <div class="user-info">
                {{-- <div class="image">
                    <img src="{{ url('images/user.png') }}" width="48" height="48" alt="User" />
                </div> --}}
                <div style="width: 48px;
                    height: 48px;
                    border-radius: 50%;
                    background-color: #333;
                    color: #fff;
                    font-size: 16px;
                    font-weight: bold;
                    text-align: center;
                    line-height: 48px;
                ">
                    {{ Str::limit(auth()->user()->nome, 1, '') }}
                </div>

                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ ucwords(mb_strtolower(auth()->user()->nome)) }}</div>
                    <div class="email">{{ mb_strtolower(auth()->user()->email) }}</div>
                </div>
            </div>
            <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>
                    <li
                    @if(
                        Route::currentRouteName() == 'sgo.add-imoveis.index'
                        || Route::currentRouteName() == 'sgo.imoveis.index'
                        || Route::currentRouteName() == 'sgo.tarifas.index'
                        || Route::currentRouteName() == 'sgo.upd-imoveis.index'
                        || Route::currentRouteName() == 'sgo.dwn-fotos.index'
                    )
                        class="active"
                    @endif>
                        <a  class="menu-toggle">
                            <i class="material-icons">domain</i>
                            <span>Imóveis</span>
                        </a>
                        <ul class="ml-menu">
                            <li
                            @if(
                                Route::currentRouteName() == 'sgo.add-imoveis.index'
                            )
                                class="active"
                            @endif>
                                <a href="{{ route('sgo.add-imoveis.index') }}">
                                    <span>Anexar Novos</span>
                                </a>
                            </li>
                            <li
                            @if(
                                Route::currentRouteName() == 'sgo.upd-imoveis.index'
                            )
                                class="active"
                            @endif>
                                <a href="{{ route('sgo.upd-imoveis.index') }}">
                                    <span>Atualizar Cadastrados</span>
                                </a>
                            </li>
                            <li
                            @if(
                                Route::currentRouteName() == 'sgo.dwn-fotos.index'
                            )
                                class="active"
                            @endif>
                                <a href="{{ route('sgo.dwn-fotos.index') }}">
                                    <span>Baixar Fotos</span>
                                </a>
                            </li>
                            <li
                            @if(
                                Route::currentRouteName() == 'sgo.imoveis.index'
                            )
                                class="active"
                            @endif>
                                <a href="{{ route('sgo.imoveis.index') }}">
                                    <span>Listar Cadastrados</span>
                                </a>
                            </li>
                            @if(auth()->user()->id == 1)
                                <li
                                @if(
                                    Route::currentRouteName() == 'sgo.tarifas.index'
                                )
                                    class="active"
                                @endif>
                                    <a  href="{{ route('sgo.tarifas.index') }}">
                                        <span>Tarifas</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @if(auth()->user()->administrador)
                        <li
                        @if(
                            Route::currentRouteName() == 'sgo.usuarios.index'
                        )
                            class="active"
                        @endif>
                            <a  href="{{ route('sgo.usuarios.index') }}">
                                <i class="material-icons">group</i>
                                <span>Usuários</span>
                            </a>
                        </li>
                    @endif
                    <li
                    @if(
                        Route::currentRouteName() == 'sgo.perfil.index'
                    )
                        class="active"
                    @endif>
                        <a href="{{ route('sgo.perfil.index') }}">
                            <i class="material-icons">account_circle</i>
                            <span>Minha Conta</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sair') }}">
                            <i class="material-icons">logout</i>
                            <span>Desconectar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>
                    SGO / {{ $title }}
                </h2>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @yield('content')
                </div>
            </div>
        </div>
    </section>

    <script src="{{ url('sgo/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('sgo/plugins/bootstrap/js/bootstrap.js') }}"></script>
    <script src="{{ url('sgo/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ url('sgo/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ url('sgo/plugins/node-waves/waves.js') }}"></script>
    <script src="{{ url('sgo/js/pages/ui/modals.js') }}"></script>
    <script src="{{ url('sgo/js/admin.js') }}"></script>
    {{-- <script src="{{ url('js/pages/index.js') }}"></script> --}}
    {{-- <script src="{{ url('js/demo.js') }}"></script> --}}
    @yield('script')
</body>
</html>
