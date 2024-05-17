@extends('masterpage')

@section('title', ' / '. $title)

@section('content')

<div class="row">
    <div class="card">
        <div class="header">
            Meus Dados
        </div>
        <div class="body">

            @include( $currentRouteName . '.form' )

        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="{{ url('sgo/js/perfil.js') }}"></script>
@endsection
