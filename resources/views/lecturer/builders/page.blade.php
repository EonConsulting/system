@extends('layouts.lecturer')

@section('site-title')
    Content Builder
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
    Content Builder
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <form id="save" method="POST" action="{{ route('content.builder') }}">
                <textarea id="ckeditorplugin" class="ckeditor" name="editor">&lt;p&gt;Initial editor content.&lt;/p&gt;</textarea>
                <br />
                <button type="button" id="submit" class="btn">Save Data</button>
                <input type="hidden" id="data" name="data"/>

            </form>
        </div>


    </div>
@endsection

@section('custom-scripts')
    <script src="/vendor/ckeditorplugin/ckeditor/ckeditor.js"></script>
    <script>
        $(function(){
            /**
             * Create a New Instance of the CK Editor
             */
            var editor = CKEDITOR.replace( 'ckeditorplugin', {
                    // Load the Course Content Plugin to the Editor
    //                extraPlugins: 'coursecontent',
                }
    //            config.allowedContent = true
            );

            editor.config.fullPage = true;
    {{--        CKEDITOR.document.appendStyleSheet("{{URL::asset('/vendor/ckeditorplugin/css/custom-contents.css')}}");--}}

            $('#submit').on('click', function (event) {
    //            event.preventDefault();
    //            CKEDITOR.instances.ckeditorplugin.updateElement();
                var data = $('#ckeditorplugin').val();

                $('#data').val(data);

                console.log(data);

                $('form')[0].submit();

                console.log(data);

                {{--$.ajax({--}}
                    {{--url: '{{ route('content.builder') }}',--}}
                    {{--context: document.body,--}}
                    {{--data: {--}}
                        {{--data: data--}}
                    {{--},--}}
                    {{--success: function (response) {--}}
                        {{--alert(data); // Get Current Editor Data.--}}
                        {{--console.log(response);--}}
                    {{--}--}}

                {{--});--}}

            });
        });
    </script>
@endsection