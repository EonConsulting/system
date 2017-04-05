@extends('layouts.lecturer')

@section('site-title')
    Storyline Builder
@endsection

@section('custom-styles')

@endsection

@section('body-class')

@endsection

@section('mini-logo-title')
    Unisa
@endsection

@section('logo-title')
    Unisa
@endsection

@section('page-title')
    Storyline Builder
@endsection

@section('content')
    <storyline-builder></storyline-builder>
@endsection

@section('app-js')
    <script src="{{ url('/js/app.js') }}"></script>
@endsection

@section('custom-scripts')
    <script src="{{ url('/vendor/filemanager/lib/ckfinder/ckfinder.js') }}"></script>
@endsection