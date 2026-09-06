@extends('Employee.layouts.app')

@section('title', 'المصادقة الثنائية | Elite Club')

@section('styles')

    <style>
        /* =========================================================
                   ELITE CLUB — EMPLOYEE TWO FACTOR
                   PREMIUM / CLEAR TYPOGRAPHY / FULL RESPONSIVE
                   ========================================================= */

        .employee-two-factor-page {
            width: 100%;
            min-height: calc(100vh - 120px);

            display: flex;
            justify-content: center;
            align-items: flex-start;

            padding: 35px 20px 60px;

            box-sizing: border-box;
        }

        .employee-two-factor-card {
            position: relative;

            width: 100%;
            max-width: 780px;

            overflow: hidden;

            background: var(--surface, #171d27);

            border: 1px solid color-mix(in srgb,
                    var(--gold, #c9a961) 25%,
                    var(--border, #303642));

            border-radius: 22px;

            box-shadow:
                0 25px 70px rgba(0, 0, 0, .25);

            transition:
                background .25s ease,
                border-color .25s ease,
                box-shadow .25s ease;
        }

        /* =========================================================
                   GOLD TOP LINE
                   ========================================================= */

        .employee-two-factor-card::before {
            content: "";

            position: absolute;

            top: 0;
            right: 0;
            left: 0;

            height: 4px;

            background:
                linear-gradient(90deg,
                    transparent,
                    var(--gold, #c9a961),
                    var(--gold-light, #e6c978),
                    var(--gold, #c9a961),
                    transparent);

            z-index: 5;
        }

        /* =========================================================
                   HEADER
                   ========================================================= */

        .employee-two-factor-header {
            min-height: 155px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 25px;

            padding: 30px 34px;

            background:
                radial-gradient(circle at 15% 50%,
                    rgba(201, 169, 97, .09),
                    transparent 38%),
                linear-gradient(135deg,
                    rgba(255, 255, 255, .025),
                    rgba(201, 169, 97, .025));

            border-bottom: 1px solid color-mix(in srgb,
                    var(--gold, #c9a961) 17%,
                    var(--border, #303642));
        }

        .employee-two-factor-header-info {
            min-width: 0;

            display: flex;
            align-items: center;

            gap: 21px;
        }

        /* =========================================================
                   SECURITY ICON
                   ========================================================= */

        .employee-two-factor-icon {
            width: 78px;
            height: 78px;

            flex: 0 0 78px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 21px;

            color: var(--gold, #c9a961);

            background:
                color-mix(in srgb,
                    var(--gold, #c9a961) 8%,
                    var(--surface-2, #202733));

            border: 1px solid color-mix(in srgb,
                    var(--gold, #c9a961) 35%,
                    var(--border, #303642));

            box-shadow:
                0 10px 25px rgba(201, 169, 97, .10);

            transition:
                transform .25s ease,
                box-shadow .25s ease;
        }

        .employee-two-factor-card:hover .employee-two-factor-icon {
            transform: translateY(-2px);

            box-shadow:
                0 14px 30px rgba(201, 169, 97, .15);
        }

        .employee-two-factor-icon i {
            font-size: 31px;
        }

        /* =========================================================
                   TITLE
                   ========================================================= */

        .employee-two-factor-title {
            margin: 0;

            color: var(--text, #f4f1e9);

            font-size: 27px;
            font-weight: 900;

            line-height: 1.45;

            letter-spacing: -.4px;

            word-break: break-word;
        }

        .employee-two-factor-subtitle {
            display: block;

            margin-top: 6px;

            color: var(--muted, #8f99a8);

            font-size: 13px;
            font-weight: 600;

            line-height: 1.7;
        }

        /* =========================================================
                   SECURITY BADGE
                   ========================================================= */

        .employee-security-badge {
            flex-shrink: 0;

            display: inline-flex;
            align-items: center;

            gap: 8px;

            padding: 10px 15px;

            border-radius: 999px;

            color: var(--gold, #c9a961);

            background:
                color-mix(in srgb,
                    var(--gold, #c9a961) 7%,
                    var(--surface, #171d27));

            border: 1px solid color-mix(in srgb,
                    var(--gold, #c9a961) 24%,
                    var(--border, #303642));

            font-size: 12px;
            font-weight: 750;

            white-space: nowrap;
        }

        .employee-security-badge i {
            font-size: 11px;
        }

        /* =========================================================
                   BODY
                   ========================================================= */

        .employee-two-factor-body {
            padding: 34px;
        }

        /* =========================================================
                   ALERTS
                   ========================================================= */

        .employee-two-factor-alert {
            width: 100%;

            box-sizing: border-box;

            padding: 15px 18px;

            margin-bottom: 24px;

            border-radius: 13px;

            font-size: 13px;
            font-weight: 600;

            line-height: 1.9;
        }

        .employee-two-factor-alert ul {
            margin: 0;

            padding-right: 20px;
        }

        .employee-two-factor-alert li {
            margin-bottom: 3px;
        }

        .employee-two-factor-alert-danger {
            color: #fca5a5;

            background:
                rgba(239, 68, 68, .075);

            border: 1px solid rgba(239, 68, 68, .23);
        }

        .employee-two-factor-alert-info {
            display: flex;
            align-items: flex-start;

            gap: 11px;

            color: #93c5fd;

            background:
                rgba(59, 130, 246, .07);

            border: 1px solid rgba(59, 130, 246, .21);
        }

        .employee-two-factor-alert-info i {
            margin-top: 4px;

            flex: 0 0 auto;
        }

        /* =========================================================
                   INTRO
                   ========================================================= */

        .employee-two-factor-intro {
            max-width: 650px;

            margin: 0 auto 30px;

            text-align: center;
        }

        .employee-two-factor-intro h3 {
            margin: 0 0 9px;

            color: var(--text, #f4f1e9);

            font-size: 19px;
            font-weight: 850;

            line-height: 1.5;
        }

        .employee-two-factor-intro p {
            margin: 0;

            color: var(--muted, #8f99a8);

            font-size: 13px;
            font-weight: 550;

            line-height: 2;

            word-break: break-word;
        }

        /* =========================================================
                   SECURITY INFO
                   ========================================================= */

        .employee-security-info-box {
            display: flex;
            align-items: flex-start;

            gap: 16px;

            padding: 20px;

            margin-bottom: 26px;

            border-radius: 16px;

            background:
                color-mix(in srgb,
                    var(--gold, #c9a961) 3%,
                    var(--surface-2, #202733));

            border: 1px solid color-mix(in srgb,
                    var(--gold, #c9a961) 17%,
                    var(--border, #303642));
        }

        .employee-security-info-icon {
            width: 45px;
            height: 45px;

            flex: 0 0 45px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 12px;

            color: var(--gold, #c9a961);

            background:
                rgba(201, 169, 97, .08);

            border: 1px solid rgba(201, 169, 97, .22);
        }

        .employee-security-info-icon i {
            font-size: 15px;
        }

        .employee-security-info-content {
            min-width: 0;
        }

        .employee-security-info-content h4 {
            margin: 0 0 6px;

            color: var(--text, #f4f1e9);

            font-size: 15px;
            font-weight: 800;

            line-height: 1.6;
        }

        .employee-security-info-content p {
            margin: 0;

            color: var(--muted, #8f99a8);

            font-size: 12px;
            font-weight: 550;

            line-height: 1.9;
        }

        /* =========================================================
                   MAIN BUTTON
                   ========================================================= */

        .employee-two-factor-btn {
            width: 100%;
            min-height: 57px;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 10px;

            padding: 12px 18px;

            border-radius: 13px;

            cursor: pointer;

            font-family: inherit;

            font-size: 14px;
            font-weight: 850;

            line-height: 1.5;

            transition:
                transform .2s ease,
                box-shadow .2s ease,
                background .2s ease,
                border-color .2s ease;
        }

        .employee-two-factor-btn:hover {
            transform: translateY(-2px);
        }

        .employee-two-factor-btn:active {
            transform: translateY(0);
        }

        .employee-two-factor-btn-primary {
            color: #171717;

            background:
                linear-gradient(135deg,
                    var(--gold-light, #d9b968),
                    var(--gold-dark, #bd9540));

            border: 1px solid rgba(230, 201, 120, .48);

            box-shadow:
                0 10px 24px rgba(184, 146, 62, .16);
        }

        .employee-two-factor-btn-primary:hover {
            box-shadow:
                0 14px 32px rgba(184, 146, 62, .24);

            filter: brightness(1.04);
        }

        .employee-two-factor-btn-danger {
            color: #ef9a9a;

            background:
                rgba(239, 68, 68, .035);

            border: 1px solid rgba(239, 68, 68, .21);
        }

        .employee-two-factor-btn-danger:hover {
            color: #fff;

            background:
                rgba(239, 68, 68, .10);

            border-color:
                rgba(239, 68, 68, .35);
        }

        /* =========================================================
                   QR SECTION
                   ========================================================= */

        .employee-qr-section {
            margin-bottom: 30px;
        }

        .employee-qr-title {
            display: flex;
            align-items: center;

            gap: 10px;

            margin-bottom: 15px;

            color: var(--text, #f4f1e9);

            font-size: 15px;
            font-weight: 850;

            line-height: 1.6;
        }

        .employee-qr-title i {
            color: var(--gold, #c9a961);
            font-size: 14px;
        }

        /* =========================================================
                   QR CONTAINER
                   ========================================================= */

        .employee-qr-wrapper {
            width: 100%;
            min-height: 300px;

            box-sizing: border-box;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 30px;

            border-radius: 18px;

            background: #fff;

            border: 1px solid rgba(201, 169, 97, .38);

            box-shadow:
                inset 0 0 0 8px #f7f7f7,
                0 13px 35px rgba(0, 0, 0, .15);

            overflow: hidden;
        }

        .employee-qr-wrapper svg {
            width: 230px;
            height: 230px;

            max-width: 100%;
            max-height: 100%;

            display: block;
        }

        .employee-qr-note {
            margin: 12px 0 0;

            text-align: center;

            color: var(--muted, #8f99a8);

            font-size: 11.5px;
            font-weight: 550;

            line-height: 1.8;
        }

        /* =========================================================
                   RECOVERY CODES
                   ========================================================= */

        .employee-recovery-section {
            margin: 26px 0 29px;

            padding: 22px;

            border-radius: 17px;

            background:
                color-mix(in srgb,
                    var(--gold, #c9a961) 4%,
                    var(--surface-2, #202733));

            border: 1px solid color-mix(in srgb,
                    var(--gold, #c9a961) 18%,
                    var(--border, #303642));
        }

        .employee-recovery-head {
            display: flex;
            align-items: center;
            justify-content: space-between;

            gap: 15px;

            margin-bottom: 18px;
        }

        .employee-recovery-title {
            display: flex;
            align-items: center;

            gap: 10px;

            color: var(--text, #f4f1e9);

            font-size: 15px;
            font-weight: 850;

            line-height: 1.6;
        }

        .employee-recovery-title i {
            color: var(--gold, #c9a961);
        }

        .employee-recovery-warning {
            display: inline-flex;
            align-items: center;

            gap: 6px;

            color: #fbbf24;

            font-size: 11px;
            font-weight: 700;

            line-height: 1.6;
        }

        /* =========================================================
                   RECOVERY GRID
                   ========================================================= */

        .employee-recovery-codes {
            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 10px;
        }

        .employee-recovery-code {
            min-width: 0;

            padding: 12px 13px;

            text-align: center;

            border-radius: 9px;

            color: var(--text, #f4f1e9);

            background:
                var(--surface, #171d27);

            border: 1px dashed rgba(201, 169, 97, .23);

            font-family: monospace;

            font-size: 13px;
            font-weight: 650;

            letter-spacing: .4px;

            overflow-wrap: anywhere;

            transition:
                border-color .2s ease,
                background .2s ease;
        }

        .employee-recovery-code:hover {
            border-color:
                rgba(201, 169, 97, .40);

            background:
                color-mix(in srgb,
                    var(--gold, #c9a961) 3%,
                    var(--surface, #171d27));
        }

        /* =========================================================
                   DIVIDER
                   ========================================================= */

        .employee-two-factor-divider {
            height: 1px;

            margin: 30px 0 21px;

            background:
                linear-gradient(90deg,
                    transparent,
                    rgba(201, 169, 97, .19),
                    transparent);
        }

        /* =========================================================
                   BACK BUTTON
                   ========================================================= */

        .employee-two-factor-back {
            width: 100%;
            min-height: 52px;

            display: flex;
            align-items: center;
            justify-content: center;

            gap: 9px;

            padding: 10px 15px;

            box-sizing: border-box;

            border-radius: 12px;

            color: var(--muted, #8f99a8);

            background:
                color-mix(in srgb,
                    var(--gold, #c9a961) 2%,
                    var(--surface-2, #202733));

            border: 1px solid color-mix(in srgb,
                    var(--gold, #c9a961) 14%,
                    var(--border, #303642));

            text-decoration: none;

            font-size: 13px;
            font-weight: 700;

            transition:
                color .2s ease,
                background .2s ease,
                border-color .2s ease,
                transform .2s ease;
        }

        .employee-two-factor-back:hover {
            color: var(--text, #f4f1e9);

            border-color:
                color-mix(in srgb,
                    var(--gold, #c9a961) 28%,
                    var(--border, #303642));

            background:
                color-mix(in srgb,
                    var(--gold, #c9a961) 5%,
                    var(--surface-2, #202733));

            transform: translateY(-1px);
        }

        .employee-two-factor-back i {
            color: var(--gold, #c9a961);
        }

        /* =========================================================
                   TABLET
                   ========================================================= */

        @media (max-width: 900px) {

            .employee-two-factor-page {
                padding: 28px 16px 50px;
            }

            .employee-two-factor-header {
                min-height: 140px;

                padding: 25px 24px;

                gap: 18px;
            }

            .employee-two-factor-header-info {
                gap: 16px;
            }

            .employee-two-factor-icon {
                width: 68px;
                height: 68px;
                flex-basis: 68px;
            }

            .employee-two-factor-icon i {
                font-size: 27px;
            }

            .employee-two-factor-title {
                font-size: 23px;
            }

            .employee-two-factor-subtitle {
                font-size: 12px;
            }

            .employee-two-factor-body {
                padding: 27px 24px;
            }

            .employee-security-badge {
                font-size: 11px;
                padding: 9px 12px;
            }
        }

        /* =========================================================
                   MOBILE
                   ========================================================= */

        @media (max-width: 700px) {

            .employee-two-factor-page {
                min-height: calc(100dvh - 90px);

                padding:
                    18px 11px 35px;
            }

            .employee-two-factor-card {
                border-radius: 17px;

                box-shadow:
                    0 18px 45px rgba(0, 0, 0, .22);
            }

            /* HEADER */

            .employee-two-factor-header {
                min-height: auto;

                display: block;

                padding: 22px 18px;
            }

            .employee-two-factor-header-info {
                width: 100%;

                gap: 14px;
            }

            .employee-two-factor-icon {
                width: 60px;
                height: 60px;

                flex: 0 0 60px;

                border-radius: 16px;
            }

            .employee-two-factor-icon i {
                font-size: 24px;
            }

            .employee-two-factor-title {
                font-size: 20px;

                line-height: 1.45;
            }

            .employee-two-factor-subtitle {
                margin-top: 4px;

                font-size: 10.5px;

                line-height: 1.7;
            }

            .employee-security-badge {
                display: none;
            }

            /* BODY */

            .employee-two-factor-body {
                padding: 22px 17px 24px;
            }

            /* ALERT */

            .employee-two-factor-alert {
                padding: 13px 14px;

                margin-bottom: 19px;

                border-radius: 11px;

                font-size: 11.5px;

                line-height: 1.8;
            }

            /* INTRO */

            .employee-two-factor-intro {
                margin-bottom: 22px;
            }

            .employee-two-factor-intro h3 {
                margin-bottom: 7px;

                font-size: 16px;
            }

            .employee-two-factor-intro p {
                font-size: 11.5px;

                line-height: 1.9;
            }

            /* INFO */

            .employee-security-info-box {
                gap: 12px;

                padding: 15px;

                margin-bottom: 20px;

                border-radius: 13px;
            }

            .employee-security-info-icon {
                width: 39px;
                height: 39px;

                flex-basis: 39px;

                border-radius: 10px;
            }

            .employee-security-info-content h4 {
                font-size: 13px;
            }

            .employee-security-info-content p {
                font-size: 10.5px;

                line-height: 1.85;
            }

            /* BUTTON */

            .employee-two-factor-btn {
                min-height: 53px;

                padding: 11px 14px;

                border-radius: 11px;

                font-size: 12.5px;
            }

            /* QR */

            .employee-qr-section {
                margin-bottom: 23px;
            }

            .employee-qr-title {
                margin-bottom: 11px;

                font-size: 13px;
            }

            .employee-qr-wrapper {
                min-height: 245px;

                padding: 22px;

                border-radius: 14px;

                box-shadow:
                    inset 0 0 0 6px #f7f7f7,
                    0 9px 25px rgba(0, 0, 0, .13);
            }

            .employee-qr-wrapper svg {
                width: 190px;
                height: 190px;
            }

            .employee-qr-note {
                margin-top: 10px;

                font-size: 10px;

                line-height: 1.75;
            }

            /* RECOVERY */

            .employee-recovery-section {
                margin: 21px 0 23px;

                padding: 16px;

                border-radius: 14px;
            }

            .employee-recovery-head {
                align-items: flex-start;

                flex-direction: column;

                gap: 6px;

                margin-bottom: 14px;
            }

            .employee-recovery-title {
                font-size: 13px;
            }

            .employee-recovery-warning {
                font-size: 10px;
            }

            .employee-recovery-codes {
                grid-template-columns:
                    repeat(2, minmax(0, 1fr));

                gap: 8px;
            }

            .employee-recovery-code {
                padding: 10px 8px;

                font-size: 11px;
            }

            /* DIVIDER */

            .employee-two-factor-divider {
                margin: 24px 0 17px;
            }

            /* BACK */

            .employee-two-factor-back {
                min-height: 48px;

                font-size: 11.5px;
            }
        }

        /* =========================================================
                   SMALL MOBILE
                   ========================================================= */

        @media (max-width: 430px) {

            .employee-two-factor-page {
                padding:
                    14px 8px 30px;
            }

            .employee-two-factor-header {
                padding: 19px 15px;
            }

            .employee-two-factor-header-info {
                gap: 12px;
            }

            .employee-two-factor-icon {
                width: 53px;
                height: 53px;

                flex-basis: 53px;

                border-radius: 14px;
            }

            .employee-two-factor-icon i {
                font-size: 21px;
            }

            .employee-two-factor-title {
                font-size: 18px;
            }

            .employee-two-factor-subtitle {
                font-size: 9.5px;
            }

            .employee-two-factor-body {
                padding: 19px 13px 21px;
            }

            .employee-two-factor-intro h3 {
                font-size: 15px;
            }

            .employee-two-factor-intro p {
                font-size: 10.5px;
            }

            .employee-security-info-box {
                padding: 13px;
            }

            .employee-security-info-icon {
                width: 36px;
                height: 36px;
                flex-basis: 36px;
            }

            .employee-security-info-content h4 {
                font-size: 12px;
            }

            .employee-security-info-content p {
                font-size: 10px;
            }

            .employee-two-factor-btn {
                min-height: 50px;
                font-size: 11.5px;
            }

            .employee-qr-wrapper {
                min-height: 215px;
                padding: 18px;
            }

            .employee-qr-wrapper svg {
                width: 170px;
                height: 170px;
            }

            .employee-qr-note {
                font-size: 9.5px;
            }

            .employee-recovery-section {
                padding: 14px;
            }

            .employee-recovery-codes {
                grid-template-columns: 1fr;
            }

            .employee-recovery-code {
                font-size: 11px;
                padding: 10px;
            }

            .employee-two-factor-back {
                min-height: 46px;
                font-size: 10.5px;
            }
        }

        /* =========================================================
                   VERY SMALL SCREENS
                   ========================================================= */

        @media (max-width: 350px) {

            .employee-two-factor-title {
                font-size: 16px;
            }

            .employee-two-factor-subtitle {
                font-size: 9px;
            }

            .employee-two-factor-icon {
                width: 48px;
                height: 48px;
                flex-basis: 48px;
            }

            .employee-two-factor-icon i {
                font-size: 19px;
            }

            .employee-two-factor-body {
                padding-left: 11px;
                padding-right: 11px;
            }

            .employee-qr-wrapper svg {
                width: 155px;
                height: 155px;
            }
        }

        /* =========================================================
                   REDUCED MOTION
                   ========================================================= */

        @media (prefers-reduced-motion: reduce) {

            .employee-two-factor-card,
            .employee-two-factor-icon,
            .employee-two-factor-btn,
            .employee-two-factor-back,
            .employee-recovery-code {
                transition: none;
            }
        }
    </style>

@endsection


@section('content')

    <div class="employee-two-factor-page">

        <div class="employee-two-factor-card">

            {{-- =================================================
             HEADER
             ================================================= --}}

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


            {{-- =================================================
             BODY
             ================================================= --}}

            <div class="employee-two-factor-body">

                {{-- ERRORS --}}

                @if ($errors->any())

                    <div class="employee-two-factor-alert employee-two-factor-alert-danger">

                        <ul>

                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- =================================================
                 NOT ENABLED
                 ================================================= --}}

                @if ($user->two_factor_secret && $user->two_factor_confirmed_at)

                    {{-- ✅ الحالة 3: مفعّلة ومؤكَّدة بالكامل — لا نعرض الـ QR/السر مجدداً --}}

                    <div class="employee-two-factor-alert employee-two-factor-alert-info">
                        <i class="fas fa-shield-check"></i>
                        <span>
                            المصادقة الثنائية <strong>مفعّلة ومؤكَّدة</strong> على هذا الحساب.
                            سيُطلب منك رمز التحقق في كل مرة تسجّل فيها الدخول.
                        </span>
                    </div>

                    <div class="employee-recovery-section" style="margin-top: 16px;">
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
                                <div class="employee-recovery-code">{{ $code }}</div>
                            @endforeach
                        </div>
                    </div>

                    <form action="{{ route('employee.two-factor.disable') }}" method="POST" style="margin-top: 16px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="employee-two-factor-btn employee-two-factor-btn-danger">
                            <i class="fas fa-shield-xmark"></i>
                            إلغاء تفعيل المصادقة الثنائية
                        </button>
                    </form>
                @elseif (!$user->two_factor_secret)
                    <div class="employee-two-factor-intro">

                        <h3>
                            حماية إضافية لحساب الموظف
                        </h3>

                        <p>
                            فعّل المصادقة الثنائية لإضافة طبقة أمان
                            إضافية إلى حساب الموظف وحماية الوصول إلى الحساب.
                        </p>

                    </div>


                    {{-- SECURITY INFORMATION --}}

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


                    {{-- ENABLE STATUS --}}

                    @if (session('status') == 'two-factor-authentication-enabled')
                        <div class="employee-two-factor-alert employee-two-factor-alert-info">

                            <i class="fas fa-circle-info"></i>

                            <span>
                                تم تفعيل المصادقة الثنائية.
                                يرجى إكمال إعدادها باستخدام تطبيق المصادقة.
                            </span>

                        </div>
                    @endif


                    {{-- ENABLE BUTTON --}}

                    <form action="{{ route('employee.two-factor.enable') }}" method="POST">

                        @csrf

                        <button type="submit" class="employee-two-factor-btn employee-two-factor-btn-primary">

                            <i class="fas fa-lock"></i>

                            تفعيل المصادقة الثنائية

                        </button>

                    </form>


                    {{-- =================================================
                 ENABLED
                 ================================================= --}}
                @else
                    <div class="employee-two-factor-intro">

                        <h3>
                            إعداد المصادقة الثنائية
                        </h3>

                        <p>
                            امسح رمز QR باستخدام تطبيق المصادقة،
                            ثم احتفظ بأكواد الاسترداد في مكان آمن.
                        </p>

                    </div>


                    {{-- QR CODE --}}

                    <div class="employee-qr-section">

                        <div class="employee-qr-title">

                            <i class="fas fa-qrcode"></i>

                            رمز المصادقة QR

                        </div>


                        <div class="employee-qr-wrapper">

                            {!! $user->twoFactorQrCodeSvg() !!}

                        </div>


                        <p class="employee-qr-note">

                            استخدم Google Authenticator أو
                            Microsoft Authenticator أو أي تطبيق
                            مصادقة يدعم TOTP.

                        </p>

                    </div>


                    {{-- =================================================
                     RECOVERY CODES
                     ================================================= --}}

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


                    {{-- 🆕 خطوة التأكيد — إجبارية حتى يفعّل لارافيل التحقق فعلياً عند الدخول --}}
                    <div class="employee-two-factor-alert employee-two-factor-alert-info" style="margin-top: 20px;">
                        <i class="fas fa-circle-exclamation"></i>
                        <span>
                            <strong>خطوة أخيرة إجبارية:</strong> امسح الرمز أعلاه بتطبيق المصادقة،
                            وأدخل الرمز المكوّن من 6 أرقام هون تحت، وإلا لن يُطلب منك أي رمز
                            عند تسجيل الدخول لاحقاً.
                        </span>
                    </div>

                    <form action="{{ route('employee.two-factor.confirm') }}" method="POST" style="margin-top: 14px;">
                        @csrf
                        <div style="margin-bottom: 14px;">
                            <label for="employee_two_factor_code"
                                style="display:block; margin-bottom:7px; font-weight:700; font-size: 13.5px;">
                                رمز التأكيد (6 أرقام)
                            </label>
                            <input type="text" name="code" id="employee_two_factor_code" inputmode="numeric"
                                autocomplete="one-time-code" maxlength="6" placeholder="000000" required
                                style="width:100%; height:46px; padding:0 14px; border-radius:10px; border:1px solid #dfe4eb; font-size:18px; letter-spacing:6px; text-align:center; font-weight:800;">
                            @error('code')
                                <div style="color:#d94b4b; font-size:12.5px; margin-top:6px; font-weight:600;">
                                    {{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="employee-two-factor-btn employee-two-factor-btn-primary">
                            <i class="fas fa-check"></i>
                            تأكيد وتفعيل المصادقة الثنائية نهائياً
                        </button>
                    </form>


                    {{-- DISABLE --}}

                    <form action="{{ route('employee.two-factor.disable') }}" method="POST" style="margin-top: 12px;">

                        @csrf

                        @method('DELETE')

                        <button type="submit" class="employee-two-factor-btn employee-two-factor-btn-danger">

                            <i class="fas fa-shield-xmark"></i>

                            إلغاء تفعيل المصادقة الثنائية

                        </button>

                    </form>

                @endif


                {{-- =================================================
                 DIVIDER
                 ================================================= --}}

                <div class="employee-two-factor-divider"></div>


                {{-- =================================================
                 BACK
                 ================================================= --}}

                <a href="{{ route('employee.dashboard') }}" class="employee-two-factor-back">

                    <i class="fas fa-arrow-right"></i>

                    العودة إلى لوحة تحكم الموظف

                </a>

            </div>

        </div>

    </div>

@endsection
