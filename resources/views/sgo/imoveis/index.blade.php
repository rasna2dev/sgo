@extends('masterpage')

@section('title', ' / '. $title)

@section('content')

    <div class="row">
        <div class="card">
            <div class="header">
                Imóveis cadastrados
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
    <script>var url = "{{ url('') }}";</script>
    <script src="{{ url('sgo/js/imovel.js') }}"></script>
@endsection
