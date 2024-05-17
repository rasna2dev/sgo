<!DOCTYPE html>
<html class="wide wow-animation" lang="pt-br">
    <head>
        <title>@yield('title')</title>
        <meta name="description" content="@yield('description')">
        <meta name="keywords" content="@yield('keywords')">
        <meta name="robots" content="index, follow">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        {{-- <meta name="google-site-verification" content="">  --}}
        <link href="{{ request()->url() }}" rel="canonical">
        <meta name="author" content="VIP Imóveis da Caixa">
        <meta name="copyright" content="VIP Imóveis da Caixa">
        {{-- <meta name="e-mail" content=""> --}}
        <link rel="icon" href="{{ url('favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald:200,400%7CLato:300,400,300italic,700%7CMontserrat:900">
        <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('css/style.min.css') }}">
        <link rel="stylesheet" href="{{ url('css/fonts.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="{{ url('css/site.min.css') }}">
    </head>
    <body>
        @include('site.inc.page-loader')
        <div class="page">
            @include('site.inc.header')
            @yield('content')
            @include('site.inc.footer')
        </div>
        <div class="snackbars" id="form-output-global"> </div>
        <script src="{{ url('js/core.min.js') }}"></script>
        <script src="{{ url('js/script.min.js') }}"></script>
        @yield('script')
    </body>
</html>
