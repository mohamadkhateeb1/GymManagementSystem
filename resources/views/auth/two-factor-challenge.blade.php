<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}} </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/dashboard/dist/css/adminlte.min.css')}}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">

            </div>
            <div class="card-body">
                <p class="login-box-msg">Enter 2fa code</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($errors->has('code'))
                    {{ $errors->first('code') }}
                @endif
                <form action=" {{route('two-factor.login')}}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="2fa code" name="code" autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="recovery code" name="recovery_code"
                            autocomplete="off">
                    </div>

                    <div class="row">

                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <!-- /.social-auth-links -->


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{asset('assets/dashboard/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dashboard/dist/js/adminlte.min.js')}}"></script>
</body>

</html>