<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Two Factor Authentication</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            color: #1f2937;
        }

        .card {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .card-top {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            padding: 36px 30px 28px;
            text-align: center;
            color: #fff;
        }

        .shield {
            width: 64px;
            height: 64px;
            margin: 0 auto 14px;
            background: rgba(255, 255, 255, 0.18);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .shield svg {
            width: 32px;
            height: 32px;
            fill: #fff;
        }

        .card-top h1 {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .card-top p {
            font-size: 13px;
            opacity: 0.85;
            margin-top: 4px;
        }

        .card-body {
            padding: 30px;
        }

        .lead {
            font-size: 14px;
            line-height: 1.6;
            color: #6b7280;
            text-align: center;
            margin-bottom: 22px;
        }

        .alert {
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 13.5px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: #fef2f2;
            color: #b91c1c;
            border: 1px solid #fecaca;
        }

        .alert-danger ul {
            list-style: none;
        }

        .alert-info {
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }

        .qr-wrapper {
            display: flex;
            justify-content: center;
            padding: 18px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            margin-bottom: 22px;
        }

        .qr-wrapper svg {
            width: 190px;
            height: 190px;
            border-radius: 8px;
        }

        .recovery {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 24px;
        }

        .recovery-title {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .recovery-title svg {
            width: 16px;
            height: 16px;
            fill: #8b5cf6;
        }

        .recovery ul {
            list-style: none;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .recovery li {
            font-family: 'SFMono-Regular', Consolas, monospace;
            font-size: 13px;
            color: #4b5563;
            background: #fff;
            border: 1px dashed #d1d5db;
            border-radius: 8px;
            padding: 8px 10px;
            text-align: center;
        }

        .btn {
            width: 100%;
            border: none;
            border-radius: 12px;
            padding: 13px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            transition: transform 0.15s ease, box-shadow 0.2s ease, opacity 0.2s ease;
        }

        .btn svg {
            width: 18px;
            height: 18px;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff;
            box-shadow: 0 8px 20px -6px rgba(99, 102, 241, 0.6);
        }

        .btn-primary svg {
            fill: #fff;
        }

        .btn-danger {
            background: #fff;
            color: #dc2626;
            border: 1.5px solid #fecaca;
        }

        .btn-danger:hover {
            background: #fef2f2;
        }

        .btn-danger svg {
            fill: #dc2626;
        }

        .divider {
            height: 1px;
            background: #e5e7eb;
            margin: 22px 0 18px;
        }

        .btn-back {
            background: #f3f4f6;
            color: #4b5563;
        }

        .btn-back:hover {
            background: #e5e7eb;
        }

        .btn-back svg {
            fill: #4b5563;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-top">
            <div class="shield">
                <!-- shield icon -->
                <svg viewBox="0 0 24 24">
                    <path
                        d="M12 1 3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z" />
                </svg>
            </div>
            <h1>Two Factor Authentication</h1>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (!$user->two_factor_secret)
                {{-- حالة: التفعيل --}}
                <p class="lead">
                    Add an extra layer of security to your account by enabling two factor authentication.
                </p>

                @if (session('status') == 'two-factor-authentication-enabled')
                    <div class="alert alert-info">
                        Please finish configuring two factor authentication below.
                    </div>
                @endif

                <form action="{{ route('two-factor.enable') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm3 11c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                        </svg>
                        Enable
                    </button>
                </form>
            @else
                {{-- حالة: مفعّل (QR + أكواد الاسترجاع + إلغاء) --}}
                <p class="lead">
                    Scan the following QR code using your authenticator application,
                    then store your recovery codes somewhere safe.
                </p>

                <div class="qr-wrapper">
                    {!! $user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="recovery">
                    <div class="recovery-title">
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M12.65 10A5.99 5.99 0 0 0 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6a5.99 5.99 0 0 0 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                        </svg>
                        Recovery Codes
                    </div>
                    <ul>
                        @foreach ($user->recoveryCodes() as $code)
                            <li>{{ $code }}</li>
                        @endforeach
                    </ul>
                </div>

                <form action="{{ route('two-factor.enable') }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <svg viewBox="0 0 24 24">
                            <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z" />
                        </svg>
                        Disable
                    </button>
                </form>
            @endif

            <div class="divider"></div>

            @if (Auth::guard('employee')->check())
                <a href="{{ route('employee.dashboard') }}" class="btn btn-back">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                    </svg>
                    العودة للوحة التحكم
                </a>
            @else
                <a href="{{ route('admin.dashboard') }}" class="btn btn-back">
                    <svg viewBox="0 0 24 24">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                    </svg>
                    العودة للوحة التحكم
                </a>
            @endif
        </div>
    </div>
</body>

</html>
