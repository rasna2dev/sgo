@extends('masterpage')

@section('title', ' / '. $title)

@section('content')

    <form action="{{ route("{$currentRouteName}.update", 1) }}"
        method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="card">
                <div class="header">
                    Atualizar Imóveis em Massa
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Clique no botão abaixo para atualizar os valores todos os imóveis cadastrados:</label>
                            <br><br>
                            <button type="submit" class="btn btn-primary waves-effect">
                                <i class="material-icons">save</i>
                                <span>ATUALIZAR</span>
                            </button>
                        </div>
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
                        <div class="col-sm-12 mt-0">
                            @if (
                                session('contador') ||
                                session('atualizados') ||
                                session('cadastrados') ||
                                session('descartados') ||
                                session('vendidos')
                            )
                                <strong class="text-success">Processo executado:</strong><br>
                            @endif

                            @if (session('contador'))
                                Qtd. de Linhas Encontradas: {{ session('contador')}}<br>
                            @endif

                            @if (session('atualizados'))
                                Qtd. de Imóveis Atualizados: {{ session('atualizados') }}<br>
                            @endif

                            @if (session('cadastrados'))
                                Qtd. de Imóveis Cadastrados: {{ session('cadastrados') }}<br>
                            @endif

                            @if (session('descartados'))
                                Qtd. de Imóveis Descartados: {{ session('descartados') }}<br>
                            @endif

                            @if (session('vendidos'))
                                Qtd. de Imóveis Vendidos: {{ session('vendidos') }}<br>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
