@extends('layouts.lecturer')

@section('site-title')
    Create a Course
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
    Create a Course
@endsection

@section('content')
    <create-course></create-course>
@endsection

@section('app-js')
    <script src="{{url('/js/app.js')}}"></script>
@endsection

@section('custom-scripts')
    <script src="{{url('/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')}}"></script>
@endsection