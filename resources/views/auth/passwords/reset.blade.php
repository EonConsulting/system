@extends('auth.index')

@section('site-title')
    Reset Password
@endsection

@section('custom-styles')
    <!-- iCheck -->
    <link rel="stylesheet" href="/plugins/iCheck/square/blue.css">
@endsection

@section('body-class')
    hold-transition login-page
@endsection

@section('content')
    <div class="login-box">
        <!--   <div class="login-logo">
            <a href="../../index2.html"><b>Unisa</b></a>
          </div> -->
        <!-- /.login-logo -->
        <div class="login-box-body">
            <center>
                <img src="/dist/img/unisa2.png" alt="photo3" />
            </center>
            <p class="login-box-msg">Reset Password</p>

            <form action="{{ url('/password/reset') }}" method="post">
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-xs-12">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{ url('/login') }}" class="text-center">I already have a membership</a>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
@endsection

@section('custom-scripts')
    <!-- iCheck -->
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection