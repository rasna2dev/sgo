@extends('masterpage')

@section('title', ' / '. $title)

@section('content')

    <div class="row">
        <div class="card">
            <div class="header">
                Usuários cadastrados
            </div>
            <div class="body">

                @include( $currentRouteName . '.search' )
                @include( $currentRouteName . '.list' )

            </div>
        </div>
    </div>

    @include( $currentRouteName . '.form' )

@endsection


@section('script')
    <script src="{{ url('sgo/js/sgo.js') }}"></script>
    <script src="{{ url('sgo/js/usuario.js') }}"></script>
@endsection
