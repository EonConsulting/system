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
    <div class="col-md-12">
        @if (session('error_message'))
            <div class="alert alert-danger">
                {{ session('error_message') }}
            </div>
        @endif

        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif

        @if($errors->count() > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif
    </div>
    <storyline-builder :courseid="{{ $course->id }}"></storyline-builder>
@endsection

@section('app-js')
    <script src="{{url('/js/app.js') }}"></script>
@endsection

@section('custom-scripts')
    <script src="{{url('/vendor/filemanager/lib/ckfinder/ckfinder.js') }}"></script>
@endsection