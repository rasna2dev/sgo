@extends('site')

@section('content')
    @include('site.inc.swiper')
    <section class="section section-variant-1 bg-default novi-background bg-cover">
        <div class="container container-wide">
            <div class="row row-50">
                <div class="col-12">
                    <h1 class="text-center text-red">Página não encontrada.</h1>
                </div>
            </div>
        </div>
    </section>

    <script>
        var imagens = [];
    </script>
@endsection

@section('script')
    @include('site.inc.script')
@endsection
