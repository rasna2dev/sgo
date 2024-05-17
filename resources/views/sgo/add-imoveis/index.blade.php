@extends('masterpage')

@section('title', ' / '. $title)

@section('content')

    <form action="{{ route("{$currentRouteName}.index") }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="card">
                <div class="header">
                    Anexar Novos Imóveis
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Arquivo CSV (máx 2MB):</label>
                            <div class="form-group form-group-lg">
                                <div class="form-line">
                                    <input type="file"
                                        name="arquivo"
                                        id="arquivo"
                                        accept=".csv"
                                        class="form-control"
                                        placeholder="selecione um arquivo"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 text-left">
                            <br><br>
                            <button type="submit" class="btn btn-primary waves-effect">
                                <i class="material-icons">upload_file</i>
                                <span>ENVIAR</span>
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
