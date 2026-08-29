@extends('Employee.layouts.app')

@section('title', 'المصادقة الثنائية | Elite Club')

@section('styles')
<style>
    .employee-two-factor-page {
        width: 100%;
        min-height: calc(100vh - 120px);
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 35px 20px 60px;
    }

    .employee-two-factor-card {
        width: 100%;
        max-width: 760px;
        background: var(--surface, #171d27);
        border: 1px solid rgba(201, 169, 97, .22);
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 70px rgba(0,0,0,.28);
        position: relative;
    }

    .employee-two-factor-card::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        height: 3px;
        background: linear-gradient(
            90deg,
            transparent,
            #c9a961,
            #e6c978,
            #c9a961,
            transparent
        );
    }

    .employee-two-factor-header {
        min-height: 145px;
        padding: 30px 34px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 25px;

        background:
            radial-gradient(
                circle at 15% 50%,
                rgba(201,169,97,.08),
                transparent 35%
            ),
            linear-gradient(
                135deg,
                rgba(255,255,255,.025),
                rgba(201,169,97,.025)
            );

        border-bottom: 1px solid rgba(201,169,97,.16);
    }

    .employee-two-factor-header-info {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .employee-two-factor-icon {
        width: 72px;
        height: 72px;
        flex: 0 0 72px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 20px;

        color: #c9a961;
        background: rgba(201,169,97,.07);
        border: 1px solid rgba(201,169,97,.32);
    }

    .employee-two-factor-icon i {
        font-size: 29px;
    }

    .employee-two-factor-title {
        margin: 0;
        color: var(--text, #f4f1e9);
        font-size: 24px;
        font-weight: 800;
    }

    .employee-two-factor-subtitle {
        display: block;
        margin-top: 4px;
        color: var(--muted, #8f99a8);
        font-size: 13px;
    }

    .employee-security-badge {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 8px 13px;
        border-radius: 999px;
        color: #c9a961;
        background: rgba(201,169,97,.07);
        border: 1px solid rgba(201,169,97,.22);
        font-size: 11px;
        font-weight: 700;
    }

    .employee-two-factor-body {
        padding: 34px;
    }

    .employee-two-factor-alert {
        padding: 14px 17px;
        margin-bottom: 22px;
        border-radius: 13px;
        font-size: 13px;
        line-height: 1.8;
    }

    .employee-two-factor-alert ul {
        margin: 0;
        padding-right: 18px;
    }

    .employee-two-factor-alert-danger {
        color: #fca5a5;
        background: rgba(239,68,68,.08);
        border: 1px solid rgba(239,68,68,.22);
    }

    .employee-two-factor-alert-info {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #93c5fd;
        background: rgba(59,130,246,.07);
        border: 1px solid rgba(59,130,246,.20);
    }

    .employee-two-factor-intro {
        text-align: center;
        max-width: 600px;
        margin: 0 auto 28px;
    }

    .employee-two-factor-intro h3 {
        margin: 0 0 8px;
        color: var(--text, #f4f1e9);
        font-size: 17px;
    }

    .employee-two-factor-intro p {
        margin: 0;
        color: var(--muted, #8f99a8);
        font-size: 13px;
        line-height: 1.9;
    }

    .employee-security-info-box {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 18px 20px;
        margin-bottom: 25px;
        border-radius: 16px;
        background: var(--surface-2, rgba(255,255,255,.025));
        border: 1px solid rgba(201,169,97,.15);
    }

    .employee-security-info-icon {
        width: 43px;
        height: 43px;
        flex: 0 0 43px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 12px;

        color: #c9a961;
        background: rgba(201,169,97,.08);
        border: 1px solid rgba(201,169,97,.20);
    }

    .employee-security-info-content h4 {
        margin: 0 0 5px;
        color: var(--text, #f4f1e9);
        font-size: 14px;
    }

    .employee-security-info-content p {
        margin: 0;
        color: var(--muted, #8f99a8);
        font-size: 12px;
        line-height: 1.8;
    }

    .employee-two-factor-btn {
        width: 100%;
        min-height: 54px;

        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;

        border-radius: 13px;
        cursor: pointer;

        font-size: 14px;
        font-weight: 750;

        transition: .2s ease;
    }

    .employee-two-factor-btn:hover {
        transform: translateY(-2px);
    }

    .employee-two-factor-btn-primary {
        color: #171717;
        background: linear-gradient(135deg, #d9b968, #bd9540);
        border: 1px solid rgba(230,201,120,.45);
    }

    .employee-two-factor-btn-danger {
        color: #ef9a9a;
        background: rgba(239,68,68,.035);
        border: 1px solid rgba(239,68,68,.20);
    }

    .employee-qr-section {
        margin-bottom: 28px;
    }

    .employee-qr-title {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 14px;
        color: var(--text, #f4f1e9);
        font-size: 14px;
        font-weight: 750;
    }

    .employee-qr-title i {
        color: #c9a961;
    }

    .employee-qr-wrapper {
        min-height: 285px;

        display: flex;
        align-items: center;
        justify-content: center;

        padding: 28px;

        border-radius: 18px;
        background: #fff;

        border: 1px solid rgba(201,169,97,.35);

        box-shadow:
            inset 0 0 0 8px #f8f8f8,
            0 12px 35px rgba(0,0,0,.16);
    }

    .employee-qr-wrapper svg {
        width: 220px;
        height: 220px;
        max-width: 100%;
    }

    .employee-qr-note {
        margin: 12px 0 0;
        text-align: center;
        color: var(--muted, #8f99a8);
        font-size: 11px;
        line-height: 1.7;
    }

    .employee-recovery-section {
        margin: 25px 0 28px;
        padding: 21px;
        border-radius: 17px;
        background: rgba(201,169,97,.035);
        border: 1px solid rgba(201,169,97,.17);
    }

    .employee-recovery-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 17px;
    }

    .employee-recovery-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--text, #f4f1e9);
        font-size: 14px;
        font-weight: 750;
    }

    .employee-recovery-title i {
        color: #c9a961;
    }

    .employee-recovery-warning {
        color: #fbbf24;
        font-size: 11px;
        font-weight: 600;
    }

    .employee-recovery-codes {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 9px;
    }

    .employee-recovery-code {
        padding: 11px 12px;
        text-align: center;
        border-radius: 9px;
        color: var(--text, #f4f1e9);
        background: var(--surface, #171d27);
        border: 1px dashed rgba(201,169,97,.20);
        font-family: monospace;
        font-size: 12px;
    }

    .employee-two-factor-divider {
        height: 1px;
        margin: 28px 0 20px;

        background: linear-gradient(
            90deg,
            transparent,
            rgba(201,169,97,.16),
            transparent
        );
    }

    .employee-two-factor-back {
        width: 100%;
        min-height: 50px;

        display: flex;
        align-items: center;
        justify-content: center;
        gap: 9px;

        border-radius: 12px;

        color: var(--muted, #8f99a8);
        background: rgba(255,255,255,.025);
        border: 1px solid rgba(201,169,97,.13);

        text-decoration: none;
        font-size: 13px;
        font-weight: 650;
    }

    .employee-two-factor-back i {
        color: #c9a961;
    }

    @media (max-width: 700px) {

        .employee-two-factor-page {
            padding: 20px 12px 40px;
        }

        .employee-two-factor-header {
            padding: 24px 20px;
        }

        .employee-two-factor-title {
            font-size: 19px;
        }

        .employee-security-badge {
            display: none;
        }

        .employee-two-factor-body {
            padding: 23px 18px;
        }

        .employee-qr-wrapper {
            min-height: 240px;
        }

        .employee-recovery-head {
            align-items: flex-start;
            flex-direction: column;
            gap: 7px;
        }
    }

    @media (max-width: 430px) {

        .employee-two-factor-header {
            padding: 20px 16px;
        }

        .employee-two-factor-body {
            padding: 20px 15px;
        }

        .employee-two-factor-title {
            font-size: 17px;
        }

        .employee-recovery-codes {
            grid-template-columns: 1fr;
        }

        .employee-qr-wrapper svg {
            width: 175px;
            height: 175px;
        }
    }
</style>
@endsection


@section('content')

<div class="employee-two-factor-page">

    <div class="employee-two-factor-card">

        <div class="employee-two-factor-header">

            <div class="employee-two-factor-header-info">

                <div class="employee-two-factor-icon">
                    <i class="fas fa-shield-halved"></i>
                </div>

                <div>

                    <h1 class="employee-two-factor-title">
                        المصادقة الثنائية
                    </h1>

                    <span class="employee-two-factor-subtitle">
                        Employee Two Factor Authentication
                    </span>

                </div>

            </div>

            <div class="employee-security-badge">

                <i class="fas fa-lock"></i>

                حماية حساب الموظف

            </div>

        </div>


        <div class="employee-two-factor-body">

            @if ($errors->any())

                <div class="employee-two-factor-alert employee-two-factor-alert-danger">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif


            @if (!$user->two_factor_secret)

                <div class="employee-two-factor-intro">

                    <h3>
                        حماية إضافية لحساب الموظف
                    </h3>

                    <p>
                        فعّل المصادقة الثنائية لإضافة طبقة أمان إضافية
                        إلى حساب الموظف.
                    </p>

                </div>


                <div class="employee-security-info-box">

                    <div class="employee-security-info-icon">
                        <i class="fas fa-shield-halved"></i>
                    </div>

                    <div class="employee-security-info-content">

                        <h4>
                            لماذا تستخدم المصادقة الثنائية؟
                        </h4>

                        <p>
                            حتى في حال معرفة كلمة المرور،
                            سيحتاج الشخص إلى رمز المصادقة الإضافي
                            للوصول إلى حساب الموظف.
                        </p>

                    </div>

                </div>


                @if (session('status') == 'two-factor-authentication-enabled')

                    <div class="employee-two-factor-alert employee-two-factor-alert-info">

                        <i class="fas fa-circle-info"></i>

                        <span>
                            تم تفعيل المصادقة الثنائية.
                            يرجى إكمال إعدادها باستخدام تطبيق المصادقة.
                        </span>

                    </div>

                @endif


                <form action="{{ route('two-factor.enable') }}" method="POST">

                    @csrf

                    <button type="submit"
                            class="employee-two-factor-btn employee-two-factor-btn-primary">

                        <i class="fas fa-lock"></i>

                        تفعيل المصادقة الثنائية

                    </button>

                </form>


            @else

                <div class="employee-two-factor-intro">

                    <h3>
                        إعداد المصادقة الثنائية
                    </h3>

                    <p>
                        امسح رمز QR باستخدام تطبيق المصادقة
                        ثم احتفظ بأكواد الاسترداد في مكان آمن.
                    </p>

                </div>


                <div class="employee-qr-section">

                    <div class="employee-qr-title">

                        <i class="fas fa-qrcode"></i>

                        رمز المصادقة QR

                    </div>

                    <div class="employee-qr-wrapper">

                        {!! $user->twoFactorQrCodeSvg() !!}

                    </div>

                    <p class="employee-qr-note">
                        استخدم Google Authenticator أو Microsoft Authenticator
                        أو أي تطبيق مصادقة يدعم TOTP.
                    </p>

                </div>


                <div class="employee-recovery-section">

                    <div class="employee-recovery-head">

                        <div class="employee-recovery-title">

                            <i class="fas fa-key"></i>

                            أكواد الاسترداد

                        </div>

                        <span class="employee-recovery-warning">

                            <i class="fas fa-triangle-exclamation"></i>

                            احتفظ بها في مكان آمن

                        </span>

                    </div>


                    <div class="employee-recovery-codes">

                        @foreach ($user->recoveryCodes() as $code)

                            <div class="employee-recovery-code">
                                {{ $code }}
                            </div>

                        @endforeach

                    </div>

                </div>


                <form action="{{ route('two-factor.enable') }}" method="POST">

                    @csrf

                    @method('DELETE')

                    <button type="submit"
                            class="employee-two-factor-btn employee-two-factor-btn-danger">

                        <i class="fas fa-shield-xmark"></i>

                        إلغاء تفعيل المصادقة الثنائية

                    </button>

                </form>

            @endif


            <div class="employee-two-factor-divider"></div>


            <a href="{{ route('employee.dashboard') }}"
               class="employee-two-factor-back">

                <i class="fas fa-arrow-right"></i>

                العودة إلى لوحة تحكم الموظف

            </a>

        </div>

    </div>

</div>

@endsection