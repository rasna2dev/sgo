@extends('site')

@section('title', $tags->title)
@section('description', $tags->description)
@section('keywords',  $tags->keywords)

@section('content')
    @include('site.inc.swiper')
    @include('site.inc.list')
@endsection

@section('script')
    @include('site.inc.script')
@endsection
