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
                    Baixar Fotos de Imóveis em Massa
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Clique no botão abaixo para buscar e atualizar fotos do imóveis:</label>
                            <br><br>
                            <button type="submit" class="btn btn-primary waves-effect">
                                <i class="material-icons">download</i>
                                <span>BAIXAR</span>
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
                                session('erros')
                            )
                                <strong class="text-success">Processo executado:</strong><br>
                            @endif

                            @if (session('contador'))
                                Qtd. de Imóveis Encontrados: {{ session('contador')}}<br>
                            @endif

                            @if (session('atualizados'))
                                Qtd. de Fotos de Imóveis Atualizados: {{ session('atualizados') }}<br>
                            @endif

                            @if (session('erros'))
                                Qtd. de Fotos de Imóveis não Baixadas: {{ session('erros') }}<br>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
