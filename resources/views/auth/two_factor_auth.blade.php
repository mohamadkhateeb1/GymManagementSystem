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
                <p class="login-box-msg">Two Factor Authentication</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action=" {{route('two-factor.enable')}}" method="post">
                    @csrf

                    <div class="row">
                        @if (!$user->two_factor_secret)

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Enable</button>
                            </div>
                            @if (session('status') == 'two-factor-authentication-enabled')
                            <div class="mb-4 font-medium text-sm">
                                Please finish configuring two factor authentication below.
                            </div>
                            @endif
                        @else

                            {!!$user->twoFactorQrCodeSvg()!!}
                            <ul>
                                @foreach ($user->recoveryCodes() as $code)
                                  <li>{{ $code }}</li>
                                @endforeach
                            </ul>

                            @method('DELETE')
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Disable</button>
                            </div>
                        @endif
                         <div class="col-4">
                                {{-- <a href=" {{route('home')}} " class="btn btn-primary btn-block">Home</a> --}}
                            </div>
                        <!-- /.col -->

                        <!-- /.col -->
                    </div>
                </form>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

 
</body>

</html>